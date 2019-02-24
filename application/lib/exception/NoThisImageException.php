<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2019/2/21
 * Time: 21:43
 */

namespace app\lib\exception;


class NoThisImageException extends BaseException
{
    protected $statusCode = 400;
    protected $status = 40002;
    protected $msg = '没用该张图片';
}
