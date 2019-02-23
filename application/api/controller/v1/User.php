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
class User extends BaseController
{
    public function getInfo()
    {
        return json(generateSuccessMsg(UserModel::get(Token::getId())));
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
