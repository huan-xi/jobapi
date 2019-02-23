<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2019/2/19
 * Time: 18:05
 */

namespace app\api\model;


class UserModel extends BaseModel
{
    protected $pk='user_id';
    protected $name='user';
    protected $readonly=['create_time'];
}
