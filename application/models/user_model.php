<?php
class User_model extends CI_Model {
  private $pagenum = 10;
	public function __construct() {
    	$this->load->database();
  	}
  	//SELECT
/////前一段为活跃用户添加
  	public function users($page) {
		$this->db->order_by("user_view", "desc");
		$this->db->order_by("user_follow", "desc");		//通过关注量排行
		$this->db->order_by("user_register", "desc");  //访问量相同则再根据注册时间来排 访问越多 注册时间越短者优先

  		$query = $this->db->get('xi_users',50,50*($page-1));
		return $query->result_array();
  	}

  	public function users2($page) {
		$this->db->order_by("user_view", "desc");
		$this->db->order_by("user_follow", "desc");		//通过关注量排行
		$this->db->order_by("user_register", "desc");  //访问量相同则再根据注册时间来排 访问越多 注册时间越短者优先

  		$query = $this->db->get('xi_users',$this->pagenum,$this->pagenum*($page-1));
		return $query->result_array();
  	}

    public function login() {  //用户登录
      $this->db->where('user_login',$this->input->post('username'));
      $this->db->where('user_pass',md5($this->input->post('password')));
      $query = $this->db->get('xi_users');

      return $query->num_rows();
    }

    public function email() {  //邮箱是否存在
      $query = $this->db->get_where('xi_users',array('user_email' => $this->input->post('email')));
      return $query->num_rows();
    }


    public function is_admin($username) {   //是否是管理员
      $query = $this->db->get_where('xi_users',array('user_login' => $username,'user_status' => 1));
      return $query->num_rows();
    }

    public function is_user($username) {   //会员是否存在
      $query = $this->db->get_where('xi_users',array('user_login' => $username));
      return $query->num_rows();
    }

    public function usernum() {
      $query = $this->db->get('xi_users');
      return $query->num_rows();
    }
    public function hot_users( $page = 1 ) {  //按照 pic_like pic_view pic_collect 的数量返回所有图像记录   在首页
      $this->db->order_by("user_register", "desc");

      $query = $this->db->get_where('xi_users',array('user_status' => 0),$this->pagenum,$this->pagenum*($page-1));
      return $query->result_array();
    }

    public function picture($username) {
      $query = $this->db->get_where('xi_users',array('user_login' => $username));
      foreach ($query->result_array() as $value) {
        return $value['user_picture'];
      }
    }
  	//INSERT
  	public function register() { //用户注册
  		$now  = date("Y-m-d H:i:s");
	    $user = array(
	      'user_login' => $this->input->post('username'), 
	      'user_pass'  => $this->input->post('password'),
	      'user_email' => $this->input->post('email'),
        //'user_nicename' => $this->input->post('nicename'),
        //'user_mobile' => $this->input->post('mobile'),
	      'user_register' => $now
	    );

	    $db = $this->db->insert('xi_users',$user);
	    return $db;
  	}

  	//UPDATE 修改
    public function add_picture($username,$picture) {
      $this->db->where('user_login', $username);
      $this->db->update('xi_users', array('user_picture' => $picture));
    }
	//此为增加用户访问量
	public function addview( $user ) {  //更新记录 浏览 次数
      $query = $this->db->get_where('xi_users',array('user_login' => $user));
      foreach ($query->result_array() as $value) {
        $view = $value['user_view'];
      }

      $view++;

      $data = array( 'user_view' => $view );  
      $this->db->where('user_login',$user); 
      $this->db->update('xi_users', $data); 

      return $view;
    }
	public function add_ufollow($to) {
      $query = $this->db->get_where('xi_users',array('user_login' => $to));
      foreach ($query->result_array() as $value) {
        $follow = $value['user_follow'];
      }

      $follow++;

      $data = array( 'user_follow' => $follow );  
      $this->db->where('user_login',$to); 
      $this->db->update('xi_users', $data); 

      return $follow;
  }

	public function remove_ufollow($to) {
      $query = $this->db->get_where('xi_users',array('user_login' => $to));
      foreach ($query->result_array() as $value) {
        $follow = $value['user_follow'];
      }

      $follow--;

      $data = array( 'user_follow' => $follow );  
      $this->db->where('user_login',$to); 
      $this->db->update('xi_users', $data); 

      return $follow;
  }
  	//DELETE
    public function delete( $id ) {  
      $this->db->delete('xi_users', array('ID' => $id)); 
    }

    public function createRandomCode($length)
    {
      $randomCode = "";
      $randomChars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      for ($i = 0; $i < $length; $i++)
      {
        $randomCode .= $randomChars { mt_rand(0, 35) };
      }
      return $randomCode;
    }
}
?>