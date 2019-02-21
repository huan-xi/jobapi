<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2019/2/20
 * Time: 11:05
 */

namespace app\lib\exception;


class NoValueException extends BaseException
{
    protected $statusCode = 400;
    protected $status = 20001;
    protected $msg = '没有查询结果';
}
