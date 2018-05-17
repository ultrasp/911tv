<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    public $timestamps = false;

    //const PARSE_URL = 'http://smotrisport.tv/event/';
    const PARSE_URL = 'http://allsport-news.net/sport_tv/';

    public static  function get_from_url(){
        $context = stream_context_create(
            array(
                "http" => array(
                    "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                )
            )
        );

        $htmlinput = file_get_contents(self::PARSE_URL, false, $context);

        $doc = new \DOMDocument('1.0', 'UTF-8');
        $internalErrors = libxml_use_internal_errors(true);

        $doc->loadHTML($htmlinput);
        libxml_use_internal_errors($internalErrors);
        return $doc;

        /*
        */
    }

    public static  function parse_url(){
        $doc = self::get_from_url();
        date_default_timezone_set('Europe/Moscow');

        //echo $doc->saveHTML();
        //self::get_onlayn($doc);
        self::getP($doc);
    }

    public static function getP($doc){
        $xpath = new \DOMXpath($doc);
        $blocks = $xpath->query('//div[@class="tpl_main"]');
        //var_dump(count($blocks));
        $container = $blocks[0];
        $arr = $container->getElementsByTagName("table");
        $main_table = $arr[1];
        $rows = $main_table->getElementsByTagName("tr");
        foreach ($rows as $key => $row) {
            $cells = $row->getElementsByTagName('td');
            $imgs = $cells[2]->getElementsByTagName('img');
            $channel = $imgs[0]->getAttribute('title');
            $time_bad = $cells[0]->nodeValue;
            $e_name = trim($cells[4]->nodeValue);
            preg_match('/\d{2}:\d{2}\s\d{2}-\d{2}-\d{2}/', $time_bad, $matches);
            if(!empty($matches)){
            	$time_bad = explode(' ', $matches[0]);
            	$hours = explode(':', $time_bad[0]);
            	$days = explode('-', $time_bad[1]);
            	$day = date('Y-m-d H:i:s',strtotime('20'.$days[2].'-'.$days[1].'-'.$days[0].' '.$hours[0].':'.$hours[1].':00'));

                //print_r($matches);
                //echo $day." ".$e_name." ".$channel."<br>";
	            $item = new self();
	            $item->name = $e_name;
	            $item->channel =     $channel;
	            $item->hold_date = $day;
	            $item->save();  
            }
            // foreach ($cells as $key => $item) {
            //     echo $key." ".$item->nodeValue."<br>";
            // }
        }
        //exit();
    }

    public static  function parse_url_old(){
        $doc = self::get_from_url();
        date_default_timezone_set('Europe/Moscow');

        //echo $doc->saveHTML();
        //self::get_onlayn($doc);
        self::getToday($doc);
    }

    public static function getToday($doc){
        $xpath = new \DOMXpath($doc);
        $blocks = $xpath->query('//div[@class="date-para"]');
        $container = $blocks[0];
        //var_dump($container);
        //echo $container->nodeValue; 
        $arr = $container->getElementsByTagName("li");
        foreach($arr as $key => $dom) {
            $item = new self();
            $a = $dom->getElementsByTagName("a")[0];
            $item->name = self::getTitle($a);
            $spans = $dom->getElementsByTagName("span");
            foreach ($spans as $key => $value) {
                echo($key." ".$value->getAttribute('class')."<br>");
                if('chempNam' == $value->getAttribute('class')){
                    $item->liga = $value->nodeValue ;
                    break;
                }
            }
            $item->hold_date = self::getTime($dom, 0);
            $item->type =trim($spans[1]->getAttribute('class'));
            if(!empty($item->hold_date )){
                $item->save();  
            }
        }       
    }

    public static function get_onlayn($doc){
        $xpath = new \DOMXpath($doc);
        $blocks = $xpath->query('//ul[@class="popular_live_list big_team_icon"]');
        $container = $blocks[0];
        //var_dump($container);
        //echo $container->nodeValue; 
        $arr = $container->getElementsByTagName("a");
        foreach($arr as $key => $dom) {
            $item = new self();
            $item->name = self::getTitle($dom);
            $item->liga =     self::getLiga($dom);
            $item->hold_date = self::getTime($dom);
            $item->type =   self::getType($dom);
            $item->save();  
            //echo $key." ".$item->getAttribute("href")."  ".$item->nodeValue."<br>";
        }
        exit();
    }

    public static function getTitle($item){
        $string = $item->getAttribute("title");
        return trim(preg_replace('/: смотреть онлайн/i', '' , $string));
    }

    public static function getLiga($item){
        $arr = $item->getElementsByTagName("div");
        return isset($arr[3]) ? trim($arr[3]->nodeValue) : '';
    }

    public static function getTime($item, $num = 1 ){

        $arr = $item->getElementsByTagName("meta");

        $time = '';
        if(isset($arr[$num])){
            $time =  date('Y-m-d H:i:s',strtotime(trim($arr[$num]->getAttribute('content'))));
            
        }
        return $time;
    }

    public static function getType($item){
        $arr = $item->getElementsByTagName("span");
        return trim(preg_replace('/vid/i', '' , $arr[0]->getAttribute('class')));
    }
}
