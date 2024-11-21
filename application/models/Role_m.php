<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_m extends CI_Model {
    
    public function get_roles() {
        return $this->db->get('roles')->result_array();
    }

    public function insert_role($data) {
        return $this->db->insert('roles', $data);
    }

    public function get_role_by_id($role_id) {
        return $this->db->get_where('roles', ['role_id' => $role_id])->row_array();
    }

    public function update_role($role_id, $data) {
        return $this->db->where('role_id', $role_id)->update('roles', $data);
    }

    public function delete_role($role_id) {
        return $this->db->where('role_id', $role_id)->delete('roles');
    }
}
