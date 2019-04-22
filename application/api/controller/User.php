<?php
namespace app\api\controller;

use think\Controller;

//
class User extends Controller
{

    public function register()
    {

        $data = input('post.');
        $data['token'] = 'Bearer' . md5(time() . $data['password']);
        $data['expire_time'] = time() + 3600;
        $model = model('User');
        $res = $model->register($data);
        if ($res == 1) {
            $code = 200;
        } else if ($res == '用户名已存在') {
            $code = 0;
        } else {
            $code = 404;
        }
        $data = [
            'code' => $code,
            'data' => $res,
        ];
        return json($data);
    }
    public function login()
    {
        // $request = Request::instance();
        //$token = $request->header('Authorization');
        $data = input('post.');
        $token = 'Bearer' . md5(time() . $data['password']);
        $time_out = time() + 3600;
        $token_time = [
            'token' => $token,
            'expire_time' => $time_out,
        ];
        $model = model('User');
        $res = $model->login($data, $token_time);
        if ($res) {
            $code = 200;
        } else {
            $code = 404;
        }
        $data = [
            'code' => $code,
            'token' => $token,
            'data' => $res,
        ];
        return json($data);
    }
    public function updatepass()
    {
        $token = input('token');
        $oldpass = input('oldpass');
        $newpass = input('newpass');
        $model = model('User');
        $res = $model->updatepass($token, $oldpass, $newpass);
        if ($res) {
            $code = 200;
        } else {
            $code = 404;
        }
        $data = [
            'code' => $code,
            'data' => $res,
        ];
        return json($data);
    }
    public function getinfo()
    {
        $token = input('token');
        $model = model('User');
        $res = $model->getinfo($token);
        if ($res) {
            $code = 200;
        } else {
            $code = 404;
        }
        $data = [
            'code' => $code,
            'data' => $res,
        ];
        return json($data);
    }
    public function setinfo()
    {
        $files = request()->file();
        $upload = controller('Upload');
        $avatar = $upload->upload($files);
        $avatar = json_decode($avatar, true);
        $data = input('post.');
        $token = input('token');
        $data = [
            'avatar' => $avatar['0'],
            'username' => $data['username'],
            'tel' => $data['tel'],
            'sex' => $data['sex'],
        ];
        $model = model('User');
        $res = $model->setinfo($token, $data);
        if ($res) {
            $code = 200;
        } else {
            $code = 404;
        }
        $data = [
            'code' => $code,
            'data' => $res,
        ];
        return json($data);
    }
}
