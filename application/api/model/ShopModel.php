<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2019/2/19
 * Time: 18:06
 */

namespace app\api\model;


class ShopModel extends BaseModel
{
    protected $hidden = ['shop_id', 'create_time', 'status'];
    protected $name = 'shop';
    protected $pk = 'shop_id';

//    发布多个工作
    public function jobs()
    {
    return $this->hasMany('JobModel');
    }

//    一个商家有一个地址
    public function address()
    {
        return $this->hasOne('AddressModel');
    }
}
