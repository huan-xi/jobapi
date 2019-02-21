<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2019/2/20
 * Time: 12:28
 */

namespace app\api\controller\v1;

use app\api\model\ImageModel;
use app\api\model\JobModel;
use app\api\model\ShopModel;
use app\api\service\Token;
use think\response\Json;

class Job extends BaseController
{

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

    public function getJobInfo($id)
    {
        $job = JobModel::get($id);
        if ($job) $job['images'] = $job->images()->select();
        return json(generateSuccessMsg($job));
    }

    public function deleteJob($id)
    {
        $job = JobModel::get($id);
        $job->save(['status'=>2]);
        return json(generateSuccessMsg("删除成功"));
    }

    public function getJobs()
    {
        $shop = $this->getShop();
        $data = input('get.');
        $jobs = $shop->jobs()->page($data['page'], $data['size'])->select();
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
            'job_desc' => $data['desc']
        ])->find();
        $images = explode(",", $data['oosImages']);
        for ($i = 0; $i < count($images); $i++) {
            $imagesData['src'] = $images[$i];
            $job->images()->save($imagesData);
        }
        return json(generateSuccessMsg('发布成功'));
    }
}
