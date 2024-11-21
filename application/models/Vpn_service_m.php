<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vpn_service_m extends CI_Model {

    // Menyimpan data order VPN
    public function save_vpn_order($data) {
        return $this->db->insert('vpn_service', $data);
    }

    // Mengambil data VPN berdasarkan user_id
    public function get_vpn_services_by_user($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->get('vpn_service')->result_array();
    }

    // Mengambil data VPN berdasarkan id
    public function get_vpn_service_by_id($vpn_id) {
        return $this->db->get_where('vpn_service', ['id' => $vpn_id])->row_array();
    }

    // Fungsi untuk menghasilkan port remote acak antara 10000 dan 60000
    public function generate_random_port() {
        return rand(10000, 60000);
    }

    // Fungsi untuk menghasilkan remote address dalam range 10.172.4.0/24
    public function generate_random_ip() {
        $last_octet = rand(1, 254);  // Range IP untuk subnet /24
        return "10.172.4." . $last_octet;
    }
    public function check_username_exists($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('vpn_service');
        return $query->num_rows() > 0;
    }
    

}
