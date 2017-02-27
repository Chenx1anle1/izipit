<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notice extends CI_Controller {

	public function index($page = 1) {
		if ($this->session->userdata('online')) {
			$username = $this->session->userdata('Username');
			$data['letter'] = $this->letter_model->notice($username,$page);
		} else {
			redirect(base_url(), 'refresh');
		}

		$title       = $this->system_model->get_webtitle();
		$keywords    = $this->system_model->get_keywords();
		$description = $this->system_model->get_description();
		$search      = "";

		$head['search']      = $search;
		$head['title']       = $title;
		$head['keywords']    = $keywords;
		$head['description'] = $description;
		
		$this->load->view('default/mt_header.php',$head);

		$this->load->view('mt_notice.php',$data);

		$this->load->view('default/mt_div.php');
		
		$this->load->view('default/mt_footer.php');
	}
}

/* End of file xixi.php */
/* Location: ./application/controllers/xixi.php */