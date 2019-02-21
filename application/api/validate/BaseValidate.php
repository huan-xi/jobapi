<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2019/2/19
 * Time: 22:16
 */

namespace app\api\validate;


use think\Exception;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        $param = request()->param();
        $res = $this->check($param);
        if ($res) {
            $error = $this->error;
            throw new Exception($error);
        }
        return true;
    }
}
