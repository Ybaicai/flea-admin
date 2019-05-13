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
Route::get('/getPutList/:user_id', 'goods/getPutList'); //获取已上架商品列表
Route::get('/getDownList/:user_id', 'goods/getDownList'); //获取已下架商品列表
Route::put('/downGoods/:goods_id_down', 'goods/downGoods'); //下架商品
Route::put('/upGoods/:goods_id_up', 'goods/upGoods'); //上架商品
Route::post('/goodsUpdate', 'goods/updateGoods'); //修改商品信息
Route::post('/postAddress/:user_id', 'address/postAddress'); //添加收货地址
Route::get('/getAddress/:user_id', 'address/getAddress'); //获取收货地址
Route::put('/setDefault/:addr_id', 'address/setDefault'); //设置默认收货地址
Route::delete('/delAddress/:addr_id', 'address/delAddress'); //删除收货地址
Route::put('/updateAddress', 'address/updateAddress'); //修改收货地址
Route::post('/order', 'order/submitOrder'); //提交订单
Route::get('/getOrder/:user_id', 'order/getOrder'); //获取购买商品的订单
Route::get('/getSaleOrder/:user_id', 'order/getSaleOrder'); //获取销售商品的订单
Route::post('/delOrder', 'order/delOrder'); //删除订单
Route::put('/pay/:order_no', 'order/pay'); //支付
Route::post('/clearCart', 'cart/clearCart'); //删除购物车中已结算商品

Route::post('/admin_valid', 'adminValid/valid_token'); //管理员登录验证
Route::post('/admin_login', 'adminUser/login'); //管理员登录
Route::post('/admin_register', 'adminUser/register'); //管理员注册
Route::post('/admin_updatepass', 'adminUser/updatepass'); //管理员修改密码
Route::post('/admin_userinfo', 'adminUser/setinfo'); //管理员修改个人资料
Route::get('/admin_getinfo/:token', 'adminUser/getinfo'); //管理员获取个人资料
Route::get('/getUser', 'adminUser/getUser'); //获取注册用户列表
Route::put('/bannedUser/:user_id', 'adminUser/bannedUser'); //封禁用户
Route::put('/unbanUser/:user_id', 'adminUser/unbanUser'); //解封用户
Route::post('/delUser', 'adminUser/delUser'); //删除用户
Route::post('/addCategory', 'adminUser/addCategory'); //添加分类
Route::post('/delCategory', 'adminUser/delCategory'); //删除分类
Route::put('/updateCategory', 'adminUser/updateCategory'); //删除分类
Route::get('/getAllUp', 'adminUser/getAllUP'); //获取已上架商品
Route::get('/getAllDown', 'adminUser/getAllDown'); //获取已下架商品
Route::post('/delGoods', 'adminUser/delGoods'); //删除商品
Route::put('/upSelectGoods', 'adminUser/upSelectGoods'); //批量上架商品
Route::put('/downSelectGoods', 'adminUser/downSelectGoods'); //批量下架商品
Route::get('/getAllOrder', 'adminUser/getAllOrder'); //获取所有订单
Route::post('/setSwiper', 'adminUser/setSwiper'); //设置轮播商品
Route::get('/getSwiper', 'adminUser/getSwiper'); //获取轮播列表
Route::post('/delSwiper', 'adminUser/delSwiper'); //删除轮播图
Route::post('/setSpecial', 'adminUser/setSpecial'); //设为特价商品
Route::post('/cancelSpecial', 'adminUser/cancelSpecial'); //取消特价
Route::get('/getSpecial', 'adminUser/getSpecial'); //获取特价商品

return [

];
