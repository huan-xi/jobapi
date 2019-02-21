<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2019/2/20
 * Time: 14:39
 */

namespace app\api\model;


class ImageModel extends BaseModel
{
    protected $name="image";
    protected $pk="image_id";
    protected $hidden=['job_id'];
}
