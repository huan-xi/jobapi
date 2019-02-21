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
        $job=JobModel::with("shop,images")->find($id);
        $job->shop=$job->shop->withAddress();
        return json(generateSuccessMsg($job));
    }

    public function getJobs()
    {
        $data = input('get.');
        $jobs = (new JobModel())->where(['status' => 1])->page($data['page'], $data['size'])->select();
        for($i=0;$i<count($jobs);$i++){
            $shop=$jobs[$i]->shop()->find();
            $shop->withAddress();
            $jobs[$i]['shop']=$shop;
        }
        $msg['total']= (new JobModel())->where(['status' => 1])->count();
        $msg['rows']=$jobs;
        return json(generateSuccessMsg($msg));
    }

}
