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
        $shop->head_src = $data['head_src'];
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


    public function deleteJob($id)
    {
        $job = JobModel::get($id);
        $job->save(['status'=>2]);
        return json(generateSuccessMsg("删除成功"));
    }
    public function deleteImage($id)
    {
        ImageModel::destroy($id);
        return json(generateSuccessMsg("删除成功"));
    }

    public function update()
    {
        $data = input("post.");
        JobModel::get($data['job_id'])->save(['job_desc' => $data['job_desc']]);
        return json(generateSuccessMsg("修改成功"));
    }

    public function addImage()
    {
        $data = input('post.');
        JobModel::get($data['job_id'])->images()->save(['src' => $data['src']]);
        return json(generateSuccessMsg("上传成功"));
    }
    //status
    public function getJobs($status)
    {
        $shop = $this->getShop();
        $data = input('get.');
        $jobs = $shop->jobs()->where(['status'=>$status])->page($data['page'], $data['size'])->select();
        return json(generateSuccessMsg($jobs));
    }

    public function addJob()
    {
        $id = Token::getId();
        $data = input("post.");
        $shop = ShopModel::get($id);
        $job = $shop->jobs()->save([
            'status' => 1,
            'create_time' => time(),
            'job_desc' => $data['desc'],
            'pv'=>0
        ])->find();
        $images = explode(",", $data['oosImages']);
        //保存图片
        for ($i = 0; $i < count($images); $i++) {
            $imagesData['src'] = $images[$i];
            $job->images()->save($imagesData);
        }
        return json(generateSuccessMsg('发布成功'));
    }
}
