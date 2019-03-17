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
    public static function saveTokenToCache($CachedValue)
    {
        $key = Token::generateToken();
        $value = json_encode($CachedValue);
        $token_expire_in = config('setting.token_expire_in');
        $res = cache($key, $value, $token_expire_in);
        if (!$res) {
            throw new Exception("服务器缓存异常");
        }
        return $key;
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
