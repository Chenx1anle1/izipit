<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends CI_Controller {

	public function index( $id = 0 ) {
		//$realip = xi_get_ClientIp();  

	    $uuid = $this->pic_model->guuid($id);

		if ( $this->pic_model->is_view($uuid) ) {  //记录存在
			$this->pic_model->addview($uuid);      //更新图片浏览次数
			$query = $this->pic_model->one($uuid);

			foreach ($query as $value) {
					$data['url']  = base_url($value['pic_url']);

				// $pic            = GetImageSize ($value['pic_url']);
				
				// if ($pic[0] > 800) {
				// 	$pic[0] = 800;
				// }
				// $data['width']  = $pic[0];

				$data['id']     = $value['ID'];
				$data['uuid']   = $uuid;
				$data['name']   = $value['pic_name'];
				$data['text']   = $value['pic_text'];
				$data['tags']   = $value['pic_tag'];
				$data['user']   = $value['pic_user'];
				$data['catanothername']   = $value['pic_type'];
				$data['catname']   = $this->catalogue_model->name_by_another($value['pic_type']);

				// $picture        = 'upload/user/' . $this->user_model->picture($value['pic_user']) . '_2.jpg';
				// if (file_exists($picture)) {
				// 	$data['picture'] = base_url('upload/user/' . $this->user_model->picture($value['pic_user']) . '_2.jpg');
				// } else {
				// 	$data['picture'] = base_url('upload/user/default_2.jpg');
				// }
				$data['date']   = $value['pic_datetime'];
				$data['collect'] = $this->love_model->pic_love($uuid);
				$data['like']   = $this->like_model->pic_like($uuid);
				$data['view']   = $value['pic_view'];
				$data['share']  = $value['pic_share'];

				if( $this->session->userdata('online') ) {
					$user = $this->session->userdata('Username');
					$data['username'] = $user;

					$pic  = 'upload/user/' . $this->user_model->picture($user) . '_3.jpg';
					if (file_exists($pic)) {
						$data['userpic'] = base_url('upload/user/' . $this->user_model->picture($user) . '_3.jpg');
					} else {
						$data['userpic'] = base_url('upload/user/default_3.jpg');
					}

					if($this->follow_model->is_follow($value['pic_user'],$user)){
						$data['follow'] = 1;
					} else {
						$data['follow'] = 0;
					}
				} else {
					$user = 0;
					$data['follow']   = 0;
					$data['username'] = 0;
					$data['userpic']  = base_url('upload/user/default_3.jpg');
				}

				$data['is_love'] = $this->love_model->is_love($uuid,$user);
				$data['is_like'] = $this->like_model->is_like($uuid,$user);



				$next = $id + 1;
				while ( !$this->pic_model->is_view($this->pic_model->guuid($next)) && $next < $this->pic_model->max_id() ) {
					$next++;
				}
				$pres = $id - 1;
				while ( !$this->pic_model->is_view($this->pic_model->guuid($pres)) && $pres > 0 ) {
					$pres--;
				}
				$data['next']  = $next;
				$data['pres']  = $pres;
			}	
			$title       = $this->system_model->get_webtitle();
			$keywords    = $this->system_model->get_keywords();
			$description = $this->system_model->get_description();
			$search      = "";

			$head['search']      = $search;
			$head['title']       = $title;
			$head['keywords']    = $keywords;
			$head['description'] = $description;

			if ($data['name'] != "") 
			{
				$head['title']    = $data['name'] . "-" . $title;
			}

			if ($data['tags'] != "") 
			{
				$head['keywords']    = $data['tags'] . "，" . $keywords;
			}
			if ($data['tags'] != "") 
			{
				$head['description']    = $data['text'];
			}
			$this->load->view('default/mt_header.php',$head);
			$data['make'] = $this->pic_model->search2();
			$this->load->view('mt_view.php',$data);
	        $this->load->view('default/mt_footer.php');
    	}
	}

}

/* End of file xixi.php */
/* Location: ./application/controllers/xixi.php */