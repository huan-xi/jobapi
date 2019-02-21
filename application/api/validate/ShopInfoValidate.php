<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2019/2/19
 * Time: 22:11
 */

namespace app\api\validate;


class ShopInfoValidate extends BaseValidate
{
    protected $rule = [
        'name' => 'require|length:4,20',
        'contacts'=> 'require|length:2,7',
        'phone' => 'require|number|length:10'
    ];
}
