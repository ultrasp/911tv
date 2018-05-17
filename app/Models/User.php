<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Mail;

class User extends Authenticatable
{
    use Notifiable;
    const A_STATUS_ACTIVE = 'active';
    const A_STAUS_INACTIVE = 'inactive';
    public $timestamps = false;

    protected $fillable = ['username','paypal_email','yandex_tel_num','qiwi_tel_num','wmid'];

    public function mac()
    {
        return $this->hasOne(Macadres::class);
    }

    public function makeInactive(){
    	$this->account_status = self::A_STAUS_INACTIVE;
    	$this->save();
    }
    
    public function makeActive(){
    	$this->account_status = self::A_STATUS_ACTIVE;
    	$this->save();
    }

    public static function getStatuses(){
    	return [
    		self::A_STAUS_INACTIVE => 'Приостановлен',
    		self::A_STATUS_ACTIVE => 'Активен'
    	];
    }

    public function getStatusLabel(){
    	$labels = self::getStatuses();
    	return $labels[$this->account_status]; 
    }

    public function isInactive(){
    	return ($this->account_status ==  self::A_STAUS_INACTIVE ) ? true : false;
    }

    public function partners($count = false){
        $query = self::where('boss_parent_id', $this->id);
        return ($count) ? $query->count() : $query;
    }

    public function needActivation(){
        return (is_null($this->email_activate_token)) ? false : true;
    }

    public function sendMail(){
        //mail('ultrasp@mail.ru', 'My Subject', 'asa');

        $to      = $this->email;
        $subject = 'Подтверждение учетной записи';
        $message = '
        <html>
            <head></head>
            <body>
                <p>Вам пришло это письмо так как вы запросили подтверждение учетной записи на сайте <a href="'.route('front.home').'">911tv.info</a>. Если вы этого не делали, проигнорируйте это письмо. Ниже находится ссылка для входа в ваш личный кабинет.
                </p><br>
                <p><a href="'.route('front.approv',['token' => $this->email_activate_token]).'">Ссылка для подтверждения учетной записи.</a></p>
            </body>
        </html>';

        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=utf8';

        // Additional headers
        $headers[] = 'To: '.$this->username.' <'.$this->email.'>';
        $headers[] = 'From: Site 911.tv <test@911tv.info>';
        //var_dump($headers);

        $resp = @mail($to, $subject, $message, implode("\r\n", $headers));
        //var_dump($resp);
        /*
        var_dump($resp);
        Mail::send('mail', [], function ($message)
        {
            $message->from('ultrasp@mail.ru', '911tv.info');
            $message->to('ultrasp@mail.ru');
        });*/
    }

    public function sendRecoverMail(){
        //mail('ultrasp@mail.ru', 'My Subject', 'asa');

        $to      = $this->email;
        $subject = 'Восстановление пароля';
        $message = '
        <html>
            <head></head>
            <body>
                <p>
                Вам пришло это письмо так как вы запросили восстановление пароля на сайте <a href="'.route('front.home').'">911tv.info</a>. Если вы этого не делали, проигнорируйте это письмо. Ниже находится ссылка для входа в ваш личный кабинет.
                </p><br>
                <p><a href="'.route('front.enter',['token' => $this->recover_token]).'">Ссылка для входа в личный кабинет.</a></p>
            </body>
        </html>';

        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=utf8';

        // Additional headers
        $headers[] = 'To: '.$this->username.' <'.$this->email.'>';
        $headers[] = 'From: Site 911.tv <test@911tv.info>';
        //var_dump($headers);

        $resp = @mail($to, $subject, $message, implode("\r\n", $headers));
    }

    public function has_test(){
        return TestUser::where('user_id', $this->id)->where('end_time','>=', date('Y-m-d H:i:s'))->exists();
    }

    public function get_test_playlist(){

        if( is_null($this->api_password) ){
            Topchantv::makeApiUrl();
        }

        return Topchantv::PROVIDER.'get.php?username='.$this->username.'&password='.$this->api_password.'&type=m3u&output=ts';

    }

    public function has_access_test(){
        $has_access = false;
        if($test = TestUser::where(['user_id' => $this->id])->first()){
            if( $test->end_time > date('Y-m-d H:i:s')){
                $has_access = true;
            }
        }
        return $has_access;
    }
}
