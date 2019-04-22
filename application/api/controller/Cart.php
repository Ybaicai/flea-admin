<?php
namespace app\api\controller;

use think\Controller;

/**
 *
 */
class Cart extends Controller
{

    public function getCartList()
    {
        $user_id = input('get.user_id');
        $model = model('Cart');
        $res = $model->getCartList($user_id);
        if ($res) {
            $code = 200;
        } else {
            $code = 201;
        }
        $data = [
            'code' => $code,
            'data' => $res,
        ];
        return json($data);

    }
    public function postCart()
    {
        $data = input('post.');
        $ybc = 1;
        $model = model('Cart');
        $res = $model->postCart($data);
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
