<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

$version = "v1";


Route::post('/token/shop', $version . '.Token/getShopToken');
Route::get('/token/upload', $version . '.Token/getUploadToken');
Route::post('/shop/info', $version . '.Shop/updateInfo');
Route::get('/shop/info', $version . '.Shop/getInfo');
Route::post('/job', $version . '.Job/addJob');
Route::post('/job/update', $version . '.Job/update');
Route::get('/jobs', $version . '.Job/getJobs');
Route::get('/job/:id', $version . '.Job/getJobInfo',[],['id'=>'\d+']);
Route::get('/job/delete/:id', $version . '.Job/deleteJob',[],['id'=>'\d+']);
Route::post('/job/image', $version . '.Job/addImage');
Route::get('/job/image/delete/:id', $version . '.Job/deleteImage');
Route::get('/value/:key', $version . '.Value/getValue');
Route::get('/test', $version . '.index/index');
