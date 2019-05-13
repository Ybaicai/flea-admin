<?php
namespace app\api\controller;

use think\Controller;

//
class AdminUser extends Controller
{

    public function register()
    {

        $data = input('post.');
        $data['token'] = 'Bearer' . md5(time() . $data['password']);
        $data['expire_time'] = time() + 3600;
        $model = model('AdminUser');
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
        $data = input('post.');
        $token = 'Bearer' . md5(time() . $data['password']);
        $time_out = time() + 3600;
        $token_time = [
            'token' => $token,
            'expire_time' => $time_out,
        ];
        $model = model('AdminUser');
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
        $model = model('AdminUser');
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
        $model = model('AdminUser');
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
        $model = model('AdminUser');
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
    public function getUser() //获取用户列表

    {
        $model = model('AdminUser');
        $res = $model->getUser();
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
    public function bannedUser() //封禁用户

    {
        $user_id = input('user_id');
        $model = model('AdminUser');
        $res = $model->bannedUser($user_id);
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
    public function unbanUser() //解封用户

    {
        $user_id = input('user_id');
        $model = model('AdminUser');
        $res = $model->unbanUser($user_id);
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
    public function delUser()
    {
        //删除和批量删除用户
        $users = input('post.');
        $model = model('AdminUser');
        $res = $model->delUser($users);
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

    //添加分类
    public function addCategory()
    {
        $category_name = input('category_name');
        $model = model('AdminUser');
        $res = $model->addCategory($category_name);
        $data = [
            'code' => $res,
        ];
        return json($data);
    }

    //删除分类
    public function delCategory()
    {
        $categorys = input('post.');
        $model = model('AdminUser');
        $res = $model->delCategory($categorys);
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

    //修改分类
    public function updateCategory()
    {
        $category_id = input('category_id');
        $category_name = input('category_name');
        $model = model('AdminUser');
        $res = $model->updateCategory($category_id, $category_name);
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

    //获取已上架商品
    public function getAllUp()
    {
        $model = model('AdminUser');
        $res = $model->getAllUp();
        return json($res);
    }

    //获取已下架商品
    public function getAllDown()
    {
        $model = model('AdminUser');
        $res = $model->getAllDown();
        return json($res);
    }

    //删除商品
    public function delGoods()
    {
        $goodsList = input('post.');
        $model = model('AdminUser');
        $res = $model->delGoods($goodsList);
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

    //批量上架商品
    public function upSelectGoods()
    {
        $goodsList = input('post.');
        $model = model('AdminUser');
        $res = $model->upSelectGoods($goodsList);
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

    //批量下架商品
    public function downSelectGoods()
    {
        $goodsList = input('post.');
        $model = model('AdminUser');
        $res = $model->downSelectGoods($goodsList);
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

    //获取所有订单
    public function getAllOrder()
    {
        $model = model('AdminUser');
        $res = $model->getAllOrder();
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
        $model = model('AdminUser');
        $res = $model->getSalesOfCategory();

        return json($res);
    }

    //设置轮播商品
    public function setSwiper()
    {
        // 获取表单上传文件
        $files = request()->file('image');
        $goods = input('post.');
        $upload = controller('Upload');
        $img_url = $upload->upload($files);
        $img_url = json_decode($img_url, true);
        $data = [
            'img' => $img_url['0'],
            'goods_id' => $goods['goods_id'],
        ];
        $model = model('AdminUser');
        $res = $model->setSwiper($data);
        if ($res) {
            return json(['code' => 200, 'message' => '操作成功！']);
        } else {
            return json(['code' => 'error', 'message' => '操作失败！']);
        }
    }

    //获取轮播列表
    public function getSwiper()
    {
        $model = model('AdminUser');
        $res = $model->getSwiper();

        return json($res);
    }

    //批量删除轮播
    public function delSwiper()
    {
        $swiperList = input('post.');
        $model = model('AdminUser');
        $res = $model->delSwiper($swiperList);
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

    //获取特价商品
    public function getSpecial()
    {
        $model = model('AdminUser');
        $res = $model->getSpecial();
        return json($res);
    }

    //设置特价商品
    public function setSpecial()
    {
        $goodsList = input('post.');
        $model = model('AdminUser');
        $res = $model->setSpecial($goodsList);
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

    //取消特价商品
    public function cancelSpecial()
    {
        $goodsList = input('post.');
        $model = model('AdminUser');
        $res = $model->cancelSpecial($goodsList);
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
