<?php
namespace app\api\controller;

use think\Controller;

/**
 *
 */
class Goods extends Controller
{

    public function goods_upload()
    {
        // 获取表单上传文件
        $files = request()->file('image');
        $goods = input('post.');
        $upload = controller('Upload');
        $img_url = $upload->upload($files);
        $img_url = json_decode($img_url, true);
        $data = [
            'main_img' => $img_url['0'],
            'name' => $goods['name'],
            'price' => $goods['price'],
            'category_id' => $goods['category'],
            'stock' => $goods['stock'],
            'detail' => $goods['detail'],
            'update_time' => date('Y-m-d', time()),
            'status' => 1,
            'user_id' => $goods['user_id'],
        ];
        $model = model('Goods');
        $res = $model->goods_upload($img_url, $data);
        if ($res) {
            return json(['code' => 200, 'message' => '商品上架成功！']);
        } else {
            return json(['code' => 'error', 'message' => '商品上架失败！']);
        }
    }
    public function getCategory()
    {
        $model = model('Goods');
        $res = $model->getCategory();
        if ($res) {
            $data = [
                'code' => 200,
                'data' => $res,
            ];
            return json($data);
        } else {
            return json($res);
        }
    }
    public function getgoodslist()
    {
        $id = input('id');
        $model = model('Goods');
        $res = $model->getgoodslist($id);
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
    public function getgoodsinfo()
    {
        $id = input('id');
        $model = model('Goods');
        $res = $model->getgoodsinfo($id);
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
    public function getPutList()
    {
        $user_id = input('user_id');
        $model = model('Goods');
        $res = $model->getPutList($user_id);
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
    public function getDownList()
    {
        $user_id = input('user_id');
        $model = model('Goods');
        $res = $model->getDownList($user_id);
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
    public function downGoods()
    {
        $goods_id = input('goods_id_down');
        $model = model('Goods');
        $res = $model->downGoods($goods_id);
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
    public function upGoods()
    {
        $goods_id = input('goods_id_up');
        $model = model('Goods');
        $res = $model->upGoods($goods_id);
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
    public function updateGoods()
    {
        $files = request()->file('image');
        $goods = input('post.');
        $goods_id = input('goods_id');
        $upload = controller('Upload');
        $img_url = $upload->upload($files);
        $img_url = json_decode($img_url, true);
        $data = [
            'main_img' => $img_url['0'],
            'name' => $goods['name'],
            'price' => $goods['price'],
            'category_id' => $goods['category'],
            'stock' => $goods['stock'],
            'detail' => $goods['detail'],
            'update_time' => date('Y-m-d', time()),
        ];
        $model = model('Goods');
        $res = $model->updateGoods($img_url, $data, $goods_id);
        if ($res) {
            return json(['code' => 200, 'message' => '商品修改成功！']);
        } else {
            return json(['code' => 'error', 'message' => '商品修改失败！']);
        }
    }
}
