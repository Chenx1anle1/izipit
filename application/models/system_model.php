<?php
class System_model extends CI_Model {

	public function __construct() {
    	$this->load->database();
  	}
	//SELECT
    public function get_webtitle() {
      $query = $this->db->get_where('systeminfo',array('sys_title' => 'webtitle'));
      foreach ($query->result_array() as $value) {
        return $value['sys_value'];
      }
    }

    public function get_keywords() {
      $query = $this->db->get_where('systeminfo',array('sys_title' => 'keywords'));
      foreach ($query->result_array() as $value) {
        return $value['sys_value'];
      }
    }

    public function get_description() {
      $query = $this->db->get_where('systeminfo',array('sys_title' => 'description'));
      foreach ($query->result_array() as $value) {
        return $value['sys_value'];
      }
    }

    public function get_imageNum() {
      $query = $this->db->get_where('systeminfo',array('sys_title' => 'imagenum'));
      foreach ($query->result_array() as $value) {
        return $value['sys_value'];
      }
    }

    public function get_imageSize() {
      $query = $this->db->get_where('systeminfo',array('sys_title' => 'imagesize'));
      foreach ($query->result_array() as $value) {
        return $value['sys_value'];
      }
    }
	//INSERT
	//UPDATE
    public function set_webtitle() {
      $info = array( 'sys_value' => $this->input->post('webtitle') );  
      $this->db->where('sys_title','webtitle'); 
      $this->db->update('systeminfo', $info); 
    }

    public function set_keywords() {
      $info = array( 'sys_value' => $this->input->post('keywords') );  
      $this->db->where('sys_title','keywords'); 
      $this->db->update('systeminfo', $info); 
    }

    public function set_description() {
      $info = array( 'sys_value' => $this->input->post('description') );  
      $this->db->where('sys_title','description'); 
      $this->db->update('systeminfo', $info); 
    }

    public function set_imageNum() {
      $info = array( 'sys_value' => $this->input->post('imagenum') );  
      $this->db->where('sys_title','imagenum'); 
      $this->db->update('systeminfo', $info); 
    }

    public function set_imageSize() {
      $info = array( 'sys_value' => $this->input->post('imagesize') );  
      $this->db->where('sys_title','imagesize'); 
      $this->db->update('systeminfo', $info); 
    }
	//DELETE
}
?>