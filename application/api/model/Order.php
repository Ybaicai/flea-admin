<?php
namespace app\api\model;

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
            $order_item = [
                'user_id' => $user_id,
                'order_no' => $order_no,
                'goods_id' => $item['Id'],
                'goods_name' => $item['name'],
                'goods_img' => $item['main_img'],
                'goods_price' => $item['price'],
                'goods_count' => $item['count'],
                'total_price' => $item['price'] * $item['count'],
                'create_time' => date('Y-m-d H:i:s', time()),
            ];
            $order = [
                'order_no' => $order_no,
                'user_id' => $user_id,
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
}
