<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    // Ambil semua produk
    public function get_all_products()
    {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('products')->result_array();
    }

    // Ambil 1 produk by slug
    public function get_product_by_slug($slug)
    {
        return $this->db->get_where('products', ['slug' => $slug])->row_array();
    }

    // Simpan produk baru
    public function insert_product($data)
    {
        return $this->db->insert('products', $data);
    }
    public function insert_best_seller($id) {
    $product = $this->get_product_by_id($id);
    if ($product) {
        $this->db->insert('best_seller', $product);
    }
}

public function insert_on_sale($id) {
    $product = $this->get_product_by_id($id);
    if ($product) {
        $this->db->insert('on_sale', $product);
    }
}


    // Update produk

    // Hapus produk
    public function delete_product($id)
    {
        return $this->db->delete('products', ['id' => $id]);
    }

    // Ambil semua best seller
    public function get_all_best_sellers()
    {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('best_seller')->result_array();
    }

    // Ambil semua on sale
    public function get_all_on_sale()
    {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('on_sale')->result_array();
    }


public function delete_best_seller($id) {
    $this->db->where('id', $id);
    return $this->db->delete('best_seller');
}


public function delete_on_sale($id) {
    $this->db->where('id', $id);
    return $this->db->delete('on_sale');
}

public function get_product_by_id($id)
{
    return $this->db->get_where('products', ['id' => $id])->row_array();
}

public function update_product($id, $data)
{
    $this->db->where('id', $id);
    return $this->db->update('products', $data);
}

public function get_on_sale_by_id($id) {
      $this->db->order_by('created_at', 'DESC');
    return $this->db->get_where('on_sale', ['id' => $id])->row_array();
}

public function update_on_sale($id, $data) {
    $this->db->where('id', $id);
    return $this->db->update('on_sale', $data);
}

public function get_best_seller_by_id($id) {
      $this->db->order_by('created_at', 'DESC');
    return $this->db->get_where('best_seller', ['id' => $id])->row_array();
}

public function update_best_seller($id, $data) {
    $this->db->where('id', $id);
    return $this->db->update('best_seller', $data);
}

public function get_products_by_type($type) {
      $this->db->order_by('created_at', 'DESC');
    return $this->db->get($type)->result_array();
}

public function get_best_seller_by_slug($slug)
{
    return $this->db->get_where('best_seller', ['slug' => $slug])->row_array();
}

public function get_on_sale_by_slug($slug)
{
    return $this->db->get_where('on_sale', ['slug' => $slug])->row_array();
}

public function get_related_products($slug, $table)
{
    $this->db->where('slug !=', $slug);
    $this->db->order_by('created_at', 'DESC');
    $this->db->limit(4);
    return $this->db->get($table)->result_array();
}


}
