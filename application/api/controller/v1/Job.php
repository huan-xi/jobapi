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
        $job = JobModel::get($id);
        if ($job) $job['images'] = $job->images()->select();
        return json(generateSuccessMsg($job));
    }

    public function getJobs()
    {
        $data = input('get.');
        $jobs = JobModel::with('shop')->where(['status' => 1])->page($data['page'], $data['size'])->select();
        $msg['total']= (new JobModel())->where(['status' => 1])->count();
        $msg['rows']=$jobs;
        return json(generateSuccessMsg($msg));
    }

}
