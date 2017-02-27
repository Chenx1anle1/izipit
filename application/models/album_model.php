<?php
class Album_model extends CI_Model {

  private $pagenum = 15;

	public function __construct() 
  {
    $this->load->database();
  }
	//SELECT
  public function album($page) 
  {
    $this->db->order_by("ID", "desc"); 
    $query = $this->db->get('album',8,8*($page-1));
    return $query->result_array();
  }

  public function picture($album)
  {
    $this->db->order_by("ID", "desc");
    $query = $this->db->get_where('album_pic', array('album_id' => $album ));
    return $query->result_array();
  }

  public function picturenum($album)
  {
    $query = $this->db->get_where('album_pic', array('album_id' => $album ));
    return $query->num_rows();
  }

  public function is_pic($album,$pic) 
  {
    $query = $this->db->get_where('album_pic',array('album_id' => $album,'picture_id' => $pic));
    return $query->num_rows();
  }

  public function myalbum($user) 
  {
    $this->db->order_by("ID", "desc"); 
    $query = $this->db->get_where('album',array('album_user' => $user));
    return $query->result_array();
  }

  public function one($albumid,$page) 
  {
    $query = $this->db->get_where('album_pic', array('album_id' => $albumid ), $this->pagenum,$this->pagenum*($page-1));
    return $query->result_array();
  }

  public function is_have($user,$name) 
  {
    $query = $this->db->get_where('album',array('album_user' => $user,'album_name' => $name));
    return $query->num_rows();
  }

  public function useralbum($user) 
  {
    $query = $this->db->get_where('album',array('album_user' => $user));
    return $query->num_rows();
  }

  public function getid($name)
  {
    $query = $this->db->get_where('album',array('album_name' => $name));
    foreach ($query->result_array() as $value) {
      return $value['ID'];
    }
  }

  public function getbyid($id)
  {
    $query = $this->db->get_where('album',array('ID' => $id));
    return $query->result_array();
  }

	//INSERT
  public function creat($user,$name)
  {
    $album = array(
      'album_user' => $user, 
      'album_name' => $name
    );

    $db = $this->db->insert('album',$album);
    return $db;
  }

  public function add($album,$pic,$is_cover)
  {
    $album = array(
      'album_id' => $album, 
      'picture_id' => $pic,
      'is_cover' => $is_cover
    );

    $db = $this->db->insert('album_pic',$album);
    return $db;
  }
	//UPDATE
  public function add_picture($id,$pic)
  {
  }

  public function add_cover($id,$pic)
  {
  }
	//DELETE
  public function delete( $pic ) {
      $this->db->delete('album_pic', array('picture_id' => $pic)); 
  }
}
?>