<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model {
    
    public function get_users() {
        return $this->db->select('users.*, roles.role_name')
                        ->from('users')
                        ->join('roles', 'users.role_id = roles.role_id')
                        ->get()
                        ->result_array();
    }

    public function insert_user($data) {
        return $this->db->insert('users', $data);
    }
    
    public function get_user_by_username($username) {
        return $this->db->get_where('users', ['username' => $username])->row_array();
    }
   /* public function get_user_by_email($email) {
        return $this->db->get_where('users', ['email' => $email])->row_array();
    }
*/
    // Fungsi untuk memeriksa apakah email sudah terdaftar
    public function is_email_exists($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        
        // Mengembalikan TRUE jika email sudah ada, FALSE jika belum ada
        if ($query->num_rows() > 0) {
            return true;
        }
        return false;
    }

    // Fungsi untuk mendaftarkan pengguna baru
    public function register_user($data) {
        return $this->db->insert('users', $data);
    }

       // Fungsi untuk mendapatkan data pengguna berdasarkan user_id
    public function get_users_by_id($user_id) {
        return $this->db->get_where('users', ['user_id' => $user_id])->row_array();
    }


    // Fungsi untuk memperbarui saldo koin pengguna
    public function update_user_coins($user_id, $new_coin_balance) {
        // Update saldo koin di database untuk user dengan user_id tertentu
        $this->db->set('coins', $new_coin_balance);
        $this->db->where('user_id', $user_id);
        $this->db->update('users');
    }
    public function get_user_by_email($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');  // Gantilah 'users' dengan nama tabel yang sesuai
        if ($query->num_rows() > 0) {
            return $query->row_array(); // Mengembalikan hasil pertama dalam bentuk array
        } else {
            return null;  // Jika data tidak ditemukan, kembalikan null
        }
    }
    public function update_user_by_email($email, $data) {
        // Update data pengguna berdasarkan email
        $this->db->where('email', $email);
        return $this->db->update('users', $data);
    }


}
