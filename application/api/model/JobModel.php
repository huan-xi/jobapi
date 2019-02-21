<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2019/2/20
 * Time: 12:28
 */

namespace app\api\model;


class JobModel extends BaseModel
{
    protected $name = 'job';
    protected $pk = 'job_id';
    protected $hidden = ['shop_id'];

//    属于一个商家
    public function shop()
    {
        return $this->belongsTo('ShopModel','shop_id','shop_id');
    }

//    有多张图片
    public function images()
    {
        return $this->hasMany('ImageModel');
    }
}
