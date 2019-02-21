<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2019/2/20
 * Time: 12:51
 */

namespace app\api\service;

use Qiniu\Auth;

class QiniuAuth
{
    protected $accessKey = "oZ30WPkk-yxyFJ6xfyJtZ7GIDZgPTkdlRZK0M5xq";
    protected $secretKey = "94i3M0NYN2h-vb_0hSwstviYLR5jGDNDCAUAamA_";
    protected $bucket = "findjob";

    public function getUploadToken()
    {
        $auth=new Auth($this->accessKey, $this->secretKey);
        return $auth->uploadToken($this->bucket);
    }
}
