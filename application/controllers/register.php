<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	public function index() {
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger border">', '</div>');

		$this->form_validation->set_rules('username', '用户名', 'trim|required|min_length[3]|max_length[12]|is_unique[xi_users.user_login]|callback_username_check|xss_clean');
		$this->form_validation->set_rules('password', '密码', 'trim|required|min_length[6]|max_length[18]|matches[passconf]|md5');
		$this->form_validation->set_rules('passconf', '确认密码', 'trim|required');
		$this->form_validation->set_rules('email', '邮箱', 'trim|required|valid_email|is_unique[xi_users.user_email]');
	  	
	  	if($this->form_validation->run() == FALSE) {
	  		if( $this->session->userdata('online') ) {
	  			redirect(base_url(), 'refresh');
	  		} else {
				$this->load->view('mt_register.php');
	  		}
	 	} else {
	 		if($this->user_model->register()){
				redirect(base_url('login'), 'refresh');
	 		} else {
	 			$data['url']     = site_url().'register';
	 			$data['message'] = "注册失败。";
	 			$data['where']   = "注册页面";
		      	$title       = $this->system_model->get_webtitle();
				$keywords    = $this->system_model->get_keywords();
				$description = $this->system_model->get_description();
				$search      = "";

				$head['search']      = $search;
				$head['title']       = "注册失败-" . $title;
				$head['keywords']    = $keywords;
				$head['description'] = $description;
		      	$this->load->view('default/mt_header.php',$head);
		 		$this->load->view('default/mt_message.php',$data);
				
	        	$this->load->view('default/mt_footer.php');
	 		}

	  	}


	}

/*	public function username_check($value = '')
	{
		if (xi_str_Disable($value))
	  	{
	   		$this->form_validation->set_message('username_check', '用户名敏感字符。');
	   		return FALSE;
	  	}
	  	else
	  	{
	   		return TRUE;
	  	}
	}
*/
}

/* End of file xixi.php */
/* Location: ./application/controllers/xixi.php */