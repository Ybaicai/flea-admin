<?php
namespace app\api\model;

use think\Db;
use think\Model;

class Goods extends Model
{
    public function album()
    {
        return $this->hasMany('Album', 'goods_id', 'Id');
    }
    public function comments()
    {
        return $this->hasMany('Comments', 'goods_id', 'Id');
    }
    public function cart()
    {
        return $this->hasOne('cart', 'goods_id', 'Id');
    }
    public function goods_upload($img_urls, $data)
    {
        $res1 = Db('goods')->insertGetId($data);
        if ($res1) {
            $i = 0;
            foreach ($img_urls as $img_url) {
                $i++;
                if ($i > 1) {
                    $data = [
                        'img_url' => $img_url,
                        'goods_id' => $res1,
                    ];
                    $res = Db('album')->insert($data);
                } else {
                    $res = true;
                }
            }
            if ($res) {
                return $res;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }
    public function getCategory()
    {
        $res = Db('category')->select();
        return $res;
    }
    public function getgoodslist($id)
    {
        if ($id == 0) {
            $res = Db('goods')->select();
        } else {
            $res = Db('goods')->where('category_id', $id)->select();
        }

        return $res;
    }
    public function getgoodsinfo($id)
    {
        $goodsinfo = [];
        $goods = Goods::find($id);
        array_push($goodsinfo, $goods);
        $album = $goods->album;
        $res = [
            'info' => $goodsinfo,
            'album' => $album,
        ];
        return $res;
    }
    public function getPutList($user_id)
    {
        $user = User::find($user_id);
        $putList = $user->goods()->where('status', 1)->select();
        foreach ($putList as $value) {
            $album = $value->album->hidden(['Id', 'goods_id']);
            $value['album'] = $album;
        }
        return $putList;
    }
    public function getDownList($user_id)
    {
        $user = User::find($user_id);
        $downList = $user->goods()->where('status', 2)->select();
        foreach ($downList as $value) {
            $album = $value->album->hidden(['Id', 'goods_id']);
            $value['album'] = $album;
        }
        return $downList;
    }
    public function downGoods($goods_id)
    {
        $res = Db('goods')->where('Id', $goods_id)->update(['status' => 2]);
        return $res;
    }
    public function upGoods($goods_id)
    {
        $res = Db('goods')->where('Id', $goods_id)->update(['status' => 1]);
        return $res;
    }
    public function updateGoods($img_urls, $data, $goods_id)
    {
        $res1 = Db('goods')->where('Id', $goods_id)->update($data);
        Db('album')->where('goods_id', $goods_id)->delete();
        if ($res1) {
            $i = 0;
            foreach ($img_urls as $img_url) {
                $i++;
                if ($i > 1) {
                    $data = [
                        'img_url' => $img_url,
                        'goods_id' => $goods_id,
                    ];
                    $res = Db('album')->where('goods_id', $goods_id)->insert($data);
                } else {
                    $res = true;
                }
            }
            if ($res) {
                return $res;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
