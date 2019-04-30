<?php
namespace app\api\model;

use think\Db;
use think\Model;

/**
 *
 */
class Cart extends Model
{

    public function getCartList($user_id)
    {
        $cartList = [];
        $user = User::find($user_id);
        $carts = $user->cart;
        if ($carts->isEmpty()) {
            return $carts;
        } else {
            foreach ($carts as $cart) {
                $goods_id = $cart->goods_id;
                $goods_info = Goods::find($goods_id);
                $goods_info->hidden(['detail', 'update_time', 'category_id'])->toArray();
                $goods_info['count'] = $cart->count;
                array_push($cartList, $goods_info);
            }
            return $cartList;
        }
    }
    public function postCart($data)
    {
        Db::name('cart')->where('user_id', $data['0']['user_id'])->delete();
        foreach ($data as $value) {
            $cart = [
                'count' => $value['count'],
                'user_id' => $value['user_id'],
                'goods_id' => $value['goods_id'],
            ];
            $res = Db::name('cart')->insert($cart);
        }
        return $res;
    }
    public function clearCart($goods_ids)
    {
        foreach ($goods_ids as $goods_id) {
            $res = Db('cart')->where('goods_id', $goods_id)->delete();
        }
        return $res;
    }
}
