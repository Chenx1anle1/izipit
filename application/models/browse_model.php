<?php
date_default_timezone_set('PRC');//时区设置
//时区设置存在代码中 B/S
class Browse_model extends CI_Model {

  public function __construct() {
      $this->load->database();
    }
  //SELECT

  public function browse()
  {
    $date = date('y-m-d h:i:s',time());
    $query = $this->db->get_where('browse',array('browse_date' => $date));
    return $query->num_rows();
  }

  public function browse_all()
  {
    $date = date('y-m-d h:i:s',time());
    $query = $this->db->get('browse');
    return $query->num_rows();
  }

  public function is_have($ip)
  {
    $date = date('y-m-d h:i:s',time());
    $query = $this->db->get_where('browse',array('browse_ip' => $ip,'browse_date' => $date));
    return $query->num_rows();
  }
  //INSERT
  public function add($ip) {
    $date = date('y-m-d h:i:s',time());
    $browse = array(
      'browse_ip' => $ip, 
      'browse_date' => $date,
    );

    $query = $this->db->insert('browse',$browse);
    return $query;
  }
  //UPDATE
  //DELETE
}
?>