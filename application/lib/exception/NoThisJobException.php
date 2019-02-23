<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2019/2/21
 * Time: 21:43
 */

namespace app\lib\exception;


class NoThisJobException extends BaseException
{
    protected $statusCode = 400;
    protected $status = 30001;
    protected $msg = '没用该工作的操作权限';
}
