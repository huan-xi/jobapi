<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2019/2/24
 * Time: 16:56
 */

namespace app\api\validate;


class PageValidate extends BaseValidate
{
    protected $rule = [
        'page' => 'require|integer',
        'size'=> 'require|integer|elt:20',
    ];
}
