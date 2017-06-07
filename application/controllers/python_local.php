<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class python_local extends CI_Controller {

  public function index( $id = 0 ) {
    $k = '';
    $a = array();
    exec('Python ./dist/python/test.py '.$k, $a);
    var_dump($a);
  }
}

/* End of file xixi.php */
/* Location: ./application/controllers/xixi.php */