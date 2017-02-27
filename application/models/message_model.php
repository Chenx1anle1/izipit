<?php
class Message_model extends CI_Model {

	public function __construct() {
    	$this->load->database();
  	}
	//SELECT pic
  public function pic_message($uuid) {
    $this->db->order_by("msg_datetime", "asc"); 
    $query = $this->db->get_where('messages',array('msg_pic' => $uuid));
    return $query->result_array();
  }

  public function pic_count($uuid) {
    $query = $this->db->get_where('messages',array('msg_pic' => $uuid));
    return $query->num_rows();
  }
  public function rep_count($toid) {	  
      $query = $this->db->get_where('messages', array('msg_id' => $toid));
	  return $query->num_rows();
  }
public function rep_message($thisid)
{
    $this->db->order_by("msg_datetime", "asc");
    $query = $this->db->get_where('messages',array('msg_id' => $thisid));
    return $query->result_array();

}
	//INSERT pic
  public function message($user) { //新增 留言
    $now  = date("Y-m-d H:i:s");
    $message = array(
      'msg_text'     => $this->input->post('message'), 
      'msg_pic'    => $this->input->post('view'),
      'msg_user'     => $user,
      'msg_datetime' => $now
    );

    $db = $this->db->insert('messages',$message);
    return $db;
  }

  public function addmessage2($view,$text,$username,$toname,$msgid,$msg_status) { //新增留言
    $data = date("Y-m-d H:i:s");
    $user = $this->session->userdata('Username');
	$username = urldecode($username);

    $message = array('msg_text'=>$text, 'msg_pic'=>$view,'msg_user'=>$username,'msg_datetime'=>$data,'msg_toname'=>$toname,'msg_id'=>$msgid,'msg_status'=>$msg_status
		
    );

    $db = $this->db->insert('messages',$message);
    return $db;
  }
    public function addmessage($view,$text,$username) { //新增留言
    $data = date("Y-m-d H:i:s");
    $user = $this->session->userdata('Username');
	$username = urldecode($username);

    $message = array('msg_text'=>$text, 'msg_pic'=>$view,'msg_user'=>$username,'msg_datetime'=>$data
		
    );

    $db = $this->db->insert('messages',$message);
    return $db;
  }

	//UPDATE
	//DELETE
}
?>