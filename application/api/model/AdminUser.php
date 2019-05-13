<?php
namespace app\api\model;

use think\Db;
use think\Model;

/**
 *
 */
class AdminUser extends Model
{
    public function register($data)
    {
        $res = Db::name('admin_user')->where('username', $data['username'])->find();
        if ($res) {
            return '用户名已存在';
        }
        $res = Db::name('admin_user')->insert($data);
        return $res;
    }
    public function login($data, $token_time)
    {
        $where = [
            'username' => $data['username'],
            'password' => $data['password'],
        ];
        $res = Db::name('admin_user')->where($where)->find();
        if ($res) {
            Db::name('admin_user')->where($where)->update($token_time);
        }
        return $res;
    }
    public function updatepass($token, $oldpass, $newpass)
    {
        $res = Db('admin_user')->where('token', $token)->where('password', $oldpass)->find();
        if ($res) {
            $res = Db('admin_user')->where('token', $token)->update(['password' => $newpass]);
        }
        return $res;
    }
    public function getinfo($token)
    {
        $res = Db('admin_user')->where('token', $token)->find();
        return $res;
    }
    public function setinfo($token, $data)
    {
        $res = Db('admin_user')->where('token', $token)->update($data);
        return $res;
    }
    public function getUser()
    {
        $res = Db('user')->select();
        return $res;
    }
    public function bannedUser($user_id) //封禁用户

    {
        $res = Db('user')->where('Id', $user_id)->update(['status' => 2]);
        return $res;
    }
    public function unbanUser($user_id) //解封用户

    {
        $res = Db('user')->where('Id', $user_id)->update(['status' => 1]);
        return $res;
    }
    public function delUser($users)
    {
        foreach ($users as $user) {
            $user_id = $user['Id'];
            $res = Db('user')->where('Id', $user_id)->delete();
        }
        return $res;
    }

    //添加分类
    public function addCategory($category_name)
    {
        $res = Db('category')->where('category_name', $category_name)->find();
        if ($res) {
            return 201;
        } else {
            Db('category')->insert(['category_name' => $category_name]);
            return 200;
        }

    }

    //删除分类
    public function delCategory($categorys)
    {
        foreach ($categorys as $category) {
            $category_id = $category['Id'];
            $res = Db('category')->where('Id', $category_id)->delete();
        }
        return $res;
    }

    //修改分类
    public function updateCategory($category_id, $category_name)
    {
        $res = Db('category')->where('Id', $category_id)->update(['category_name' => $category_name]);
        return $res;
    }

    //获取已上架商品
    public function getAllUp()
    {
        $upList = Goods::where('status', 1)->select();
        foreach ($upList as $value) {
            $album = $value->album->hidden(['Id', 'goods_id']);
            $value['album'] = $album;
        }
        return $upList;
    }

    //获取已下架商品
    public function getAllDown()
    {
        $downList = Goods::where('status', 2)->select();
        foreach ($downList as $value) {
            $album = $value->album->hidden(['Id', 'goods_id']);
            $value['album'] = $album;
        }
        return $downList;
    }

    //删除商品
    public function delGoods($goodsList)
    {
        foreach ($goodsList as $goods) {
            $res = Db('goods')->where('Id', $goods['Id'])->delete();
            Db('comments')->where('goods_id', $goods['Id'])->delete();
            Db('album')->where('goods_id', $goods['Id'])->delete();
        }
        return $res;
    }

    //批量上架商品
    public function upSelectGoods($goodsList)
    {
        foreach ($goodsList as $goods) {
            $res = Db('goods')->where('Id', $goods['Id'])->update(['status' => 1]);
        }
        return $res;
    }

    //批量下架商品
    public function downSelectGoods($goodsList)
    {
        foreach ($goodsList as $goods) {
            $res = Db('goods')->where('Id', $goods['Id'])->update(['status' => 2]);
        }
        return $res;
    }

    //获取所有订单
    public function getAllOrder()
    {
        $orderList = Db('order')->select();
        $res = [];
        foreach ($orderList as $order) {
            $order_no = $order['order_no'];
            $order_item = Db('order_item')->where('order_no', $order_no)->select();
            $address = Db('address')->where('Id', $order['address_id'])->select();
            $buyer = Db('user')->where('Id', $order['user_id'])->find();
            $shopkeeper = Db('user')->where('Id', $order['shopkeeper_id'])->find();
            $order['order_item'] = $order_item;
            $order['address'] = $address;
            $order['buyer'] = $buyer['username'];
            $order['shopkeeper'] = $shopkeeper['username'];
            array_push($res, $order);
        }
        return $res;
    }

    //获取销售额
    public function getSalesReport()
    {

    }

    //获取销量
    public function getSalesQuantity()
    {

    }

    //获取用户注册量
    public function getNumOfUser()
    {

    }

    //获取分类销量
    public function getSalesOfCategory()
    {

    }

    //设置轮播商品
    public function setSwiper($data)
    {
        $res = Db('swiper')->insert($data);
        return $res;
    }

    //获取轮播列表
    public function getSwiper()
    {
        $res = Db('swiper')->select();
        return $res;
    }

    //批量删除轮播
    public function delSwiper($swiperList)
    {
        foreach ($swiperList as $swiper) {
            $res = Db('swiper')->where('Id', $swiper['Id'])->delete();
        }
        return $res;
    }

    //获取特价商品
    public function getSpecial()
    {
        $res = Db('goods')->where('status', 3)->select();
        return $res;
    }

    //设置特价商品
    public function setSpecial($goodsList)
    {
        foreach ($goodsList as $goods) {
            $res = Db('goods')->where('Id', $goods['Id'])->update(['status' => 3]);
        }
        return $res;
    }

    //取消特价商品
    public function cancelSpecial($goodsList)
    {
        foreach ($goodsList as $goods) {
            $res = Db('goods')->where('Id', $goods['Id'])->update(['status' => 2]);
        }
        return $res;
    }
}
