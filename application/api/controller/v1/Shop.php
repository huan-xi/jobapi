<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2019/2/19
 * Time: 21:23
 */

namespace app\api\controller\v1;

use app\api\model\ShopModel;
use  app\api\service\Token;
use app\api\validate\ShopInfoValidate;

class Shop extends BaseController
{
    public function getInfo()
    {
        $shop = ShopModel::get(Token::getId());
        $address = $shop->address()->find();
        if ($address){
            $shop['address']=$address->address;
            $shop['addressDesc']=$address->address_desc;
            $shop['latitude']=$address->latitude;
            $shop['longitude']=$address->longitude;
        }
        return $this->response(generateSuccessMsg($shop));
    }

    public function updateInfo()
    {
        $data = input("post.");
        (new ShopInfoValidate())->goCheck();
        //保存信息
        $shop = ShopModel::get(Token::getId());
        $shop->phone = $data['phone'];
        $shop->name = $data['name'];
        $shop->contacts = $data['contacts'];
        $shop->save();
        //保存地址
        $addressData = [
            'address_desc' => $data['addressDesc'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'address' => $data['address']
        ];
        $address = $shop->address()->find();
        if (!$address['address_id']) {
            $shop->address()->save($addressData);
        } else {
            $address->save($addressData);
        }
        return json(generateSuccessMsg("信息修改成功"));
    }
}
