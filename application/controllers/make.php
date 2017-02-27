<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Make extends CI_Controller {

	public function index() {
		$title       = $this->system_model->get_webtitle();
		$keywords    = $this->system_model->get_keywords();
		$description = $this->system_model->get_description();
		$search      = "";

		$head['search']      = $search;
		$head['title']       = "标签列表-" . $title;
		$head['keywords']    = $keywords;
		$head['description'] = $description;
		$this->load->view('default/mt_header.php',$head);
		$data['make'] = $this->tags_model->alltags();
	 	$this->load->view('mt_make.php',$data);
		
    	$this->load->view('default/mt_footer.php');
	}
}

/* End of file xixi.php */
/* Location: ./application/controllers/xixi.php */