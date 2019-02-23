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
Route::post('/shop/job', $version . '.Shop/addJob');
Route::post('/shop/job/update', $version . '.Shop/update');
Route::get('/shop/jobs/:status', $version . '.Shop/getJobs');
Route::get('/shop/job/delete/:id', $version . '.Shop/deleteJob',[],['id'=>'\d+']);
Route::get('/shop/job/:id', $version . '.Shop/getJobInfo',[],['id'=>'\d+']);
Route::post('/shop/job/image', $version . '.Shop/addImage');
Route::get('/shop/job/image/delete/:id', $version . '.Shop/deleteImage');
Route::get('/jobs', $version . '.Job/getJobs');
Route::get('/job/:id', $version . '.Job/getJobInfo',[],['id'=>'\d+']);
Route::get('/value/:key', $version . '.Value/getValue');
Route::get('/test', $version . '.index/index');
