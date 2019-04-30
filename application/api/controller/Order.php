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
    public function getOrder()
    {
        $user_id = input('user_id');
        $model = model('Order');
        $res = $model->getOrder($user_id);
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
    public function getSaleOrder()
    {
        $user_id = input('user_id');
        $model = model('Order');
        $res = $model->getSaleOrder($user_id);
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
    public function delOrder()
    {
        $orders = input('post.');
        $model = model('Order');
        $res = $model->delOrder($orders);
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
    public function pay()
    {
        $order_no = input('order_no');
        $model = model('Order');
        $res = $model->pay($order_no);
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
