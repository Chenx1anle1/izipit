<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by sublime.
 * @Author: Chenxl
 * @DateTime: 2017/05/05
 * @Description: Description
 */
class wechat extends CI_Controller {

    function index() {
        var_dump()
        $url = "http://localhost/haishi/jquery2php.php";
        $post_data = array ("name" => "张三");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // post数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // post的变量
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $output = curl_exec($ch);
        curl_close($ch);
        //打印获得的数据
        // print_r($output);
        $output_array = json_decode($output,true);
        var_dump($output_array);
    }

}