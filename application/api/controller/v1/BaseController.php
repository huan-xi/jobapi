<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2018/10/4
 * Time: 19:10
 */
namespace app\api\controller\v1;
use app\api\model\ShopModel;
use think\controller\Rest;
use think\Request;

class BaseController extends Rest {
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
    }
    public function getShop(){
        return ShopModel::get(\app\api\service\Token::getId());
    }
}
