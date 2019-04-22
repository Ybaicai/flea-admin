<?php
namespace app\api\controller;

use think\Controller;

/**
 *
 */
class Comments extends Controller
{

    public function commentSubmit()
    {
        $user_id = input('user_id');
        $content = input('content');
        $goods_id = input('goods_id');
        $model = model('Comments');
        $res = $model->commentSubmit($user_id, $content, $goods_id);
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
    public function getComments()
    {
        $goods_id = input('id');
        $model = model('Comments');
        $res = $model->getComments($goods_id);
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
}
