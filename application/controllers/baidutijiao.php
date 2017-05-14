<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Baidutijiao extends CI_Controller {

    public function index() {
        for ($i=0; $i <=102; $i++) { 
            # code...
            $urls = array(
                'http://www.izipit.top/',
                'http://www.izipit.top/yedeng',
            );
            $api = 'http://data.zz.baidu.com/urls?site=www.izipit.top&token=hnAoDQvgGcpcGo5s&type=mip';
            $ch = curl_init();
            $options =  array(
                CURLOPT_URL => $api,
                CURLOPT_POST => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS => implode("\n", $urls),
                CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
            );
            curl_setopt_array($ch, $options);
            $result = curl_exec($ch);
            echo $result;
        }
    }
}