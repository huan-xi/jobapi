<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2019/2/20
 * Time: 11:18
 */

namespace app\api\controller\v1;
use app\api\model\SystemValueModel;
use app\lib\exception\NoValueException;

class Value extends BaseController
{
    public function getValue($key)
    {
       $value=SystemValueModel::get(['s_key'=>$key]);
       if (!$value) throw new NoValueException();
       return json(generateSuccessMsg($value['s_value']));
    }
}
