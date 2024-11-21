<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_m extends CI_Model {

    // Fungsi untuk memeriksa login pengguna
    public function login($email, $password) {
        // Ambil data pengguna berdasarkan email
        $this->db->where('email', $email);
        $query = $this->db->get('users');  // Misalkan tabel pengguna bernama 'users'

        if ($query->num_rows() == 1) {
            $user = $query->row_array();
            
            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                return [
                    'user_id' => $user['user_id'],
                    'email' => $user['email'],
                    'username' => $user['username'],  // Pastikan ini ada di DB
                    'first_name' => $user['first_name'],  // Ambil first_name dari DB
                    'last_name' => $user['last_name'],  // Ambil last_name dari DB
                    'role_id' => $user['role_id']
                ];
            }
        }

        return false;  // Jika login gagal
    }
}
