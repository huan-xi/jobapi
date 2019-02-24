<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2019/2/19
 * Time: 21:23
 */

namespace app\api\controller\v1;

use app\api\model\ImageModel;
use app\api\model\JobModel;
use app\api\model\ShopModel;
use  app\api\service\Token;
use app\api\validate\PageValidate;
use app\api\validate\ShopInfoValidate;
use app\lib\exception\NoThisJobException;
use app\lib\exception\ParamException;
use think\Db;

class Shop extends BaseController
{
    private function checkJob($job)
    {
        $shop_id = Token::getId();
        if ($job && $job['shop_id'] != $shop_id) throw new NoThisJobException();
    }

    private function checkImage($image)
    {
        //判断商家是否有该图片操作权限
        if ($image) {
            $job = JobModel::get($image->job_id);
            $this->checkJob($job);
        } else {
            return json(generateMsg(4010, "该图片不存在"));
        }
    }

    public function getInfo()
    {
        $shop = ShopModel::get(Token::getId());
        $address = $shop->address()->find();
        if ($address) {
            $shop['address'] = $address->address;
            $shop['addressDesc'] = $address->address_desc;
            $shop['latitude'] = $address->latitude;
            $shop['longitude'] = $address->longitude;
        }
        return $this->response(generateSuccessMsg($shop));
    }

    public function getJobInfo($id)
    {
        $job = JobModel::get($id);
        if ($job) $job['images'] = $job->images()->select();
        return json(generateSuccessMsg($job));
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

    public function destroyJob($id)
    {
        $job=JobModel::get($id);
        $this->updateJobStatus($job, 3);
        return json(generateSuccessMsg("删除成功"));
    }

    private function updateJobStatus($job, $status)
    {
        $this->checkJob($job);
        $job->save(['status' => $status]);
    }

    public function deleteJob($id)
    {
        $job=JobModel::get($id);
        $this->updateJobStatus($job, 2);
        return json(generateSuccessMsg("删除成功"));
    }

    public function changeJobStatus($id)
    {
        $job = JobModel::get($id);
        $this->checkJob($job);
        $status = input("get.")['status'];
        if (in_array($status, array(1, 2, 3)))
            $job->save(['status' => $status]);
        else throw new ParamException("状态值错误");
        return json(generateSuccessMsg("修改成功"));
    }

    public function republicJob($id)
    {
        $job=JobModel::get($id);
        $this->updateJobStatus($job,1);
        $job->save(['create_time'=>time()]);
        return json(generateSuccessMsg("重新发布成功"));
    }

    public function deleteImage($id)
    {
        $image = ImageModel::get($id);
        $this->checkImage($image);
        ImageModel::destroy($id);
        return json(generateSuccessMsg("删除成功"));
    }

    public function update()
    {
        $data = input("post.");
        $job = JobModel::get($data['job_id']);
        $this->checkJob($job);
        $job->save(['job_desc' => $data['job_desc']]);
        return json(generateSuccessMsg("修改成功"));
    }

    public function addImage()
    {
        $data = input('post.');
        $job = JobModel::get($data['job_id']);
        $this->checkJob($job);
        $job->images()->save(['src' => $data['src']]);
        return json(generateSuccessMsg("上传成功"));
    }

    public function getJobs($status)
    {
        $shop = $this->getShop();
        $data = input('get.');
        (new PageValidate())->goCheck();
        $jobs = $shop->jobs()->where(['status' => $status])
            ->order("create_time", "desc")
            ->page($data['page'], $data['size'])
            ->select();
        foreach ($jobs as $job) {
            $count = Db::table("good")->where("job_id", '=', $job->job_id)->count();
            $job->good = $count;
        }
        $msg['total'] = $shop->jobs()->where(['status' => $status])->count();
        $msg['rows'] = $jobs;
        return json(generateSuccessMsg($msg));
    }

    public function addJob()
    {
        $id = Token::getId();
        $data = input("post.");
        $shop = ShopModel::get($id);
        //判断是否填写信息
        $shop->checkCompletion();
        $job = $shop->jobs()->save([
            'status' => 1,
            'create_time' => time(),
            'job_desc' => $data['desc'],
            'pv' => 0
        ]);
        $images = explode(",", $data['ossImages']);
        //保存图片
        for ($i = 0; $i < count($images); $i++) {
            $imagesData['src'] = $images[$i];
            if ($imagesData['src']) $job->images()->save($imagesData);
        }
        return json(generateSuccessMsg('发布成功'));
    }
}
