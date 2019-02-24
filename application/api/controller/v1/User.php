<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2019/2/23
 * Time: 13:47
 */

namespace app\api\controller\v1;


use app\api\model\UserModel;
use app\api\service\Token;
use think\Db;

class User extends BaseController
{
    public function getInfo()
    {
        return json(generateSuccessMsg(UserModel::get(Token::getId())));
    }
    public function goodJob($jobId){
        $user_id=Token::getId();
        $job=Db::table('good')
            ->where('user_id','=',$user_id)
            ->where('job_id','=',$jobId)->find();
        if ($job) return json(generateMsg(0,"已经点过赞了"));
        $user=UserModel::get($user_id);
        $user->goodJob()->save($jobId);
        return json(generateSuccessMsg('点赞成功'));
    }
    public function update(){
        $data=input("post.");
        $user=UserModel::get(Token::getId());
        $user->save([
            'name'=>$data['name'],
            'phone'=>$data['phone'],
            'info'=>$data['types'],
            'head_src'=>$data['head_src'],
        ]);
        return json(generateSuccessMsg("修改成功"));
    }
}
