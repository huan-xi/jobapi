<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2019/2/20
 * Time: 11:05
 */

namespace app\lib\exception;


class TokenExpiresException extends BaseException
{
    protected $statusCode = 400;
    protected $status = 40001;
    protected $msg = 'Token过期或不存在';
}
