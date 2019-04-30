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
}
