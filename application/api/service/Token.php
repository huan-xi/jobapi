<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2019/2/19
 * Time: 18:24
 */

namespace app\api\service;


use app\lib\exception\TokenExpiresException;
use think\Cache;

class Token
{
    public static function generateToken()
    {
        $rand = getRandChar(32);
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        $salt = config('secure.token_salt');
        return md5($rand . $timestamp . $salt);
    }

    public static function getId()
    {
        $token = request()->header('Token');
        $val=Cache::get($token);
        if (!$val){
            throw new TokenExpiresException();
        }else{
            if(!is_array($val)){
                $val=json_decode($val,true);
            }
        }
        return $val['openId'];
    }
}
