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

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});
Route::post('/valid', 'valid/valid_token'); //登录验证
Route::post('/login', 'user/login'); //登录
Route::post('/register', 'user/register'); //注册
Route::post('/goods_upload', 'goods/goods_upload'); //上架商品
Route::get('/getCategory', 'goods/getCategory'); //获取分类列表
Route::get('/goodslist/:id', 'goods/getgoodslist'); //获取商品列表
Route::get('/goodsinfo/:id', 'goods/getgoodsinfo'); //获取商品信息
Route::post('/updatepass', 'user/updatepass'); //修改密码
Route::post('/userinfo', 'user/setinfo'); //修改个人资料
Route::get('/getinfo/:token', 'user/getinfo'); //获取个人资料
Route::post('/comments', 'comments/commentSubmit'); //发表评论
Route::get('/getComments/:id', 'comments/getComments'); //获取评论
Route::get('/getCartList', 'cart/getCartList'); //获取购物车列表
Route::post('/postCart', 'cart/postCart'); //发送购物车列表
return [

];
