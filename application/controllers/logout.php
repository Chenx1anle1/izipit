<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function index() {
    $this->session->sess_destroy();
    redirect(base_url(), 'refresh');

		// if( $this->session->userdata('online') ) {
  //     $this->session->sess_destroy();
  //     redirect(base_url(), 'refresh');
  //   } else {
  //     $data['url']     = base_url();
  //     $data['message'] = "非法操作。";
  //     $data['where']   = "首页";
  //     $title       = $this->system_model->get_webtitle();
  //     $keywords    = $this->system_model->get_keywords();
  //     $description = $this->system_model->get_description();
  //     $search      = "";

  //     $head['search']      = $search;
  //     $head['title']       = "登录失败-" . $title;
  //     $head['keywords']    = $keywords;
  //     $head['description'] = $description;
  //     $head['search'] = "";
  //     $this->load->view('default/mt_header.php',$head);
  //     $this->load->view('default/mt_message.php',$data);
      
  //     $this->load->view('default/mt_footer.php');
  //   }
	}
}

/* End of file xixi.php */
/* Location: ./application/controllers/xixi.php */