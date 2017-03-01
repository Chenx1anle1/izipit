<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class yedeng extends CI_Controller {

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
		$offset = $this->input->get('page')?:0;
		$uid_key = $this->input->get('uid')?:0;
		$this->head['title'] = "夜灯-" . $this->title;
      	$this->load->view('default/mt_header.php',$this->head);
		$this->db->select('*')->from('yedeng');
		$all = $this->db->count_all_results();
		$uid = 0;

      	$this->load->view('mt_yedeng.php', array('offset'=>$offset, 'total'=>$all, 'uid_key'=>$uid_key));
      	
      	$this->load->view('default/mt_footer.php');
	}

	public function curl_list() {
		$ch = curl_init("http://bk2.radio.cn/mms4/videoPlay/getMorePrograms.jspa?programName=财经夜读&start=0&limit=20&channelId=15&callback=jQuery183026698157979774884_1488041219154&_=1488041789251") ;  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回  
		echo $output = curl_exec($ch) ; 
	}

	public function curl_get() {
		//$ch = curl_init("http://bk2.radio.cn/mms4/videoPlay/getVodProgramPlayUrlJson.jspa?programId=614262&programVideoId=0&videoType=PC&terminalType=515104503&dflag=1") ;  
		//$ch = curl_init("http://bk2.radio.cn/mms4reportDataCollectMgr/downloadData.jspa?programId=614262&videoType=PC");//old
		$ch = curl_init("http://www.radio.c/api/mobileservices.php?action=listen_click&id=614262&type=1");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回  
		echo $output = curl_exec($ch) ; 
	}

	public function save_data () {
		if ($_POST['url'] != '') {
			$data = [
				'mid' => $_POST['id'],
				'title' => $_POST['title'],
				'time' => $_POST['time'],
				'url' => $_POST['url'],
				'lrc' => '',
				'up_id' => $_POST['uid']?:3
			];
			$this->db->insert('yedeng', $data);
			$insert_mid = $this->db->insert_id();
		}
        redirect(base_url().'yedeng', 'refresh');
	}

	function get_that_one()
	{
		$data = $this->db->select('ID,pic_uuid,pic_name,pic_url,pic_text,pic_type,pic_tag,pic_user,pic_collect,pic_like,pic_share,pic_view,pic_status,pic_datetime')->from('picture')->where(array('id >'=>1634, 'id <='=>1636))->get()->result_array();
		return $data;
	}

	public function wall()
	{
		
	}

	public function m3d()
	{
		$pic = $this->random(48);
		$pic2 = $this->get_that_one(1634);
		$pic = array_merge($pic, $pic2);
		foreach ($pic as $key => $val) {
			if (strpos($val['pic_url'], '.jpg')) {
				$data[]['src'] = str_replace('.jpg', '_thumb.jpg', 'http://www.izipit.top/'.$val['pic_url']);
			}
			if (strpos($val['pic_url'], '.jepg')) {
				$data[]['src'] = str_replace('.jepg', '_thumb.jepg', 'http://www.izipit.top/'.$val['pic_url']);
			}
			if (strpos($val['pic_url'], '.png')) {
				$data[]['src'] = str_replace('.png', '_thumb.png', 'http://www.izipit.top/'.$val['pic_url']);
			}

		}
		echo json_encode($data);
	}

    function random($num = 0) {  //随机返回3条记录
      $sql   = "SELECT * FROM picture WHERE pic_status = 1 ORDER BY RAND() LIMIT {$num}"; 
      $query = $this->db->query($sql);
      return $query->result_array();
    }

	function _get_cbb_list($start = 0, $limit = 5)
	{
		$ch = curl_init("http://bk2.radio.cn/mms4/videoPlay/getMorePrograms.jspa?programName=财经夜读&start=".$start."&limit=".$limit."&channelId=15&callback=json&_=1488041789251") ;  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回  
		$output = curl_exec($ch) ; 
		//$output = json_decode($output, true);
		//json({"total":1404,"programs":[{"programName":"财经夜读_2017-02-26","creationTime":"2017-02-25","programId":636928},{"programName":"财经夜读_2017-02-25","creationTime":"2017-02-25","programId":636560}]})
		$output = substr($output, 5, -1);
		$output = json_decode($output, true);
		return $output;
	}

	private function _get_diff($offset = 0, $uid = 0, $output = array(), $ids = array(), $start = 0, $limit = 5)
	{
		$arr_list = array();

		foreach ($output['programs'] as $key => $val) {
			if (!in_array($val['programId'], $ids)) {
				$arr_list[$key]['title'] = $val['programName'];
				$arr_list[$key]['author'] = '经济之声';
				$arr_list[$key]['id'] = $val['programId'];
				$arr_list[$key]['uptime'] = $val['creationTime'];
				$arr_list[$key]['url'] = "http://bk2.radio.cn/mms4/videoPlay/getVodProgramPlayUrlJson.jspa?programId=".$val['programId']."&programVideoId=0&videoType=PC&terminalType=515104503&dflag=1";
				$arr_list[$key]['pic'] = 'http://www.izipit.top/upload/user/18ca38041958081b8e966faac5c803be_3.jpg';
				$arr_list[$key]['lrc'] = 'http://www.izipit.top/dist/js/player/c.lrc';
			}
		}
		if (empty($arr_list)) {
			// if (($start+5)<15) {
				$this->listinfo($offset, $uid, $start+5, $limit);
			// } else {
				// return array();				
			// }
		} else {
			return $arr_list;
		}
	}

	public function remove_love($uid = 0, $mid = 0)
	{
		$this->db->select('*')
				 ->from('yedeng')
				 ->like(array('love_ids' => $uid.',', 'mid' => $mid));
		$music = $this->db->get()->row_array();
		$music['love_ids'] = str_replace($uid.',', '', $music['love_ids']);
		$data = array( 'love_ids' => $music['love_ids'] );  
		$this->db->where('mid',$mid); 
		$this->db->update('yedeng', $data);
		return $this->db->affected_rows();
	}

	public function add_love($uid = 0, $mid = 0)
	{
		$this->db->select('*')
				 ->from('yedeng')
				 ->where(array('mid' => $mid));
				 //->like(array('love_ids' => $uid.','));
		$music = $this->db->get()->row_array();
		$music['love_ids'] .= $uid.',';
		$data = array( 'love_ids' => $music['love_ids'] );  
		$this->db->where('mid',$mid); 
		$this->db->update('yedeng', $data);
		return $this->db->affected_rows();
	}

	public function is_love($uid = 0, $mid = 0)
	{
		$this->db->select('*')
				 ->from('yedeng')
				 ->where(array('mid' => $mid))
				 ->like(array('love_ids' => $uid.','));
		$status = $this->db->get()->row_array();
		if (!empty($status)) {
			return true;
		} else {
			return false;			
		}
	}

	public function love($mid = 0)
	{
		$loveArray = array();
		if( $this->session->userdata('online') ) {
			$uid = $this->session->userdata('id');
			$is_love = 0;
			if($this->is_love($uid,$mid)) {
				if ($this->remove_love($uid,$mid)) {
					$is_love = 1;
				}
			} else {
				if ($this->add_love($uid,$mid)) {
					$is_love = 1;
				}
			}

			$jsonStr = array('is_love' => $is_love, 'is_login' => 1 );
		} else {
			$jsonStr = array('is_love' => 0, 'is_login' => 0 );
		}

		echo json_encode($jsonStr);
	}

	public function listinfo($offset = 0, $uid = 0, $start = 0, $limit = 5) {
		$output = $this->_get_cbb_list($start, $limit);
		if( $this->session->userdata('online') && $uid > 0 ) {
			$user_id = $this->session->userdata('id');
		} else {
			$user_id = 0;
		}
		// 获取ids
		$this->db->select('*')
				 ->from('yedeng')
				 ->where(array('mid !='=>784533));
		$user_id && $this->db->like(array('love_ids'=>$user_id));
		$this->db->order_by('time desc');
		$my_cbb_db_list = $this->db->get()->result_array();
		$ids = array();
		foreach ($my_cbb_db_list as $val) {
			$ids[] = $val['mid'];
		}

		$this->db->select('*')
				 ->from('yedeng')
				 ->where(array('mid !='=>784533));
		$user_id && $this->db->like(array('love_ids'=>$user_id.','));
		$this->db->order_by('time desc, title desc');
		$this->db->limit(5,$offset);
		$data_db_list = $this->db->get()->result_array();
		$album = array();
		$heart = '<i style="float:left;color:#ff8080" id="heart" class="icon-heart"></i><span>';
		foreach ($data_db_list as $key => $val) {
			$mid_input = '</span><input type="hidden" value="'.$val['mid'].'">';
			if ($this->session->userdata('id') && strpos($val['love_ids'], $this->session->userdata('id').',')) {
				$album[$key]['author'] = '经济之声'.$mid_input.$heart;
			} else {
				$album[$key]['author'] = '经济之声'.$mid_input;
			}
			$album[$key]['title'] = $val['title'];
			$album[$key]['url'] = $val['url'];
			$album[$key]['pic'] = 'http://www.izipit.top/upload/user/18ca38041958081b8e966faac5c803be_3.jpg';
			$album[$key]['lrc'] = 'http://www.izipit.top/dist/js/player/c.lrc';
		}
		$arr_list = $this->_get_diff($offset, $user_id, $output, $ids, $start, $limit);


		if (!empty($arr_list)) {
			$ArrAlbum = array();
			$this_music = $this->db->select('*')->from('yedeng')->where(array('mid'=>784533))->get()->row_array();
			$new = [
			            'title'=>'secret base~君がくれたもの~',
			            'author'=>'123',
			            'url'=>'http://devtest.qiniudn.com/secret base~.mp3',
			            'pic'=>'https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq/it/u=2534129488,2639379667&fm=58',
			            'lrc'=>'https://aplayer.js.org/secret%20base~%E5%90%9B%E3%81%8C%E3%81%8F%E3%82%8C%E3%81%9F%E3%82%82%E3%81%AE~.lrc'
			];
			$new['author'] = '茅野愛衣</span><input type="hidden" value="784533">';
			if (strpos($this_music['love_ids'], $this->session->userdata('id').',')) {
				$new['author'] = '茅野愛衣</span><input type="hidden" value="784533">'.'<i style="float:left;color:#ff8080" id="heart" class="icon-heart"></i><span>';
			}
			array_push($ArrAlbum, $new);
			$merge = array_merge($ArrAlbum, $album);
			$ArrOut = ($offset==0)?$merge:$album;
			echo json_encode(array('album'=>$ArrOut, 'list'=>$arr_list, 'user_id'=>$user_id));
		}
	}
}
/* End of file xixi.php */
/* Location: ./application/controllers/xixi.php */