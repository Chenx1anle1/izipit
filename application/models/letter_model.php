<?php
class Letter_model extends CI_Model {

  public function __construct() {
      $this->load->database();
    }
  //SELECT
  public function myletter($username) { //未读私信数量
    $query = $this->db->get_where('letter', array('letter_to' => $username, 'letter_status'   => 0));
    return $query->num_rows();
  }




  public function commnet($username,$page) { //评论
    $this->db->order_by("letter_status", "asc");
    $this->db->order_by("letter_datetime", "desc");
    $query = $this->db->get_where('letter', array('letter_to' => $username, 'letter_type' => 2),20,20*($page-1));
    return $query->result_array();
  }



  public function is_letter( $id ) {  //查看记录是否存在
    $query = $this->db->get_where('letter',array('ID' => $id));
    return $query->num_rows();
  }
  //INSERT
  public function send_letter($user,$name,$text) {
    $date   = date("Y-m-d H:i:s");
    $letter = array(
      'letter_form'     => $name, 
      'letter_to'       => $user,
      'letter_text'     => $text,
      'letter_type'     => 0,
      'letter_status'   => 0,
      'letter_datetime' => $date
    );

    $query = $this->db->insert('letter',$letter);
    return $query;
  }

  public function add_commnet($username,$uuid){
    $date    = date("Y-m-d H:i:s");
    $text    = $username."你的图片".$uuid."有了一条新的评论。<a href='" . base_url('view/' . $uuid) . "'><label class='icon-search'></label>&nbsp&nbsp&nbsp&nbsp&nbsp查&nbsp&nbsp&nbsp看</a>";
    $commnet = array(
      'letter_form'     => "系统", 
      'letter_to'       => $username,
      'letter_text'     => $text,
      'letter_type'     => 2,
      'letter_status'   => 0,
      'letter_datetime' => $date
    );

    $query = $this->db->insert('letter',$commnet);
    return $query;
  }
  public function add_notice($username,$text){
    $date    = date("Y-m-d H:i:s");
    $notice  = array(
      'letter_form'     => "评论管理系统", 
      'letter_to'       => $username,
      'letter_text'     => $text,
      'letter_type'     => 1,
      'letter_status'   => 0,
      'letter_datetime' => $date
    );

    return $query;
  }
 
  //UPDATE 
  public function update( $id ) {   //标为已读
	  $this->db->where('id', $id);
	  $this->db->update('letter', array('letter_status' => 1)); 
	}
  //DELETE
    public function delete( $id ) {   //删除图片记录
      $this->db->delete('letter', array('ID' => $id)); 
    }
}
?>