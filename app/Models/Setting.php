<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = "general_setting";

    protected $fillable = ['sitetitle','email','about','social'];

    public $timestamps = false;

    public static $folder = 'images/setting/';

    public static $rules = [
        'sitetitle' => 'required',
        'email'     => 'required|email',
        'about' => 'required',
        'logo' => 'image',
        'facebook'    => 'required',
        'gplus'    => 'required',
        'twitter'    => 'required',
        'instagram'    => 'required',
    ];

    public function getAboutTextAttribute(){
        $info = unserialize($this->about);
        return $info['text'];
    }


    public function getAboutImg(){
        $info = unserialize($this->about);
        return $info['img'];
    }

    public function getAboutImgUrl(){
        return asset(self::$folder . $this->getAboutImg());
    }

    public function getFacebookAttribute(){
        $info = unserialize($this->social);
        return $info['facebook'];
    }

    public function getTwitterAttribute(){
        $info = unserialize($this->social);
        return $info['twitter'];
    }

    public function getGplusAttribute(){
        $info = unserialize($this->social);
        return $info['google-plus'];
    }

    public function getInstagramAttribute(){
        $info = unserialize($this->social);
        return (isset($info['instagram'])) ? $info['instagram'] : '';
    }

    public function saveItem($request){
        $social = serialize([
            'facebook'      => $request->input('facebook'),
            'google-plus'   => $request->input('gplus'),
            'twitter'       => $request->input('twitter'),
            'instagram'      => $request->input('instagram')
        ]);

        $filename = $this->logo;
        $image = $request->file('logo');
        if(!empty($image)){
            $filename = time() . '.' . $image->getClientOriginalExtension();
            \Image::make($image)
                ->save( public_path(self::$folder . $filename ) );
        }
        $this->logo = $filename; 
        $this->fill($request->input());
        $this->social = $social;
        $this->save();
    }

    public function getLogoUrl(){
        return asset(self::$folder . $this->logo);
    }

}
