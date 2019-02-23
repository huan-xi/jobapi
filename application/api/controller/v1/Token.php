<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2019/2/19
 * Time: 16:48
 */

namespace app\api\controller\v1;

use app\api\service\QiniuAuth;
use app\api\service\UserToken;

class Token extends BaseController
{
    public function getShopToken($code = '')
    {
        $token = (new UserToken($code))->get();
        return $this->response(generateMsg(1, $token));
    }
    public function getUserToken($code = '')
    {
        $token = (new UserToken($code,'u'))->get();
        return $this->response(generateMsg(1, $token));
    }

    public function getUploadToken()
    {
        return json([
            'uptoken' => (new QiniuAuth())->getUploadToken()
        ]);
    }
}
