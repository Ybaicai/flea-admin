<?php
namespace app\api\model;

use think\Db;
use think\Model;

/**
 *
 */
class User extends Model
{
    public function comments()
    {
        return $this->hasMany('comments', 'user_id', 'Id');
    }
    public function cart()
    {
        return $this->hasMany('cart', 'user_id', 'Id');
    }
    public function goods()
    {
        return $this->hasMany('goods', 'user_id', 'Id');
    }

    public function register($data)
    {
        $res = Db::name('user')->where('username', $data['username'])->find();
        if ($res) {
            return '用户名已存在';
        }
        $res = Db::name('user')->insert($data);
        return $res;
    }
    public function login($data, $token_time)
    {
        $where = [
            'username' => $data['username'],
            'password' => $data['password'],
        ];
        $res = Db::name('user')->where($where)->find();
        if ($res) {
            Db::name('user')->where($where)->update($token_time);
        }
        return $res;
    }
    public function updatepass($token, $oldpass, $newpass)
    {
        $res = Db('user')->where('token', $token)->where('password', $oldpass)->find();
        if ($res) {
            $res = Db('user')->where('token', $token)->update(['password' => $newpass]);
        }
        return $res;
    }
    public function getinfo($token)
    {
        $res = Db('user')->where('token', $token)->find();
        return $res;
    }
    public function setinfo($token, $data)
    {
        $res = Db('user')->where('token', $token)->update($data);
        return $res;
    }
}
