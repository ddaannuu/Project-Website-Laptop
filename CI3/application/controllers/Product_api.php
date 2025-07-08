<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        header("Access-Control-Allow-Origin: http://localhost:5173");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");
        header("Content-Type: application/json");
    }

    public function get_new_arrival() {
        echo json_encode($this->Product_model->get_products_by_type('products'));
    }

    public function get_best_seller() {
        echo json_encode($this->Product_model->get_products_by_type('best_seller'));
    }

    public function get_on_sale() {
        echo json_encode($this->Product_model->get_products_by_type('on_sale'));
    }
}
