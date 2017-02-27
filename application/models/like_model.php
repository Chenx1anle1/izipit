<?php
class Like_model extends CI_Model {

  public function __construct() {
      $this->load->database();
    }
  //SELECT
  public function is_like($uuid,$username) {
    $query = $this->db->get_where('like',array('like_pic' => $uuid,'like_user' => $username));
    return $query->num_rows();
  }

  public function pic_like($uuid) {
    $query = $this->db->get_where('like',array('like_pic' => $uuid));
    return $query->num_rows();
  }
  //INSERT
  public function add_like($uuid,$username) {
    $date = date("Y-m-d H:i:s");
    $like = array(
      'like_pic'      => $uuid, 
      'like_user'       => $username,
      'like_datetime' => $date
    );

    $query = $this->db->insert('like',$like);
    return $query;
  }
  //UPDATE
  //DELETE
  public function remove_like($uuid,$username) {
    $this->db->where('like_pic',$uuid);
    $this->db->where('like_user',$username);
    $query=$this->db->delete('like'); 
    return $query; 
  }
}
?>