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
// 添加自动提交
            $urls = array(
                'http://www.izipit.top/',
                'http://www.izipit.top/yedeng',
            );
            $api = 'http://data.zz.baidu.com/urls?site=www.izipit.top&token=hnAoDQvgGcpcGo5s&type=mip';
            $ch = curl_init();
            $options =  array(
                CURLOPT_URL => $api,
                CURLOPT_POST => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS => implode("\n", $urls),
                CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
            );
            curl_setopt_array($ch, $options);
            $result = curl_exec($ch);
            // echo $result;


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

	public function howto() {
		$this->load->view('mt_howto.php');
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

	function get_that_one()
	{
		$data = $this->db->select('ID,pic_uuid,pic_name,pic_url,pic_text,pic_type,pic_tag,pic_user,pic_collect,pic_like,pic_share,pic_view,pic_status,pic_datetime')->from('picture')->where(array('id >='=>1841, 'id <='=>1843, 'id !='=>1842))->get()->result_array();
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


	function _get_cbb_list($start = 0, $limit = 15)
	{
		$ch = curl_init("http://111.202.49.48/pcpages/searchs/livehistory?channelname=2&name=520843&callback=jQuery112205783065994457746_1493190229995&start=".$start."&rows=".$limit."&_=1493190229999");
		// $ch = curl_init("http://bk2.radio.cn/mms4/videoPlay/getMorePrograms.jspa?programName=财经夜读&start=".$start."&limit=".$limit."&channelId=15&callback=json&_=1488041789251") ;  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回  
		$output = curl_exec($ch);
		$output = serialize($output);

		$output = str_replace(')', '(', $output);
		$output = explode('(', $output);
		$output = json_decode($output[1], true);
		// var_dump($output);die;
		return $output;
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

	public function listinfo($offset = 0, $uid = 0, $start = 0, $limit = 20) {
		$output = $this->_get_cbb_list($start, $limit);
		$output = $output['passprogram'];
		// var_dump($output);die;
		$this->save_data($output);
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
		$this->db->limit(10,$offset);
		$data_db_list = $this->db->get()->result_array();
		$album = array();
		$heart = '<i style="float:left;color:#ff8080" id="heart" class="icon-heart"></i><span>';

		foreach ($data_db_list as $key => $val) {
			$mid_input = '</span><input type="hidden" value="'.$val['mid'].'">';
			if ($this->session->userdata('id') && strpos($val['love_ids'], $this->session->userdata('id').',')) {
				$album[$key]['author'] = '财经夜读'.$mid_input.$heart;
			} else {
				$album[$key]['author'] = '财经夜读'.$mid_input;
			}
			$album[$key]['music_id'] = $val['mid'];
			$album[$key]['title'] = $val['title'];
			$album[$key]['url'] = $val['url'];
			$album[$key]['pic'] = 'http://www.izipit.top/upload/user/18ca38041958081b8e966faac5c803be_3.jpg';
			$album[$key]['lrc'] = 'http://www.izipit.top/dist/js/player/c.lrc';
		}
		// $arr_list = $this->_get_diff($offset, $user_id, $output, $ids, $start, $limit);
		$arr_list = [];

			$ArrAlbum = array();
			$this_music = $this->db->select('*')->from('yedeng')->where(array('mid'=>784533))->get()->row_array();
			$new = [
						'music_id'=>'784533',
			            'title'=>'secret base~君がくれたもの~',
			            'author'=>'123',
			            'url'=>'http://devtest.qiniudn.com/secret base~.mp3',
			            'pic'=>'https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq/it/u=2534129488,2639379667&fm=58',
			            'lrc'=>'https://aplayer.js.org/secret%20base~%E5%90%9B%E3%81%8C%E3%81%8F%E3%82%8C%E3%81%9F%E3%82%82%E3%81%AE~.lrc'
			];
			$new['author'] = '茅野愛衣</span><input type="hidden" value="784533">';
			if ($this->session->userdata('id') && strpos($this_music['love_ids'], $this->session->userdata('id').',')) {
				$new['author'] = '茅野愛衣</span><input type="hidden" value="784533">'.'<i style="float:left;color:#ff8080" id="heart" class="icon-heart"></i><span>';
			}
			array_push($ArrAlbum, $new);
			$merge = array_merge($ArrAlbum, $album);
			$ArrOut = ($offset==0)?$merge:$album;
		// 获取音乐id数组
		$music_ids = array();
		foreach ($ArrOut as $val) {
			$music_ids[] = $val['music_id'];
		}

		if (!empty($arr_list)) {
			echo json_encode(array('album'=>$ArrOut, 'ids' => $music_ids, 'list'=>[], 'user_id'=>$user_id));
		} else {
			echo json_encode(array('album'=>$ArrOut, 'ids' => $music_ids, 'list'=>array(), 'user_id'=>$user_id));
		}
	}

	public function load_article($mid, $uid = 0) {
			$this->db->select('ap.*, y.title m_title')
					 ->from('article_pice ap')
					 ->join('yedeng y','ap.mc_id = y.mid')
					 ->where(['ap.mc_id'=>$mid])
					 ->order_by('uptime asc, id asc');
			$uid && $this->db->where(['ap.uid'=>$uid]);
			$all = $this->db->get()->result_array();
$count = count($all)+1;
$width = ($count+1)*900;
$html="<!--留言 {$mid}--><div id='id_{$mid}' class='helpcenter_rightInIn'>";
$bottom = "<a class='helpcenter_bBL'><</a>";
$botom_end = "<a class='helpcenter_bBR'>></a>";
if (!empty($all)) {
	$k = 0;
	foreach ($all as $key => $val) {
		$key = $key + 1;
		$html .= "<!-- 图文{$key} --><div class='helpcenter_rightIns helpcenter_rightInsOn'><div class='helpcenter_rightInL'><h2><span>{$val['title']} </span><label style='font-size:12px;'>({$val['m_title']}期)</label><span class='helpcenter_span1'>{$key}</span><span>/</span><span>{$count}</span></h2>{$val['txt']}</div></div>";
		if ($key == 1) {
			$bottom = $bottom."<a class='helpcenter_bB helpcenter_bBon'>{$key}</a>";
		} else {
			$bottom = $bottom."<a class='helpcenter_bB'>{$key}</a>";
		}
		$k = $key+1;
	}
}
$html .= "<from><div class='helpcenter_rightIns helpcenter_rightInsOn'><div class='helpcenter_rightInL'><h2><span>留下你的文字</span></h2><div class='m'><input class='music_title' type='txt' name='title' style='width:848px'  placeholder='请输入标题' required /><textarea class='txt txt-editor' id='content' name='content'></textarea><input type='submit' value='提 交' onclick='add({$mid})' class='btn-submit btn btn-primary'></div></div></div></form>";
$bottom .= "<a class='helpcenter_bB'>{$count}</a>";
$data['bottom'] = $bottom.$botom_end;
$data['html'] = $html;
// var_dump($data);die;
echo json_encode($data);
	}

	public function add_article($mid) {
		if( $this->session->userdata('online')) {
			$uid = $this->session->userdata('id');
			$data = array(
				'uid' => $uid,
				'mc_id' => $mid,
				'title' => $_POST['title'],
				'txt' => $_POST['txt'],
				'uptime' => time(),
				);
			$this->db->insert('article_pice', $data);
			$insert_id = $this->db->insert_id();
			$res['status']=$insert_id;
			$res['msg']='提交成功';
			echo json_encode($res);
		} else {
			$res['status']=0;
			$res['msg']='请登录后再提交';
			echo json_encode($res);
		}
	}

	public function save_data ($save) {
		if( $this->session->userdata('online')) {
			$user_id = $this->session->userdata('id');
		} else {
			$user_id = 0;
		}

		$all = $this->db->select('*')
				 ->from('yedeng')
				 ->get()
				 ->result_array();
		// var_dump($all);die;
		foreach ($all as $val) {
			$ids[] = $val['mid'];
			$date[] = $val['time'];
		}
		// var_dump($ids);die;
		// var_dump($date);die;
		$insert_id = 0;
		foreach ($save as $val) {
				if (!in_array($val['display_id'], $ids)) {
					if (!in_array($val['broadcast_date'], $date)) {
						$data = [
							'mid' => $val['display_id'],
							'title' => $val['broadcast_date'],
							'time' => $val['broadcast_date'],
							'url' => 'http://'.$val['stream_domain1'].$val['stream_url1'],
							'lrc' => '',
							'up_id' => $user_id?:3
						];
						$this->db->insert('yedeng', $data);
						$insert_mid = $this->db->insert_id();
					}
				}
		}
		$status = $insert_id ? 1 : 0;
		return $status;
	}

}
/* End of file xixi.php */
/* Location: ./application/controllers/xixi.php */