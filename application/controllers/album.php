<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Album extends CI_Controller {

	private $title;
	private $keywords;
	private $description;
	private $search;
	private $head;

	function __construct()
	{
		parent::__construct();

		$this->title       = $this->system_model->get_webtitle();
		$this->keywords    = $this->system_model->get_keywords();
		$this->description = $this->system_model->get_description();
		$this->search      = "";

    	if( $this->session->userdata('online') ) {
			$this->user = $this->session->userdata('Username');
		} else {
			$this->user = 0;
		}

		$this->head['search']      = $this->search;
		$this->head['title']       = $this->title;
		$this->head['keywords']    = $this->keywords;
		$this->head['description'] = $this->description;
	}

	public function index() {
		$this->head['title'] = "专辑-" . $this->title;
      	$this->load->view('default/mt_header.php',$this->head);
      	$this->load->view('mt_album.php');
      	
      	$this->load->view('default/mt_footer.php');
	}

	public function albuminfo($page = 1) {
		$ArrAlbum = array();
		$query    = $this->album_model->album($page);
		foreach ($query as $value) {
			$album_id   = $value['ID'];
			$album_name = $value['album_name'];
			$album_user = $value['album_user'];

			if (!$this->album_model->picturenum($album_id)) {
				continue;
			}

			$pic = $this->album_model->picture($album_id);

			$album_num = count($pic);

			$cover  = "";
			$pic001 = "";
			$pic002 = "";
			$pic003 = "";

			foreach ($pic as $key => $pic_value) {
				if ($pic_value['is_cover'] == 1) {
					$cover = $this->pic_model->one_thumb($pic_value['picture_id']);
				} else {
					switch ($key) {
						case 0:
							$pic001 = $this->pic_model->one_thumb($pic_value['picture_id']);
							break;
						case 1:
							$pic002 = $this->pic_model->one_thumb($pic_value['picture_id']);
							break;
						case 2:
							$pic003 = $this->pic_model->one_thumb($pic_value['picture_id']);
							break;
						default:
							break;
					}
				}
			}
			if ($pic001 == "") {
				$pic001 = $cover;
			}
			if ($pic002 == "") {
				$pic002 = $pic001;
			}
			if ($pic003 == "") {
				$pic003 = $pic002;
			}

			$album   = array('me' =>$this->user,'albumID' => $album_id,'albumName' => $album_name,'albumUser' => $album_user, 'albumNum' => $album_num, 'albumCover' => $cover, 'albumPic001' => $pic001, 'albumPic002' => $pic002, 'albumPic003' => $pic003 );
			array_push($ArrAlbum,$album);
		}
		echo json_encode($ArrAlbum);
	}

	public function one($id=0) {
		if ($id == 0) {
			redirect(base_url(), 'refresh');
		}
		$pic_num = $this->album_model->picturenum($id);
		$query   = $this->album_model->getbyid($id);
		foreach ($query as $value) 
		{
			$this->head['title']       = $value['album_name'] . "-" . $this->title;
			$this->head['keywords']    = $value['album_name'];
			$this->head['description'] = $value['album_user'] . "的" . $value['album_name'] . "专辑，共搜集" . $pic_num . "张图片。";
		}

      	$this->load->view('default/mt_header.php',$this->head);

		$data['pictureURL'] = base_url('xixi/album/' . $id);
		$this->load->view('mt_index.php',$data);
        $this->load->view('default/mt_footer.php');
	}

	public function creat($user='',$name='')
	{
		$name = urldecode($name);
		if ($this->album_model->is_have($user,$name))
		{
			echo "1";
		}
		else
		{
			if ($this->album_model->creat($user,$name)) 
			{
				echo "0";
			}
			else
			{
				echo "2";
			}
		}
	}

	public function add($id='',$pic='')
	{
		if ($this->album_model->picturenum($id)) 
		{
			if ($this->album_model->is_pic($id,$pic))
			{
				echo "1";
			}
			else
			{
				$this->album_model->add($id,$pic,0);
				echo "0";
			}
		} 
		else 
		{
			$this->album_model->add($id,$pic,1);
			echo "0";
		}
	}
	public function albuminfo_mine($page = 1) {
		$ArrAlbum = array();
		$userme = $this->user;
		$query    = $this->album_model->myalbum($userme);
		foreach ($query as $value) {
			$album_id   = $value['ID'];
			$album_name = $value['album_name'];
			$album_user = $value['album_user'];

			if (!$this->album_model->picturenum($album_id)) {
				continue;
			}

			$pic = $this->album_model->picture($album_id);

			$album_num = count($pic);

			$cover  = "";
			$pic001 = "";
			$pic002 = "";
			$pic003 = "";

			foreach ($pic as $key => $pic_value) {
				if ($pic_value['is_cover'] == 1) {
					$cover = $this->pic_model->one_thumb($pic_value['picture_id']);
				} else {
					switch ($key) {
						case 0:
							$pic001 = $this->pic_model->one_thumb($pic_value['picture_id']);
							break;
						case 1:
							$pic002 = $this->pic_model->one_thumb($pic_value['picture_id']);
							break;
						case 2:
							$pic003 = $this->pic_model->one_thumb($pic_value['picture_id']);
							break;
						default:
							break;
					}
				}
			}
			if ($pic001 == "") {
				$pic001 = $cover;
			}
			if ($pic002 == "") {
				$pic002 = $pic001;
			}
			if ($pic003 == "") {
				$pic003 = $pic002;
			}

			$album   = array('me' =>$this->user,'albumID' => $album_id,'albumName' => $album_name,'albumUser' => $album_user, 'albumNum' => $album_num, 'albumCover' => $cover, 'albumPic001' => $pic001, 'albumPic002' => $pic002, 'albumPic003' => $pic003 );
			array_push($ArrAlbum,$album);
		}
		echo json_encode($ArrAlbum);
	}

}

/* End of file xixi.php */
/* Location: ./application/controllers/xixi.php */