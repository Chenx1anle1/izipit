<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {

	public function index() {
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		$this->form_validation->set_rules('message', '留言内容', 'trim|required|min_length[5]|max_length[256]|xss_clean');

		$realip = xi_get_ClientIp();

		if($this->form_validation->run() == FALSE) {
			$uuid = $this->input->post('view');
			$head['search'] = "";
			$this->load->view('default/mt_header.php',$head);

			if ( $this->pic_model->is_view($uuid) ) {  //记录存在
				$query = $this->pic_model->one($uuid);

				if( $this->session->userdata('online') ) {
					$user = $this->session->userdata('Username');
				} else {
					$user = 0;
				}

				foreach ($query as $value) {

						$image_u  = base_url($value['pic_url']);
					
					$pic            = GetImageSize ($value['pic_url']);
					$id            = $value['ID'];
					$data['id']     = $value['ID'];
					$data['uuid']   = $uuid;
					$data['name']   = $value['pic_name'];
					$data['text']   = $value['pic_text'];
					$data['tags']   = $value['pic_tag'];
					$data['user']   = $value['pic_user'];

					$picture        = 'upload/user/' . $this->user_model->picture($value['pic_user']) . '_2.jpg';
					if (file_exists($picture)) {
						$data['picture'] = base_url('upload/user/' . $this->user_model->picture($value['pic_user']) . '_2.jpg');
					} else {
						$data['picture'] = base_url('upload/user/default_2.jpg');
					}

					$data['date']   = $value['pic_datetime'];
					$data['collect'] = $value['pic_collect'];
					$data['like']   = $value['pic_like'];
					$data['view']   = $value['pic_view'];
					$data['share']  = $value['pic_share'];
					
					$data['url']    = $value['pic_url'];
					$data['show']   = TRUE;

					if( $this->session->userdata('online') ) {
						$user = $this->session->userdata('Username');
						if($this->follow_model->is_follow($value['pic_user'],$user)){
							$data['follow'] = 1;
						} else {
							$data['follow'] = 0;
						}
					} else {
						$user = 0;
						$data['follow'] = 0;
					}

					$data['is_love'] = $this->love_model->is_love($uuid,$user);
					$data['is_like'] = $this->like_model->is_like($uuid,$realip);

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
			} else {                                //记录不存在
				$data['show']  = FALSE;
			}

			$this->load->view('mt_view.php',$data);
			
	        $this->load->view('default/mt_footer.php');
		} else {
			if( $this->session->userdata('online') ) {
				$user_id = $this->session->userdata('Username');
				if($this->message_model->message($user_id)) {
					//向作者发送新评论通知
					$view = $this->input->post('view');
					$viewid = $this->input->post('viewid');
					$one  = $this->pic_model->one($view);
					foreach ($one as $value) {
						$username = $value['pic_user'];
					}

					$this->letter_model->add_commnet($username,$viewid);

					$url  = base_url() . "view" . "/" . $viewid;
					redirect($url, 'refresh');
				} else {
					$data['success'] = FALSE;
					$head['search'] = "";
					$this->load->view('default/mt_header.php',$head);
		 			$this->load->view('default/mt_message.php',$data);
					
	        		$this->load->view('default/mt_footer.php');
	        	}

			} else {
				redirect(base_url('login'), 'refresh');
			}

		}
	}


    public function repmsg($thisid = ""){
		$query  = $this->message_model->rep_message($thisid);
		//foreach ($query as $value1){
			$arrmsg = array();
			$loushu=1;

			foreach ($query as $value) {
				$rep_id        = $value['ID'];
				$rep_text   = $value['msg_text'];
				$rep_user      = $value['msg_user'];
				$rep_datetime  = $value['msg_datetime'];
				$rep_username  = $value['msg_user'];
				$picture        = 'upload/user/' . $this->user_model->picture($value['msg_user']) . '_2.jpg';
				if (file_exists($picture)) {
					$rep_upicture = base_url('upload/user/' . $this->user_model->picture($value['msg_user']) . '_2.jpg');
				} else {
					$rep_upicture = base_url('upload/user/default_2.jpg');
				}
			
			$message=array('loushu'=>$loushu,'thisid'=>$thisid,'rep_id'=>$rep_id,'rep_text'=>$rep_text,'rep_datetime'=>$rep_datetime,'rep_username'=>$rep_username,'rep_upicture'=>$rep_upicture);
			
			$loushu++;			
			array_push($arrmsg,$message);
			}
		//}
			$diandao = array();
			$diandao = array_reverse($arrmsg);//php数组颠倒顺序方法
			echo json_encode($diandao);	
		
	}
	public function addmessage2($view, $text, $username,$toname,$msgid,$msg_status) {
		$text = urldecode($text);
		$toname = urldecode($toname);
		$this->message_model->addmessage2($view,$text,$username,$toname,$msgid,$msg_status);

		if ($view == "pigeon") {
			return;
		}

		$id = $this->pic_model->getid($view);

		$query = $this->find_name($text);
		foreach ($query as $value) {
			if ($this->user_model->is_user($value)) {
				$message = $username . " 在评论中提到了你。<a href='" . base_url('view/' . $id) . "'>查看</a>";
				$this->letter_model->add_notice($value,$message);
			}
		}


		$pic  = $this->pic_model->one($view);
		foreach ($pic as $value) {
			$username = $value['pic_user'];
		}

		

		$this->letter_model->add_commnet($username,$id);
	}
	public function addmessage($view, $text, $username) {
		$text = urldecode($text);
		//$toname = urldecode($toname);
		$this->message_model->addmessage($view,$text,$username);

		if ($view == "pigeon") {
			return;
		}

		$id = $this->pic_model->getid($view);

		$query = $this->find_name($text);
		foreach ($query as $value) {
			if ($this->user_model->is_user($value)) {
				$message = $username . " 在评论中提到了你。<a href='" . base_url('view/' . $id) . "'>查看</a>";
				$this->letter_model->add_notice($value,$message);
			}
		}


		$pic  = $this->pic_model->one($view);
		foreach ($pic as $value) {
			$username = $value['pic_user'];
		}

		

		$this->letter_model->add_commnet($username,$id);
	}
	public function find_name($str) {
		$name_list = array();
		$count = substr_count($str,'@');
		for ($i=0; $i < $count; $i++) { 
			$domain = strstr($str, '@');
			$len    = strpos($domain," ");
			$name   = substr($domain, 1, $len);
			$str    = substr($domain, 1);
			array_push($name_list,$name);
		}
		return $name_list;
	}
}

/* End of file xixi.php */
/* Location: ./application/controllers/xixi.php */