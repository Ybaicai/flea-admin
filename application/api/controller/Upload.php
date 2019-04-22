<?php
namespace app\api\controller;

use think\Controller;

/**
 *
 */
class Upload extends Controller
{

    public function upload($files)
    {
        $urls = [];
        foreach ($files as $file) {
            // 移动到框架应用根目录/uploads/ 目录下
            $info = $file->move('../public/uploads');
            if ($info) {
                // 成功上传后 获取上传信息
                $filepath = 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/' . $info->getSaveName();
                $filePath = str_replace('\\', '/', $filepath);
                array_push($urls, $filePath);
            } else {
                // 上传失败获取错误信息
                return json($file->getError());
            }
        }
        return json_encode((object) $urls);
    }
}
