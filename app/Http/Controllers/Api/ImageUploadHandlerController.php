<?php

namespace App\Http\Controllers\Api;

use Image;
use App\Http\Requests\Api\ImageUploadHandlerRequest;

/**
 * 图片上传
 *
 * Class ImageUploadHandlerController
 * @package App\Http\Controllers\Api
 */
class ImageUploadHandlerController extends Controller
{
    protected $allowed_ext = ['png', 'jpg', 'gif', 'jpeg'];

    public function save($file, $folder, $max_width = false)
    {
        // 构建存储的文件夹规则，值如：uploads/images/avatars/201709/21/
        // 文件夹切割能让查找效率更高。
        $folder_name = "uploads/images/$folder/" . date("Ym/d", time());

        // 文件具体存储的物理路径，`public_path()` 获取的是 `public` 文件夹的物理路径。
        // 值如：/home/vagrant/Code/larabbs/public/uploads/images/avatars/201709/21/
        $upload_path = public_path() . '/' . $folder_name;

        // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        // 拼接文件名，加前缀是为了增加辨析度，前缀可以是相关数据模型的 ID
        // 值如：1_1493521050_7BVc9v9ujP.png
        $filename = time() . '_' . str_random(10) . '.' . $extension;

        // 如果上传的不是图片将终止操作
        if ( ! in_array($extension, $this->allowed_ext)) {
            // return false;
            return $this->response->error("上传的文件格式必须是 'png', 'jpg', 'gif', 'jpeg' 格式类型", 422);
        }

        // 将图片移动到我们的目标存储路径中
        $file->move($upload_path, $filename);

        // 如果限制了图片宽度，就进行裁剪
        if ($max_width && $extension != 'gif') {

            // 此类中封装的函数，用于裁剪图片
            $this->reduceSize($upload_path . '/' . $filename, $max_width);
        }

        $result = [
            'path' => "/$folder_name/$filename"
        ];

        return $this->response->array($result)->setStatusCode(201);
    }

    /**
     * 图片过大就裁剪
     *
     * @param $file_path
     * @param $max_width
     */
    public function reduceSize($file_path, $max_width)
    {
        // 先实例化，传参是文件的磁盘物理路径
        $image = Image::make($file_path);

        // 进行大小调整的操作
        $image->resize($max_width, null, function ($constraint) {

            // 设定宽度是 $max_width，高度等比例双方缩放
            $constraint->aspectRatio();

            // 防止裁图时图片尺寸变大
            $constraint->upsize();
        });

        // 对图片修改后进行保存
        $image->save();
    }

    public function upload(ImageUploadHandlerRequest $request)
    {
        return $this->save($request->images, $request->filename, 1024);
    }
}
