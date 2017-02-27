<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	private $title;
	private $keywords;
	private $description;
	private $search;
	private $head;
/**
 * 登录检测   没设置公共类
 */
	function __construct()
	{
		parent::__construct();

		if( $this->session->userdata('online') ) {
			$username = $this->session->userdata('Username');
			if (!$this->user_model->is_admin($username)) {
				redirect(base_url(), 'refresh');
			}
		} else {
			redirect(base_url(), 'refresh');
		}
		$this->title       = $this->system_model->get_webtitle();
		$this->keywords    = $this->system_model->get_keywords();
		$this->description = $this->system_model->get_description();
		$this->search      = "";

		$this->head['search']      = $this->search;
		$this->head['title']       = "管理中心-" . $this->title;
		$this->head['keywords']    = $this->keywords;
		$this->head['description'] = $this->description;

		$this->load->view('default/mt_header.php',$this->head);
		$this->load->view('admin/admin_nav.php');
	}

	public function index() {
		$data['picture'] = $this->pic_model->picturenum();
		$data['images']  = $this->pic_model->checknum();
		$data['user']    = $this->user_model->usernum();


		$this->load->view('admin/admin_index.php',$data);
		
		$this->load->view('default/mt_footer.php');
	}

	public function system() {
		$this->load->view('admin/admin_system.php');
		
		$this->load->view('default/mt_footer.php');
	}

	public function types() {
		$data['catalogue'] = $this->catalogue_model->cat_all();

		$this->load->view('admin/admin_types.php',$data);
		
		$this->load->view('default/mt_footer.php');
	}

	public function tags() {
		$data['tag'] = $this->tags_model->alltags();

		$this->load->view('admin/admin_tags.php',$data);
		
		$this->load->view('default/mt_footer.php');
	}

	public function image($page=1) {
		$data['image'] = $this->pic_model->check($page);

		$this->load->view('admin/admin_image.php',$data);

		  //分页
	    $config['base_url']   = base_url('admin/image');
	    $config['total_rows'] = $this->pic_model->checknum();
	    $config['per_page']   = 10;
	    $config['num_links']  = 4;
	    $config['use_page_numbers'] = TRUE;
	    $config['first_link'] = '<b>首页</b>';
	    $config['last_link']  = '<b>末页</b>';
	    $config['next_link']  = '<b>下一页</b>';
	    $config['prev_link']  = '<b>上一页</b>';

	    $config['num_tag_open']   = '<li>';
	    $config['num_tag_close']  = '</li>';

	    $config['cur_tag_open']   = '<li class="active disabled"><a href="javascript:void(0)">';
	    $config['cur_tag_close']  = '</a></li>';

	    $config['prev_tag_open']  = '<li>';
	    $config['prev_tag_close'] = '</li>';

	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';

	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';

	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';

	    $config['full_tag_open'] = '<nav class="pagination">';
	    $config['full_tag_close'] = '</nav>';

    	$this->pagination->initialize($config); 

		$this->load->view('default/mt_page.php');

		
		$this->load->view('default/mt_footer.php');
	}

	public function picture($page=1) {
		$data['image'] = $this->pic_model->pictures($page);

		$this->load->view('admin/admin_picture.php',$data);

		  //分页
	    $config['base_url']   = base_url('admin/picture');
	    $config['total_rows'] = $this->pic_model->picturenum();
	    $config['per_page']   = 10;
	    $config['num_links']  = 4;
	    $config['use_page_numbers'] = TRUE;
	    $config['first_link'] = '<b>首页</b>';
	    $config['last_link']  = '<b>末页</b>';
	    $config['next_link']  = '<b>下一页</b>';
	    $config['prev_link']  = '<b>上一页</b>';

	    $config['num_tag_open']   = '<li>';
	    $config['num_tag_close']  = '</li>';

	    $config['cur_tag_open']   = '<li class="active disabled"><a href="javascript:void(0)">';
	    $config['cur_tag_close']  = '</a></li>';

	    $config['prev_tag_open']  = '<li>';
	    $config['prev_tag_close'] = '</li>';

	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';

	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';

	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';

	    $config['full_tag_open'] = '<nav class="pagination">';
	    $config['full_tag_close'] = '</nav>';

    	$this->pagination->initialize($config); 

		$this->load->view('default/mt_page.php');

		
		$this->load->view('default/mt_footer.php');
	}

	public function usercen($page=1) {
		$data['image'] = $this->user_model->users2($page);

		$this->load->view('admin/admin_users.php',$data);

		  //分页
	    $config['base_url']   = base_url('admin/usercen');
	    $config['total_rows'] = $this->user_model->usernum();
	    $config['per_page']   = 12;
	    $config['num_links']  = 4;
	    $config['use_page_numbers'] = TRUE;
	    $config['first_link'] = '<b>首页</b>';
	    $config['last_link']  = '<b>末页</b>';
	    $config['next_link']  = '<b>下一页</b>';
	    $config['prev_link']  = '<b>上一页</b>';

	    $config['num_tag_open']   = '<li>';
	    $config['num_tag_close']  = '</li>';

	    $config['cur_tag_open']   = '<li class="active disabled"><a href="javascript:void(0)">';
	    $config['cur_tag_close']  = '</a></li>';

	    $config['prev_tag_open']  = '<li>';
	    $config['prev_tag_close'] = '</li>';

	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';

	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close'] = '</li>';

	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';

	    $config['full_tag_open'] = '<nav class="pagination">';
	    $config['full_tag_close'] = '</nav>';

    	$this->pagination->initialize($config); 

		$this->load->view('default/mt_page.php');

		
		$this->load->view('default/mt_footer.php');
	}





	public function delete($uuid) {
		if($this->pic_model->is_view($uuid)) {
			$query = $this->pic_model->one($uuid);
			foreach ($query as $value) {
				$path  = $value['pic_url'];
				$picid = $value['ID'];
			}


			$thumb    = explode(".",$path);
			$thumbpic = $thumb[0] . "_thumb." . $thumb[1];

			if (file_exists($path)) {
				@unlink($path);
				@unlink($thumbpic);
			}
		}

		$this->pic_model->delete($uuid);
		$this->album_model->delete($picid);
	}



	public function addtype() {
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		$this->form_validation->set_rules('name', '名称', 'trim|required|max_length[64]|is_unique[catalogue.cat_name]|xss_clean');
		$this->form_validation->set_rules('another', '别名', 'trim|required|max_length[64]|alpha|is_unique[catalogue.cat_another_name]|xss_clean');
		//$this->form_validation->set_rules('icon', '图标', 'trim|required|max_length[64]|alpha_dash|xss_clean');

		if($this->form_validation->run() == FALSE) {
			$data['catalogue'] = $this->catalogue_model->cat_all();

			$this->load->view('admin/admin_types.php',$data);
			
			$this->load->view('default/mt_footer.php');
		} else {
			$this->catalogue_model->add_type();
			redirect(base_url('admin/types'), 'refresh');
		}
	}

	public function deletetype($id) {
		$this->catalogue_model->delete($id);	
	}

	public function deletetag($id) {
		$this->tags_model->delete($id);	
	}

	public function deleteuser($id) {
		$this->user_model->delete($id);	
	}

	public function pass($uuid) {
		$this->pic_model->pass($uuid);

		$one  = $this->pic_model->one($uuid);
		foreach ($one as $value) {
			$username = $value['pic_user'];
		}
		$text = "你发布的图片已经通过管理员审核。";
		/* 给用户发送审核通知*/

	}

	public function reject($uuid) {
		$query = $this->pic_model->one($uuid);
		foreach ($query as $value) {
			$path  = $value['pic_url'];
			$picid = $value['ID'];
			$username = $value['pic_user'];
		}


		$thumb    = explode(".",$path);
		$thumbpic = $thumb[0] . "_thumb." . $thumb[1];

		if (file_exists($path)) {
			@unlink($path);
			@unlink($thumbpic);
		}
		

		$this->pic_model->delete($uuid);
		$text = "你发布的图片未通过管理员审核。";
		/* 给用户发送审核通知*/
	}


}

/* End of file xixi.php */
/* Location: ./application/controllers/xixi.php */