<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Router_m extends CI_Model {

    public function get_active_routers() {
        return $this->db->get_where('mikrotik_routers', ['status' => 'active'])->result_array();
    }
    
    public function get_router_by_id($id) {
        return $this->db->get_where('mikrotik_routers', ['id' => $id])->row_array();
    }

    public function add_router($data) {
        return $this->db->insert('mikrotik_routers', $data);
    }
}
