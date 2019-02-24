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
        'name' => 'require|min:9',
        'contacts'=> 'require|min:6',
        'phone' => 'require|number|length:11',
        'head_src' => 'require',
        'latitude' => 'require',
        'longitude' => 'require',
        'address' => 'require',
        'addressDesc' => 'require',
    ];
}
