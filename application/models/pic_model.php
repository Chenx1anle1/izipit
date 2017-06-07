<?php
class Pic_model extends CI_Model {
  private $pagenum = 10;
  
	public function __construct() {
    	$this->load->database();
      $this->load->model('tags_model');

  	}

    public function pictures( $page ) {  //按照添加日期返回所有图像记录  在首页
      $this->db->order_by("pic_datetime", "desc"); 
      $query = $this->db->get_where('picture',array('pic_status' => 1),$this->pagenum,$this->pagenum*($page-1));
      return $query->result_array();
    }

    public function hot_like( $page ) {  //按照 pic_like pic_view pic_collect 的数量返回所有图像记录   在首页
      $this->db->order_by("pic_like", "desc");
      $this->db->order_by("pic_datetime", "desc");


      $query = $this->db->get_where('picture',array('pic_status' => 1),$this->pagenum,$this->pagenum*($page-1));
      return $query->result_array();
    }
    public function hot_view( $page ) {  //按照 pic_like pic_view pic_collect 的数量返回所有图像记录   在首页
      $this->db->order_by("pic_view", "desc");
      $this->db->order_by("pic_datetime", "desc");

      $query = $this->db->get_where('picture',array('pic_status' => 1),$this->pagenum,$this->pagenum*($page-1));
      return $query->result_array();
    }
    public function hot_love( $page ) {  //按照 pic_like pic_view pic_collect 的数量返回所有图像记录   在首页
      $this->db->order_by("pic_collect", "desc");
      $this->db->order_by("pic_datetime", "desc");

      $query = $this->db->get_where('picture',array('pic_status' => 1),$this->pagenum,$this->pagenum*($page-1));
      return $query->result_array();
    }
//我的热门图片
    public function hot_mypic( $name,$page ) {  //按照 pic_like pic_view pic_collect 的数量返回所有图像记录   在首页
      $this->db->order_by("pic_collect", "desc");
      $this->db->order_by("pic_datetime", "desc");

      $query = $this->db->get_where('picture',array('pic_user' =>$name ),$this->pagenum,$this->pagenum*($page-1));
      return $query->result_array();
    }
////////
    public function is_hash( $hash ) {  //查看某条记录是否存在
      $query = $this->db->get_where('picture',array('pic_uuid' => $hash));
      return $query->num_rows();
    }

    public function is_view( $uuid ) {  //查看某条记录是否存在
      $query = $this->db->get_where('picture',array('pic_uuid' => $uuid,'pic_status' => 1));
      return $query->num_rows();
    }

    public function one( $uuid ) {  //返回一条记录的信息
      $query = $this->db->get_where('picture',array('pic_uuid' => $uuid));
      return $query->result_array();
    }

   public function one_id( $id ) {  //返回一条记录的信息
      $query = $this->db->get_where('picture',array('ID' => $id));
      return $query->result_array();
    }

    public function one_url( $id ) {  //返回一条记录的信息 url
      $query = $this->db->get_where('picture',array('ID' => $id));
      foreach ($query->result_array() as $value) {
        $is_local = substr_count($value['pic_url'],'http://');
        if ($is_local) {
          return $value['pic_url'];
        } else {
          return base_url($value['pic_url']);
        }
      }
    }

    public function one_thumb( $id ) {  //返回一条记录的信息 赞
      $query = $this->db->get_where('picture',array('ID' => $id));
      foreach ($query->result_array() as $value) {
        $is_local = substr_count($value['pic_url'],'http://');
        if ($is_local) {
          return $value['pic_url'];
        } else {
          $thumb    = explode(".",$value['pic_url']);
          $thumbpic = $thumb[0] . "_thumb." . $thumb[1];
          $image_u  = base_url($thumbpic);

          return $image_u;
        }
      }
    }

    public function max_id() {  //返回最大的ID
      $this->db->order_by("ID", "desc"); 
      $query = $this->db->get_where('picture',array('pic_status' => 1),1);
      foreach ($query->result_array() as $value) {
        return $value['ID'];
      }
    }

    public function guuid($id) {   //根据记录的ID返回uuid
      $query = $this->db->get_where('picture',array('ID' => $id));
      foreach ($query->result_array() as $value) {
        return $value['pic_uuid'];
      }
    }

    public function getid($uuid) {   //根据记录的ID返回uuid
      $query = $this->db->get_where('picture',array('pic_uuid' => $uuid));
      foreach ($query->result_array() as $value) {
        return $value['ID'];
      }
    }

    public function gettag($id) {   //根据记录的ID返回uuid
      $query = $this->db->get_where('picture',array('ID' => $id));
      foreach ($query->result_array() as $value) {
        return $value['pic_tag'];
      }
    }
    public function search($search,$page) {
      $this->db->like('pic_name', $search);
      $this->db->or_like('pic_text', $search);
      $this->db->or_like('pic_tag', $search);
      $this->db->or_like('pic_type', $search);
      $query = $this->db->get_where('picture',array('pic_status' => 1),$this->pagenum,$this->pagenum*($page-1));
      return $query->result_array();
    }

    public function search2() {
      $query = $this->db->get_where('picture',array('pic_status' => 1));
      return $query->result_array();
    }
    public function catalogue( $catalogue,$page,$arraySon ) {  //根据类型返回记录信息
      $this->db->where('pic_status', 1);
      $this->db->where('pic_type', $catalogue);

      $count = count($arraySon);

      for ($i = 0; $i < $count; $i++) { 
        $this->db->or_where('pic_type', $arraySon[$i]);
      }
      $this->db->order_by("pic_datetime", "desc");
      $query = $this->db->get('picture',$this->pagenum,$this->pagenum*($page-1));
      return $query->result_array();
    }

    public function tag($tag,$page) {  //根据标签返回记录信息
      $this->db->like('pic_tag', $tag);
      $this->db->order_by("pic_datetime", "desc"); 
      $query = $this->db->get_where('picture',array('pic_status' => 1),$this->pagenum,$this->pagenum*($page-1));
      return $query->result_array();
    }

    public function alltag($tag) {  //根据标签返回记录信息
      $sql   = "SELECT * FROM picture WHERE pic_tag LIKE ? AND pic_status = ? ORDER BY RAND() LIMIT 2"; 
      $query = $this->db->query($sql, array('%'. $tag . '%',1));
      return $query->result_array();
    }

    public function check($page) {  //返回所有未审核的记录
      $this->db->order_by("ID", "desc"); 
      $query = $this->db->get_where('picture',array('pic_status' => 0),$this->pagenum,$this->pagenum*($page-1));
      return $query->result_array();
    }

    public function checknum() {
      $query = $this->db->get_where('picture', array('pic_status' => 0));
      return $query->num_rows();
    }

    public function picturenum() {
      $query = $this->db->get_where('picture', array('pic_status' => 1));
      return $query->num_rows();
    }

    public function todayhot() {
      $today       = date("Y-m-d");
      $today_start = $today . " 00:00:00";
      $today_end   = $today . " 23:59:59";
      $sql   = "SELECT * FROM picture WHERE pic_datetime BETWEEN ? AND  ? AND pic_status = ? LIMIT 0,2"; 
      $query = $this->db->query($sql, array($today_start,$today_end,1));
      return $query->result_array();
    }

    public function todayhot2() {
      $today       = date("Y-m-d");
      $today_start = $today . " 00:00:00";
      $today_end   = $today . " 23:59:59";
      $sql   = "SELECT * FROM picture WHERE pic_datetime BETWEEN ? AND  ? AND pic_status = ? LIMIT 3,2"; 
      $query = $this->db->query($sql, array($today_start,$today_end,1));
      return $query->result_array();
    }

    public function random() {  //随机返回3条记录
      $sql   = "SELECT * FROM picture WHERE pic_status = 1 ORDER BY RAND() LIMIT 1"; 
      $query = $this->db->query($sql);
      return $query->result_array();
    }

    public function user( $user, $page ) {  //按照添加日期返回$user的所有图像记录
      $this->db->order_by("pic_datetime", "desc"); 
      $query = $this->db->get_where('picture',array('pic_status' => 1, 'pic_user' => $user),$this->pagenum,$this->pagenum*($page-1));
      return $query->result_array();
    }

    public function collect( $user, $page ) {  
      $this->db->order_by("pic_datetime", "desc"); 
      $query = $this->db->get_where('picture',array('pic_status' => 1, 'pic_user' => $user),$this->pagenum,$this->pagenum*($page-1));
      return $query->result_array();
    }

  	//INSERT pic
  	public function release( $picurl,$hash ) { //插入一条图片记录
  		$now  = date("Y-m-d H:i:s");
      $username = $this->session->userdata('Username');
      if($this->user_model->is_admin($username)) {
        $status = 1;
      } else {
        $status = 0;
      }

      $tags   = preg_replace("/\s|　/","",$this->input->post('tag')); //去除所以空格
      $newtag = str_replace(","," ",$tags);

	    $pic = array(
        'pic_uuid' => $hash,
	      'pic_url'  => $picurl,
        'pic_name' => trim($this->input->post('title')),
        'pic_type' => $this->input->post('type'),
        'pic_text' => $this->input->post('info'),
        'pic_user' => $username,
        'pic_tag'  => $newtag,
        'pic_status' => $status,
	      'pic_datetime' => $now
	    );

	    $db = $this->db->insert('picture',$pic);

      //更新标签的次数
      $tag  = explode (" ", $tags);
      for ($i = 0; $i < count($tag); $i++) {
        if ($this->tags_model->is_tag($tag[$i])) {
          $this->tags_model->addamount($tag[$i]);
        } else {
          if ($tag[$i] != "") {
            $this->tags_model->addtag($tag[$i]);
          }
        }
      }

	    return $db;
  	}

    public function releasenew( $title,$info,$type,$picurl,$hash,$tags ) { //插入一条图片记录
      $now  = date("Y-m-d H:i:s");
      $username = $this->session->userdata('Username');
      if($this->user_model->is_admin($username)) {
        $status = 1;
      } else {
        $status = 0;
      }

      $pic = array(
        'pic_uuid' => $hash,
        'pic_url'  => $picurl,
        'pic_name' => $title,
        'pic_type' => $type,
        'pic_text' => $info,
        'pic_user' => $username,
        'pic_tag' => trim($tags),
        'pic_status' => $status,
        'pic_datetime' => $now
      );
      $db = $this->db->insert('picture',$pic);

      //更新标签的次数
      $tag  = explode (" ", $tags);
      for ($i = 0; $i < count($tag); $i++) {
        if ($this->tags_model->is_tag($tag[$i])) {
          $this->tags_model->addamount($tag[$i]);
        } else {
          if ($tag[$i] != "") {
            $this->tags_model->addtag($tag[$i]);
          }
        }
      }

      return $db;
    }
  	//UPDATE pic
    public function addown( $uuid ) {  //更新记录 浏览 次数
      $query = $this->db->get_where('picture',array('pic_uuid' => $uuid));
      foreach ($query->result_array() as $value) {
        $down = $value['pic_share'];
      }

      $down++;

      $data = array( 'pic_share' => $down );  
      $this->db->where('pic_uuid',$uuid); 
      $this->db->update('picture', $data); 

      return $down;
    }

    public function addview( $uuid ) {  //更新记录 浏览 次数
      $query = $this->db->get_where('picture',array('pic_uuid' => $uuid));
      foreach ($query->result_array() as $value) {
        $view = $value['pic_view'];
      }

      $view++;

      $data = array( 'pic_view' => $view );  
      $this->db->where('pic_uuid',$uuid); 
      $this->db->update('picture', $data); 

      return $view;
    }


    public function addlike( $uuid ) {  //更新记录 赞 次数
      $query = $this->db->get_where('picture',array('pic_uuid' => $uuid));
      foreach ($query->result_array() as $value) {
        $like = $value['pic_like'];
      }

      $like++;

      $data = array( 'pic_like' => $like );  
      $this->db->where('pic_uuid',$uuid); 
      $this->db->update('picture', $data); 

      return $like;
    }

    public function removelike( $uuid ) {  //更新记录 赞 次数
      $query = $this->db->get_where('picture',array('pic_uuid' => $uuid));
      foreach ($query->result_array() as $value) {
        $like = $value['pic_like'];
      }

      if ($like>0) {
         $like--;
      }

      $data = array( 'pic_like' => $like );  
      $this->db->where('pic_uuid',$uuid); 
      $this->db->update('picture', $data); 

      return $like;
    }


    public function addlove( $uuid ) {  //更新记录 收藏 次数
      $query = $this->db->get_where('picture',array('pic_uuid' => $uuid));
      foreach ($query->result_array() as $value) {
        $love = $value['pic_collect'];
      }

      $love++;

      $data = array( 'pic_collect' => $love );  
      $this->db->where('pic_uuid',$uuid); 
      $this->db->update('picture', $data); 

      return $love;
    }

    public function removelove( $uuid ) {  //更新记录 收藏 次数
      $query = $this->db->get_where('picture',array('pic_uuid' => $uuid));
      foreach ($query->result_array() as $value) {
        $love = $value['pic_collect'];
      }

      if ($love>0) {
         $love--;
      }
      
      $data = array( 'pic_collect' => $love );  
      $this->db->where('pic_uuid',$uuid); 
      $this->db->update('picture', $data); 

      return $love;
    }


    public function pass( $uuid ) {   //审核通过
      $this->db->where('pic_uuid', $uuid);
      $this->db->update('picture', array('pic_status' => 1)); 
    }

    public function edittags( $id,$tags ) {
      $data = array( 'pic_tag' => $tags );  
      $this->db->where('ID',$id); 
      $this->db->update('picture', $data); 
    }


  	//DELETE pic
    public function delete( $uuid ) {   //删除图片记录
      $this->db->delete('picture', array('pic_uuid' => $uuid)); 
    }


}
?>