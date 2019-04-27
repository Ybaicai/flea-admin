<?php
namespace app\api\controller;

use think\Controller;

/**
 *
 */
class Order extends Controller
{

    public function submitOrder()
    {
        $user_id = input('user_id');
        $address_id = input('address_id');
        $goodsInfo = input('goodsInfo');
        $status = input('status');
        $model = model('Order');
        $res = $model->submitOrder($user_id, $address_id, $goodsInfo, $status);

        return json($res);
    }
}
