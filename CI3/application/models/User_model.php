<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function get_user_by_username($username) {
        return $this->db->where('username', $username)
                        ->limit(1)
                        ->get('users')
                        ->row();  // return object
    }

	public function get_by_username($username) {
        return $this->db->get_where('users', ['username' => $username])->row_array();
    }

	public function get_all_users() {
        return $this->db->order_by('created_at', 'DESC')
                        ->get('users')
                        ->result_array();
    }

	public function insert_user($data) {
    	return $this->db->insert('users', $data);
	}

	public function get_user_by_id($id)
	{
		return $this->db->get_where('users', ['id' => $id])->row_array();
	}

	

	public function delete_user($id)
	{
		return $this->db->delete('users', ['id' => $id]);
	}

	public function update_user($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('users', $data);
	}

	public function username_exists_other($username, $current_id)
	{
		$this->db->where('username', $username);
		$this->db->where('id !=', $current_id);
		$query = $this->db->get('users');
		return $query->num_rows() > 0;
	}

	public function username_exists($username)
	{
		return $this->db->where('username', $username)->get('users')->num_rows() > 0;
	}
	
}
