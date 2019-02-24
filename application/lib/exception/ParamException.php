<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2019/2/24
 * Time: 17:18
 */

namespace app\lib\exception;



class ParamException extends  BaseException
{
    protected $statusCode=400;
    protected $code=1000;
    public function __construct($msg)
    {
        $this->msg=$msg;
    }
}
