<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Xixi extends CI_Controller {
	private $user;
	private $title;
	private $keywords;
	private $description;
	private $search;
	private $head;
	function __construct()//登录判断
	{
		parent::__construct();
		$this->realip = xi_get_ClientIp();

    	if( $this->session->userdata('online') ) {
			$this->user = $this->session->userdata('Username');
		} else {
			$this->user = 0;
		}

		$this->title       = $this->system_model->get_webtitle();
		$this->keywords    = $this->system_model->get_keywords();
		$this->description = $this->system_model->get_description();
		$this->search      = "";

		$this->head['search']      = $this->search;
		$this->head['title']       = $this->title;
		$this->head['keywords']    = $this->keywords;
		$this->head['description'] = $this->description;
	}

	public function browse()
	{
		if (!$this->browse_model->is_have($this->realip)) 
		{
			$this->browse_model->add($this->realip);
		}
	}

	public function index() {   //最新
		$this->load->view('default/mt_header.php',$this->head);
		$data['pictureURL'] = base_url('xixi/images');
		$this->load->view('mt_index.php',$data);
        $this->load->view('default/mt_footer.php');
        $this->browse();
	}

	public function indexflashwall() {   //最新
		$this->head['title'] = "imagewall-" . $this->title;
		$this->load->view('default/mt_header.php',$this->head);
		$data['pictureURL'] = base_url('xixi/images');
		//$this->load->view('mt_index.php',$data);
		//$this->load->view('indexflashwall.html',$data);

		$this->load->view('indexflashwall.html',$data);
        $this->browse();
	}

	public function index3d() {   //最新
		$this->load->view('default/mt_header.php',$this->head);
		if( $this->session->userdata('online') ) {
			$user = $this->session->userdata('Username');
			$data['pictureURL'] = base_url('xixi/collect' . '/' . $user);
		}else{
			$data['pictureURL'] = base_url('xixi/images');
		}
		
		//$this->load->view('mt_index.php',$data);
		$this->load->view('index3d.html');
        $this->browse();
	}
	public function popular_like() {   //热门
		$this->head['title'] = "Top赞图片-" . $this->title;
		$this->load->view('default/mt_header.php',$this->head);
		$data['pictureURL'] = base_url('xixi/hot_like');
		$this->load->view('mt_index.php',$data);
        $this->load->view('default/mt_footer.php');
	}

	public function popular_view() {   //热门
		$this->head['title'] = "Top view图片-" . $this->title;
		$this->load->view('default/mt_header.php',$this->head);
		$data['pictureURL'] = base_url('xixi/hot_view');
		$this->load->view('mt_index.php',$data);
        $this->load->view('default/mt_footer.php');
	}
	public function popular_love() {   //热门
		$this->head['title'] = "Top收藏图片-" . $this->title;
		$this->load->view('default/mt_header.php',$this->head);
		$data['pictureURL'] = base_url('xixi/hot_love');
		$this->load->view('mt_index.php',$data);
        $this->load->view('default/mt_footer.php');
	}
//我的热门图片
	public function popular_mypic() {   //热门
    	if( $this->session->userdata('online') ) {
			$myname = $this->session->userdata('Username');
		}
		$this->head['title'] = $myname."热门图片-" . $this->title;
		$this->load->view('default/mt_header.php',$this->head);
		$data['pictureURL'] = base_url('xixi/hot_mypic');
		$this->load->view('mt_index.php',$data);
        $this->load->view('default/mt_footer.php');
	}
////////////////////////////////////////////////////////////////////////////
	public function popular_users($page=1) {   //热门用户
		$this->head['title'] = "热门用户-" . $this->title;
		$this->load->view('default/mt_header.php',$this->head);
		$data['image'] = $this->user_model->users($page);

		$this->load->view('mt_me.php',$data,$page); 
	/*	  //分页 与排名冲突了
	    $config['base_url']   = base_url('xixi/popular_users');
	    $config['total_rows'] = $this->user_model->usernum();
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
		*/

		$this->load->view('default/mt_page.php');

		$this->load->view('default/mt_footer.php');

	}

//在 这里改动

//我的热门图片
	public function hot_mypic( $page = 1) {   //根据记录被喜欢的次数返回所有记录
		if( $this->session->userdata('online') ) {
			$user = $this->session->userdata('Username');
			}
		$query = $this->pic_model->hot_mypic( $user,$page );
		$this->imageInfo($query);
	}

//////////////////////////////////////////////////////////////////////////////


	public function hot_like( $page = 1 ) {   //根据记录被喜欢的次数返回所有记录
		$query = $this->pic_model->hot_like( $page );
		$this->imageInfo($query);
	}
	public function hot_view( $page = 1 ) {   //根据记录被喜欢的次数返回所有记录
		$query = $this->pic_model->hot_view( $page );
		$this->imageInfo($query);
	}
	public function hot_love( $page = 1 ) {   //根据记录被喜欢的次数返回所有记录
		$query = $this->pic_model->hot_love( $page );
		$this->imageInfo($query);
	}

	public function images( $page = 1 ) {     //根据记录的发布日期返回所有记录
		$query = $this->pic_model->pictures( $page );
		$this->imageInfo($query);
	}

	public function imageInfo($query)
	{
		$ArrImages   = array();
		foreach ($query as $value) {
				if (!file_exists($value['pic_url'])) { //本地文件不存在
					continue;
				}
				$thumb    = explode(".",$value['pic_url']);
				$thumbpic = $thumb[0] . "_thumb." . $thumb[1];
				if (file_exists($thumbpic)) {
					$image_u  = base_url($thumbpic);
				} else {
					$image_u  = base_url($value['pic_url']);
				}
				
				$image_p  = base_url($value['pic_url']);

			$image    = GetImageSize($value['pic_url']);
			$image_w  = $image[0];
			$image_h  = $image[1];

			$image_love = $this->love_model->is_love($value['pic_uuid'],$this->user);
			$image_like = $this->like_model->is_like($value['pic_uuid'],$this->user);

			$image_i  = array('me' =>$this->user,'viewid' => $value['ID'],'love' => $value['pic_collect'],'name' => $value['pic_name'],'id' => $value['pic_uuid'],'url' => $image_u,'time' => $value['pic_datetime'], 'user' => $value['pic_user'],'pic' => $image_p,'width' => $image_w, 'height' => $image_h,'is_love' => $image_love, 'is_like' => $image_like );
			array_push($ArrImages,$image_i);
		}
		echo json_encode($ArrImages);
	}

	public function search($search) {   //搜索
		$this->head['title'] = urldecode($search) . "：" . $this->title . "搜索结果";
		$this->head['keywords'] = $this->keywords . "，" . urldecode($search);
		$this->load->view('default/mt_header.php',$this->head);
		$data['pictureURL'] = base_url('xixi/searcher') . "/" . urldecode($search);
		$this->load->view('mt_index.php',$data);
        $this->load->view('default/mt_footer.php');
	}

	public function searcher($search = "",$page = 1) {   //返回指定搜索内容的数据
		$query = $this->pic_model->search( urldecode($search), $page );
		$this->imageInfo($query);
	}

	public function catalogue($catalogue = "") {   //分类
		$catname = $this->catalogue_model->name_by_another($catalogue);
		$this->head['title'] = urldecode($catname) . "-" . $this->title;
		$this->head['keywords'] = $this->keywords . "，" . urldecode($catname);
		$this->load->view('default/mt_header.php',$this->head);
		$data['pictureURL'] = base_url('xixi/cat') . "/" . urldecode($catalogue);
		$this->load->view('mt_index.php',$data);
        $this->load->view('default/mt_footer.php');
	}

	public function cat($catalogue = "",$page = 1) {   //返回指定分类的数据
		$catalogue = urldecode($catalogue);
		$arraySon  = array();
	    $name = $this->catalogue_model->name_by_another($catalogue);
	    if($this->catalogue_model->have_son($name)) {
	        $cat = $this->catalogue_model->cat_name($name);
	        foreach ($cat as $value) {
	        	array_push($arraySon,$value['cat_another_name']);
	        }
	    }

		$query = $this->pic_model->catalogue( $catalogue, $page, $arraySon );
		$this->imageInfo($query);
	}

	public function tag($tag) {   //标签
		$this->head['title']    = urldecode($tag) . "-" . $this->title;
		$this->head['keywords'] = $this->keywords . "，" . urldecode($tag);
		$this->load->view('default/mt_header.php',$this->head);
		$data['pictureURL'] = base_url('xixi/gettag') . "/" . urldecode($tag);
		$this->load->view('mt_index.php',$data);
        $this->load->view('default/mt_footer.php');
	}

	public function gettag($tag = "",$page = 1) {   //返回指定标签的数据
		$query = $this->pic_model->tag( urldecode($tag), $page );
		$this->imageInfo($query);
	}

	public function is_love($uuid)
	{
		$loveArray = array();
		if( $this->session->userdata('online') ) {
			$user = $this->session->userdata('Username');
			$is_love = $this->love_model->is_love($uuid,$user);
			$jsonStr = array('is_love' => $is_love, 'is_login' => 1 );
		} else {
			$jsonStr = array('is_love' => 0, 'is_login' => 0 );
		}
		array_push($loveArray,$jsonStr);
		echo json_encode($loveArray);
	}

	public function love($uuid) {
		$loveArray = array();
		if( $this->session->userdata('online') ) {
			$user = $this->session->userdata('Username');
			if($this->love_model->is_love($uuid,$user)) {
				$this->love_model->remove_love($uuid,$user);
				$this->pic_model->removelove($uuid);
			} else {
				$this->love_model->add_love($uuid,$user);
				$this->pic_model->addlove($uuid);
			}
			$lovenum = $this->love_model->pic_love($uuid);

			$is_love = $this->love_model->is_love($uuid,$user);

			$jsonStr = array('love' => $lovenum, 'is_love' => $is_love, 'is_login' => 1 );
		} else {
			$jsonStr = array('love' => 0, 'is_love' => 0, 'is_login' => 0 );
		}

		array_push($loveArray,$jsonStr);

		echo json_encode($loveArray);
	}

	public function like( $uuid ) {

	    $likeArray = array();
		if( $this->session->userdata('online') ) {
			$user = $this->session->userdata('Username');
			if($this->like_model->is_like($uuid,$user)) {
				$this->like_model->remove_like($uuid,$user);
				$this->pic_model->removelike($uuid);
			} else {
				$this->like_model->add_like($uuid,$user);
				$this->pic_model->addlike($uuid);
			}
			$likenum = $this->like_model->pic_like($uuid);

			$is_like = $this->like_model->is_like($uuid,$user);

			$jsonStr = array('like' => $likenum, 'is_like' => $is_like, 'is_login' => 1 );
		} else {
			$jsonStr = array('like' => 0, 'is_like' => 0, 'is_login' => 0 );
		}

		array_push($likeArray,$jsonStr);

		echo json_encode($likeArray);
	}

	public function collect($user, $page = 1 ) {     //根据记录的发布日期返回所有记录
		$user = urldecode($user);
		$uuid  = $this->love_model->user_love( $user,$page );

		$ArrImages   = array();

		foreach ($uuid as $pic) {
			$picid = $pic['love_pic'];
			$query = $this->pic_model->one( $picid );
		
			foreach ($query as $value) {
					$thumb    = explode(".",$value['pic_url']);
					$thumbpic = $thumb[0] . "_thumb." . $thumb[1];
					$image_u  = base_url($thumbpic);
					$image_p  = base_url($value['pic_url']);

				$image    = GetImageSize($value['pic_url']);
				$image_w  = $image[0];
				$image_h  = $image[1];

				$image_love = $this->love_model->is_love($value['pic_uuid'],$this->user);
				$image_like = $this->like_model->is_like($value['pic_uuid'],$this->realip);

				//$image_i  = array('viewid' => $value['ID'],'id' => $value['pic_uuid'],'url' => $image_u, 'width' => $image_w, 'height' => $image_h, 'is_love' => $image_love, 'is_like' => $image_like );
				$image_i  = array('me' =>$this->user,'viewid' => $value['ID'],'love' => $value['pic_collect'],'name' => $value['pic_name'],'id' => $value['pic_uuid'],'url' => $image_u,'time' => $value['pic_datetime'], 'user' => $value['pic_user'],'pic' => $image_p,'width' => $image_w, 'height' => $image_h,'is_love' => $image_love, 'is_like' => $image_like );
				array_push($ArrImages,$image_i);
			}
		}
		echo json_encode($ArrImages);
	}
	public function album2() {
		$this->head['title'] = "我的专辑-" . $this->title;
      	$this->load->view('default/mt_header.php',$this->head);
      	$this->load->view('mt_album_mine.php');
      	
      	$this->load->view('default/mt_footer.php');
	}

	public function album($id,$page = 1) {     //根据记录的发布日期返回所有记录
		$album = $this->album_model->one( $id, $page );
		$query = array();
		foreach ($album as $value) {
			$pic = $this->pic_model->one_id($value['picture_id']);

			foreach ($pic as $value) {
					$thumb    = explode(".",$value['pic_url']);
					$thumbpic = $thumb[0] . "_thumb." . $thumb[1];
					$image_u  = base_url($thumbpic);
					$image_p  = base_url($value['pic_url']);

				$image    = GetImageSize($value['pic_url']);
				$image_w  = $image[0];
				$image_h  = $image[1];

				$image_love = $this->love_model->is_love($value['pic_uuid'],$this->user);
				$image_like = $this->like_model->is_like($value['pic_uuid'],$this->realip);

				$image_i  = array('me' =>$this->user,'viewid' => $value['ID'],'love' => $value['pic_collect'],'name' => $value['pic_name'],'id' => $value['pic_uuid'],'url' => $image_u,'time' => $value['pic_datetime'], 'user' => $value['pic_user'],'pic' => $image_p,'width' => $image_w, 'height' => $image_h,'is_love' => $image_love, 'is_like' => $image_like );
				array_push($query,$image_i);
			}

		}

		echo json_encode($query);
	}



	public function user($user, $page = 1 ) {     //根据记录的发布日期返回所有记录
		$user = urldecode($user);
		$query = $this->pic_model->user( $user,$page );

		$this->imageInfo($query);
	}


	public function downImage($uuid='')
	{
		$this->load->helper('download');
		if($this->pic_model->is_view($uuid))
		{
			$down = $this->pic_model->addown($uuid);
			$query = $this->pic_model->one($uuid);
			foreach ($query as $value) 
			{
				$data = file_get_contents(base_url($value['pic_url']));
				force_download(basename($value['pic_url']), $data);
			}
		}
	}

	public function edittag($pic='',$tags='')
	{
		$tags = urldecode($tags);

		$oldtag = $this->pic_model->gettag($pic);

		$tagstr   = preg_replace("/\s| /","",$tags); //去除所有格
      	$newtag = str_replace(","," ",$tagstr);
      	$this->pic_model->edittags($pic,$newtag);
      	//更新标签的次数
      	
	    $tag  = explode (" ", $newtag);

      	for ($i = 0; $i < count($tag); $i++) {
        	if ($this->tags_model->is_tag($tag[$i])) 
        	{
        		if(!stristr($oldtag,$tag[$i]))
        		{
          			$this->tags_model->addamount($tag[$i]);
				}
        	} else {
          		if ($tag[$i] != "") {
            		$this->tags_model->addtag($tag[$i]);
          		}
       		 }
    	}
      	echo "0";
	}
}

/* End of file xixi.php */
/* Location: ./application/controllers/xixi.php */