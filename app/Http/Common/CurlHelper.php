<?php

namespace App\Http\Common;

class CurlHelper
{
    /**
     * 返回 GET 的数据
     *
     * @param      $url
     * @param bool $flag
     *
     * @return mixed
     */
    public function getCurl($url, $flag = true)
    {
        // 需要通过 curl 获取
        // 1. 初始化
        $ch = curl_init();
        // 2. 设置选项，包括 URL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 3. 执行并获取 HTML文 档内容
        $output = curl_exec($ch);
        // 4. 释放 curl 句柄
        curl_close($ch);
        // 返回值
        if ($flag) {
            return json_decode($output, true);
        } else {
            return $output;
        }
    }

    /**
     * curl GET 获取远程文件
     * @param string $url
     * @param string $filename
     *
     * @return bool
     */
    public function getUrlFile($url = "", $filename = "")
    {
        // 去除 URL 连接上面可能的引号
        $hander = curl_init();
        $fp = fopen($filename, 'wb');
        curl_setopt($hander, CURLOPT_URL, $url);
        curl_setopt($hander, CURLOPT_FILE, $fp);
        curl_setopt($hander, CURLOPT_HEADER, 0);
        curl_setopt($hander, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($hander, CURLOPT_TIMEOUT, 60);
        curl_exec($hander);
        curl_close($hander);
        fclose($fp);

        Return true;
    }

    /**
     * 返回 POST 数据
     *
     * @param      $url
     * @param      $data
     * @param bool $flag
     *
     * @return mixed
     */
    public function postCurl($url, $data, $flag = true)
    {
        // 需要通过 curl 获取
        // 1. 初始化
        $ch = curl_init();
        // 2. 设置选项，包括URL
        // 设置要访问的 url
        curl_setopt($ch, CURLOPT_URL, $url);
        // 设置返回的类型为文件流而不是直接输出
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 设置请求为 post
        curl_setopt($ch, CURLOPT_POST, 1);
        // 传递请求的数据
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        // 3. 执行并获取 HTML 文档内容
        $output = curl_exec($ch);
        // 4. 释放 curl 句柄
        curl_close($ch);
        // 返回值
        if ($flag) {
            return json_decode($output, true);
        } else {
            return $output;
        }
    }

    /**
     * curl POST 获取远程文件
     *
     * @param      $url
     * @param      $data
     * @param      $filename
     * @param bool $flag
     */
    public function postCurlFile($url, $data, $filename, $flag = true)
    {
        // 需要通过 curl 获取
        // 1. 初始化
        $hander = curl_init();
        $fp = fopen($filename, 'wb');
        curl_setopt($hander, CURLOPT_URL, $url);
        curl_setopt($hander, CURLOPT_FILE, $fp);
        curl_setopt($hander, CURLOPT_HEADER, 0);
        curl_setopt($hander, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($hander, CURLOPT_TIMEOUT, 60);
        // 设置请求为 post
        curl_setopt($hander, CURLOPT_POST, 1);
        // 传递请求的数据
        curl_setopt($hander, CURLOPT_POSTFIELDS, $data);
        curl_exec($hander);
        curl_close($hander);
        fclose($fp);
    }

    /**
     * 上传文件 图片
     *
     * @param      $url
     * @param      $path
     * @param      $key
     * @param bool $flag
     *
     * @return mixed
     */
    public function upload_file($url, $path, $key, $flag = true)
    {
        $data = [
            $key => new \CURLFile(realpath($path))
        ];

        $ch = curl_init();
        // 设置帐号和帐号名
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $return = curl_exec($ch);
        curl_close($ch);
        // 返回值
        if ($flag) {
            return json_decode($return, true);
        } else {
            return $return;
        }
    }
}
