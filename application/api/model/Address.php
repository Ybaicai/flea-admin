<?php
namespace app\api\model;

use think\Db;
use think\Model;

/**
 *
 */
class Address extends Model
{

    public function postAddress($user_id, $address)
    {
        $address['user_id'] = (int) $user_id;
        $list = Db('address')->where('user_id', $user_id)->select();
        if (empty($list)) {
            $address['status'] = 1;
        } else {
            $address['status'] = 2;
        }
        $res = Db('address')->insert($address);
        return $res;
    }
    public function getAddress($user_id)
    {
        $user = User::find($user_id);
        $addrList = $user->address->hidden(['user_id']);
        return $addrList;
    }
    public function setDefault($addr_id, $user_id)
    {
        Db('address')
            ->where('user_id', $user_id)
            ->where('status', 1)
            ->update(['status' => 2]);
        $res = Db('address')->where('Id', $addr_id)->update(['status' => 1]);
        return $res;
    }
    public function delAddress($addr_id)
    {
        $res = Db('address')->delete($addr_id);
        return $res;
    }
    public function updateAddress($data)
    {
        $res = Db('address')->update($data);
        return $res;
    }
}
