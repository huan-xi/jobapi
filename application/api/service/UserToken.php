<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2019/2/19
 * Time: 17:08
 */

namespace app\api\service;


use app\api\model\ShopModel;
use app\api\model\UserModel;
use think\Exception;

class UserToken
{
    protected $code;
    protected $wxAppId;
    protected $wxAppSecret;
    protected $wxLoginUrl;
    protected $mode;
    /**
     * UserToken constructor.
     * @param $code
     * @param $mode u 获取用户 默认商家
     */
    function __construct($code, $mode = '')
    {
        $this->mode=$mode;
        if ($mode == 'u') {
            $this->wxAppId = config('wx.user_app_id');
            $this->wxAppSecret = config('wx.user_app_secret');
        } else {
            $this->wxAppId = config('wx.shop_app_id');
            $this->wxAppSecret = config('wx.shop_app_secret');
        }
        $this->code = $code;
        $this->wxLoginUrl = sprintf(config('wx.openid_url'), $this->wxAppId, $this->wxAppSecret, $this->code);
    }

    public function get()
    {
        $res = curl_get($this->wxLoginUrl);
        $wxRes = json_decode($res, true);
        if (empty($wxRes)) {
            throw new Exception('获取openIds时异常,微信内部错误');
        } else {
            $loginFail = array_key_exists('errcode', $wxRes);
            if ($loginFail) {
                $this->processLoginError($wxRes);
            } else {
                return $this->grantToken($wxRes);
            }
        }
    }

    private function processLoginError($wxRes)
    {
        new Exception($wxRes);
    }

    /*
     * 授权Token
     * 1. 获取openId
     * 2. 判断用户
     * 3， 不存在新增
     * 4. 生成令牌，写入缓存
     * */
    private function grantToken($wxRes)
    {
        $openid = $wxRes['openid'];
        if($this->mode=="u"){
            //用户模式
            $shop = UserModel::get($openid);
            if (!$shop) UserModel::create(['user_id' => $openid,
                'status'=>'1',
                'create_time'=>time()]);
        }else{
            //商家模式
            $shop = ShopModel::get($openid);
            if (!$shop) ShopModel::create(['shop_id' => $openid,
                'status'=>'1',
                'create_time'=>time()]);
        }
        $key = Token::saveTokenToCache($this->prepareCachedValue($openid));
        return $key;
    }

    private function prepareCachedValue($openid)
    {
        $cachedValue = [];
        $cachedValue['openId'] = $openid;
        $cachedValue['scope'] = 16;
        return $cachedValue;
    }

}
