<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

  public function index() {
    $query = $this->db->get('products');
    echo '<pre>';
    print_r($query->result_array());
    echo '</pre>';
  }
}
