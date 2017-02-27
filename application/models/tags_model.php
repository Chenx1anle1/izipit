<?php
class Tags_model extends CI_Model {

	public function __construct() {
    	$this->load->database();
  	}
  	//SELECT tags
  	public function tags() { //返回所以分类记录
      $this->db->order_by("tag_amount", "desc"); 
  		$query = $this->db->get('tags',40,0);
      return $query->result_array();
  	}

    public function alltags() { //返回所以标签使用数
      $this->db->order_by("tag_amount", "desc"); 
      $query = $this->db->get('tags');
      return $query->result_array();
    }

    public function is_tag( $tag ) {  //查看某个标签是否存在
      $query = $this->db->get_where('tags',array('tag_name' => $tag));
      return $query->num_rows();
    }
  	//INSERT tags
    public function addtag($tag) {
      $db = $this->db->insert('tags', array('tag_name' => $tag));
      return $db;
    }

  	//UPDATE tags
    public function addamount($tag) {
      $query = $this->db->get_where('tags',array('tag_name' => $tag));
      foreach ($query->result_array() as $value) {
        $amount = $value['tag_amount'];
      }

      $amount++;

      $data = array( 'tag_amount' => $amount );  
      $this->db->where('tag_name',$tag); 
      $this->db->update('tags', $data); 
    }
  	//DELETE tags
    public function delete( $id ) {  
      $this->db->delete('tags', array('ID' => $id)); 
    }
}
?>