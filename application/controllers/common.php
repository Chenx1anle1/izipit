<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        exit('Directory access is forbidden.');
    }

    /**
     * 在线编辑器文件上传
     */
    function editor_upload() {
        require_once str_replace(base_url(), '', base_url('resources')) . '/kindeditor/php/upload_json.php';
    }

    /**
     * 在线编辑器文件管理
     */
    function editor_manager() {
        require_once str_replace(base_url(), '', base_url('resources')) . '/kindeditor/php/file_manager_json.php';
    }

    /**
     * ajax评论信息demo
     * 控制层值：
     * $comments=base_url().'common/get_comments_content/'.$id.'/'.$this->hcid;
     */
    
    /**
     * 获取评论信息（带分页）
     * @author zou
     * @param  int  $id 评价信息id
     * @param  int  $cid 评价信息类型
     * @param  int  $offset 读取数据起始值（分页）
     * @param  int  $uri_segment 根据路由读取参数位置（分页）
     * @param  int  $limit 每页显示数量
     * @return array  评价信息（分页、json）
     */
    function get_comments_content($id, $cid,$offset = 0,$uri_segment = 5, $limit = 10,$type='hospital') {
        $this->load->model('service/m_service_comments');
        $default_img = 'default/100_default.jpg';
        $controller='common/get_comments_content/';
        $page_url=$id.'/'.$cid.'/';
        switch($type){
            case 'other':
                $id=0;
                break;
        }
        //处理评论列表、分页数据
        $comments_data = $this->m_service_comments->get_hospital_comment_list($id, $cid, $limit, $offset);
        $eval=array('0'=>'中评','1'=>'好评','-1'=>'差评');
        $eval_css=array('0'=>'medium','1'=>'good','-1'=>'bad');
        if (!empty($comments_data)) {
            foreach ($comments_data as $k => $v) { 
                if(empty($v['content'])){
                    $comments_data[$k]['content']=$eval[$v['evaluate']];
                }
                $comments_data[$k]['cmt_leavel']=$eval[$v['evaluate']];
                $comments_data[$k]['cmt_txt']=$eval_css[$v['evaluate']];
                $comments_data[$k]['img'] = $this->get_avatar($v['img'],$v['path']);
                $comments_data[$k]['content'] = strip_tags($comments_data[$k]['content']);
                $comments_data[$k]['uptime'] = date('Y-m-d', $v['uptime']);
            }
            
            $total = $this->m_service_comments->get_hospital_comment_count($id, $cid);
            $paginatios = $this->get_page($page_url, $uri_segment, $total, $controller, $limit);
            $comments['data'] = $comments_data;
            $comments['paginatios'] = $paginatios;
            $comments['page'] = $offset;

            $comments_json=$this->json_return(1,'请求成功',$comments);
        }else{
            $comments_json=$this->json_return(0,'暂无评论数据');
        }
        echo $comments_json;
    }

    /**
     * 分页函数
     * @author zou
     * @param  int  $page_url url参数信息
     * @param  int  $uri_segment 根据路由读取参数位置（分页）
     * @param  int  $total_rows 数据总数量
     * @param  string  $controller 控制器信息
     * @param  int  $limit 每页显示数量
     * @return array  评价信息（分页、json）
     */
    function get_page($page_url, $uri_segment, $total_rows, $controller, $limit) {
        $this->load->helper('my_page');
        $page = page_links(array(
            'first_tag_open' => '<span class="page-home">',
            'first_tag_close' => '</span>',
            'prev_tag_open' => '<span class="page-prev">',
            'prev_tag_close' => '</span>',
            'next_tag_open' => '<span class="page-next">',
            'next_tag_close' => '</span>&nbsp;',
            'last_tag_open'=>'<span class="page-next">',
            'last_tag_close'=>'</span>',
            'cur_tag_open' => '<span class="now"><a>',
            'cur_tag_close' => '</a></span>&nbsp;',
            'num_tag_open'=>'<span>',
            'num_tag_close'=>'</span>',
            'num_links' => 2,
            'next_link' => '下一页',
            'prev_link' => '上一页',
            'uri_segment' => $uri_segment,
            'per_page' => $limit,
            'base_url' => site_url($controller . $page_url),
            'total_rows' => $total_rows,
        ));
        return $page;
    }
    
    //头像路径编辑
    private function get_avatar($img = '', $path = '') {
        if (empty($img) || empty($path)) {
            $avatar_img = site_url('uploads/avatar/default/default.jpg');
        } elseif ($path == 'default') {
            $avatar_img = site_url('uploads/avatar/' . $path . '/' . $img);
        } else {
            $avatar_img = site_url('uploads/avatar/' . $path . '/50_' . $img);
        }
        return $avatar_img;
    }

}

/* End of file common.php */
/* Location: ./application/controllers/common.php */