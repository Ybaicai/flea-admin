<?php
namespace app\api\model;

use think\Db;
use think\Model;

/**
 *
 */
class Order extends Model
{
    public function submitOrder($user_id, $address_id, $goodsInfo, $status)
    {
        $order_no = time();
        if ($status === 1) {
            $payment_tiem = date('Y-m-d H:i:s', time());
        } else {
            $payment_tiem = null;
        }
        foreach ($goodsInfo as $item) {
            $shopkeeper_id = Db('goods')->where('Id', $item['Id'])->value('user_id');
            $order_item = [
                'user_id' => $user_id,
                'shopkeeper_id' => $shopkeeper_id,
                'order_no' => $user_id . $order_no . $item['Id'],
                'goods_id' => $item['Id'],
                'goods_name' => $item['name'],
                'goods_img' => $item['main_img'],
                'goods_price' => $item['price'],
                'goods_count' => $item['count'],
                'total_price' => $item['price'] * $item['count'],
                'create_time' => date('Y-m-d H:i:s', time()),
            ];
            $order = [
                'order_no' => $order_item['order_no'],
                'user_id' => $user_id,
                'shopkeeper_id' => $shopkeeper_id,
                'address_id' => $address_id,
                'payment_time' => $payment_tiem,
                'status' => $status,
                'create_time' => date('Y-m-d H:i:s', time()),

            ];
            $res = Db('order_item')->insert($order_item);
            if ($res) {
                $res = Db('order')->insert($order);
            }
        }
        return $res;
    }
    public function getOrder($user_id)
    {
        $orders = Db('order')->where('user_id', $user_id)->select();
        $res = [];
        foreach ($orders as $order) {
            $order_item = Db('order_item')->where('order_no', $order['order_no'])->select();
            $address = Db('address')->where('Id', $order['address_id'])->select();
            $order['order_item'] = $order_item;
            $order['address'] = $address;
            array_push($res, $order);
        }
        return $res;
    }
    public function getSaleOrder($user_id)
    {
        $orders = Db('order')->where('shopkeeper_id', $user_id)->select();
        $res = [];
        foreach ($orders as $order) {
            $order_item = Db('order_item')->where('order_no', $order['order_no'])->select();
            $address = Db('address')->where('Id', $order['address_id'])->select();
            $order['order_item'] = $order_item;
            $order['address'] = $address;
            array_push($res, $order);
        }
        return $res;
    }
    public function delOrder($orders)
    {
        foreach ($orders as $order) {
            $order_no = $order['order_no'];
            $res = Db('order')->where('order_no', $order_no)->delete();
            if ($res > 0) {
                $res = Db('order_item')->where('order_no', $order_no)->delete();
            } else {
                $res = 0;
            }
        }
        return $res;
    }
    public function pay($order_no)
    {
        $res = Db('order')->where('order_no', $order_no)->update(['status' => 1, 'payment_time' => date('Y-m-d H:i:s', time())]);
        return $res;
    }
}
