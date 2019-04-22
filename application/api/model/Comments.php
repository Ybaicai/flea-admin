<?php
namespace app\api\model;

use think\Model;

class Comments extends Model
{

    public function commentSubmit($user_id, $content, $goods_id)
    {
        $user = User::find($user_id);
        $res = $user->comments()->save([
            'content' => $content,
            'update_time' => date('Y-m-d', time()),
            'goods_id' => $goods_id,
        ]);
        return $res;
    }
    public function getComments($goods_id)
    {
        $goods = Goods::find($goods_id);
        $comments = $goods->comments;
        foreach ($comments as $comment) {
            $user_id = $comment->user_id;
            $user = User::find($user_id);
            $username = $user->username;
            $comment['username'] = $username;
        }
        return $comments;
    }
}
