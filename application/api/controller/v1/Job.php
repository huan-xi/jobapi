<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2019/2/20
 * Time: 12:28
 */

namespace app\api\controller\v1;

use app\api\model\JobModel;

class Job extends BaseController
{


    public function getJobInfo($id)
    {
        $job = JobModel::with("shop,images")->find($id);
        $pv = $job['pv'];
        $job->save(['pv' => $pv + 1]);
        $job->shop = $job->shop->withAddress();
        return json(generateSuccessMsg($job));
    }

    public function getJobs()
    {
        $data = input('get.');
        $key=$data['key'];
        $jobs = (new JobModel())->with("images")->where(['status' => 1])
            ->where('job_desc','like','%'.$key.'%')
            ->order("create_time","desc")
            ->page($data['page'], $data['size'])->select();
        foreach ($jobs as $job) {
            //增加浏览量
            $pv = $job['pv'];
            $job->save(['pv' => $pv + 1]);
            $shop = $job->shop()->find();
            $shop->withAddress();
            $job['shop'] = $shop;
        }
        $msg['total'] = (new JobModel())->where(['status' => 1])
            ->where('job_desc','like','%'.$key.'%')
            ->count();
        $msg['rows'] = $jobs;
        return json(generateSuccessMsg($msg));
    }

}
