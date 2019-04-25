<?php
namespace app\api\controller;

use think\Controller;

/**
 *
 */
class Address extends Controller
{

    public function postAddress()
    {
        $user_id = input('user_id');
        $address = input('post.');
        $model = model('Address');
        $res = $model->postAddress($user_id, $address);
        if ($res > 0) {
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
    public function getAddress()
    {
        $user_id = input('user_id');
        $model = model('Address');
        $res = $model->getAddress($user_id);
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
    public function setDefault()
    {
        $addr_id = input('addr_id');
        $user_id = input('user_id');
        $model = model('Address');
        $res = $model->setDefault($addr_id, $user_id);
        if ($res > 0) {
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
    public function delAddress()
    {
        $addr_id = input('addr_id');
        $model = model('address');
        $res = $model->delAddress($addr_id);
        if ($res > 0) {
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
    public function updateAddress()
    {
        $data = input('put.');
        $model = model('address');
        $res = $model->updateAddress($data);
        if ($res > 0) {
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
