<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2019/2/20
 * Time: 10:41
 */

namespace app\lib\exception;


use Exception;
use think\exception\Handle;

class ExceptionHandler extends Handle
{
    protected $statusCode = 500;
    protected $status = 500;
    protected $msg = '服务器异常';

    public function render(Exception $e)
    {
        if ($e instanceof BaseException) {
            //自定义异常
            $this->statusCode = $e->getStatusCode();
            $this->status = $e->getStatus();
            $this->msg = $e->getMsg();
        } else {
            $this->msg = "服务器异常，请联系管理员";
        }
        return json([
            'status' => $this->status,
            'msg' => $this->msg,
        ], $this->statusCode);
    }
}
