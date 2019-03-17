<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2019/3/17
 * Time: 14:35
 */

namespace app\api\controller\v1;


/**
 * 文件处理
 * Class Upload
 * @package app\api\controller\v1
 */
class Upload extends BaseController
{
    public function uploadImage()
    {
        $file = request()->file('image');
        $info = $file->validate(['size' => 5024000])->move(config('c.images_path'));
//        if (!$file) return json(404,generateMsg(0,"no image upload"));
        if ($info)
            return json(generateSuccessMsg($info->getSaveName()));
        else
            return json(generateMsg(400, $file->getError()), 400);
    }
}
