<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Letter extends CI_Controller {

	public function index($page = 1) {
		if ($this->session->userdata('online')) {
			$username = $this->session->userdata('Username');
			$data['letter'] = $this->letter_model->letter($username,$page);
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

		$this->load->view('mt_letter.php',$data);

		$this->load->view('default/mt_div.php');
		$this->load->view('default/mt_footer.php');
	}


	public function delete($id = 0) {
		if ($this->letter_model->is_letter($id)) {
			$this->letter_model->delete($id);
		}
	}

	public function watchmsg($id = 0) {//标为已读
		if ($this->letter_model->is_letter($id)) {
			$this->letter_model->update($id);
		}
	}
}

/* End of file xixi.php */
/* Location: ./application/controllers/xixi.php */