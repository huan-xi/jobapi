<?php

namespace app\api\controller\v1;

use app\api\model\SystemValueModel;
use app\api\model\UserModel;

class Index extends BaseController
{
    public function initSystemInfo()
    {
        SystemValueModel::create([
            's_key' => 'KF_NAME',
            's_value' => '客服称呼'
        ]);
        SystemValueModel::create([
            's_key' => 'KF_PHONE',
            's_value' => '17680605745'
        ]);
        SystemValueModel::create([
            's_key' => 'NOTICE_USER',
            's_value' => '用户端端公告测试'
        ]);
        SystemValueModel::create([
            's_key' => 'NOTICE_SHOP',
            's_value' => '工厂端公告测试'
        ]);
        $banner = json_encode(['image' => 'https://oss.shebuluo.cn/ben4rkq10ah.jpg', 'src' => 'www.baidu.com']);
        SystemValueModel::create([
            's_key' => 'BANNER',
            's_value' => $banner
        ]);
        $banner = json_encode(['image' => 'https://oss.shebuluo.cn/st93.png', 'src' => 'www.baidu1.com']);
        SystemValueModel::create([
            's_key' => 'BANNER',
            's_value' => $banner
        ]);
        $banner = json_encode(['image' => 'https://oss.shebuluo.cn/ben4rkq10ah.jpg', 'src' => 'www.baidu2.com']);
        SystemValueModel::create([
            's_key' => 'BANNER',
            's_value' => $banner
        ]);
    }

    public function setTypes()
    {
        SystemValueModel::create([
            's_key' => 'TYPES',
            's_value' => '工种一'
        ]);
        SystemValueModel::create([
            's_key' => 'TYPES',
            's_value' => '工种二'
        ]);
        SystemValueModel::create([
            's_key' => 'TYPES',
            's_value' => '工种三'
        ]);
        SystemValueModel::create([
            's_key' => 'TYPES',
            's_value' => '工种四'
        ]);
    }

    public function index()
    {
        $user=UserModel::get("oDA_c4joQrfXIdrfwtecmyRuQzUk");
        $user->goodJob()->save(2);
//        $this->setTypes();
//        $this->initSystemInfo();
    }
}
