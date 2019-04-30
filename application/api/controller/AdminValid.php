<?php
namespace app\api\controller;

use think\Controller;
use think\Db;

/**
 *
 */
class AdminValid extends Controller
{
    public function valid_token()
    {
        $token = input('token');
        if (empty($token)) {
            return json(['code' => 201, 'msg' => '亲，要先登录哦！']);
        }
        $res = Db::name('admin_user')->where('token', $token)->find();
        if (empty($res)) {
            return json(['code' => 202, 'msg' => '用户无效！']);
        }
        if (time() > $res['expire_time']) {
            return json(['code' => 203, 'msg' => '亲，登录已过期，重新登陆一下吧！']);
        }
        return json($res);
    }
}
