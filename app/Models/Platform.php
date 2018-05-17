<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    const TYPE_COMPUTER = 'computer';
    const TYPE_ANDROID = 'android';
    const TYPE_APPLE = 'apple';
    const TYPE_MPLAYER = 'mplayer';
    const TYPE_TV = 'tv';
    const TYPE_ONLINE = 'online';

    public $timestamps = false;

    public static $folder = 'upload/';
    protected $fillable = ['name','content','type'];

    public static $rules = [
    	'name' => 'required|string',
    	'content' => 'required',
        'type' => 'required'
    ];

    public function steps()
    {
        return $this->hasMany(Step::class)->orderBy('number','asc');
    }

    public static function getLabels(){
    	return [
    		self::TYPE_COMPUTER => 'Компьютер, ноутбук',
    		self::TYPE_ANDROID => 'Android устройства',
    		self::TYPE_APPLE => 'Аpple устройства',
            self::TYPE_MPLAYER => 'Медиаплееры',
            self::TYPE_TV => 'Телевизор',
            self::TYPE_ONLINE =>'Напрямую с сайта'
    	];
    }

    public function getLabel($type){
    	$infos = self::getLabels();
    	return $infos[$type];
    }

    public static  function getByType($type){
        $platform_ids = PlatformOs::where('os', $type)->pluck('platform_id')->toArray();
        if(empty($platform_ids)){
            return [];
        }
        return self::whereIn('id',$platform_ids)->get();
    }

    public function renderContent($content){
        //var_dump($content);
        foreach ($content as $key => $step):
            $post = Step::firstOrNew(['number' => ($key+1) , 'platform_id' => $this->id]);
            $post->content = $step;
            $post->number = $key+1;
            $post->save();
        endforeach;
        Step::where('platform_id', $this->id)->where('number','>',($key+1))->delete(); 
    }

    public function getContent(){
        $resp = preg_match('/s:(\d+):"(.*?)";/is', $this->content, $matches);
        return ($resp === 0) ? [$this->content] : unserialize($this->content);
    }

    public function saveTypes($types){
        PlatformOs::where('platform_id', $this->id)->delete();
        foreach ($types as $key => $item) {
            $type = new PlatformOs;
            $type->platform_id = $this->id;
            $type->os = $item;
            $type->save();
        }
    }

    public function getTypes(){
        return PlatformOs::where('platform_id',$this->id)->pluck('os')->toArray();
    }
}
