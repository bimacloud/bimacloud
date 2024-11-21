<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_m');  // Memuat model Auth_m untuk login
        $this->load->model('User_m');  // Memuat model User_m untuk registrasi
        $this->load->library('session');  // Pastikan session di-load
    }

    // Fungsi untuk menampilkan halaman login
    public function login() {
        $this->load->view('auth/login');
    }

    // Fungsi untuk memproses login
    public function process_login() {
        $email = $this->input->post('email');  // Menggunakan email untuk login
        $password = $this->input->post('password');
        
        // Mengambil data pengguna berdasarkan email
        $user = $this->Auth_m->login($email, $password);
        
        if ($user) {
            // Debug: Pastikan data yang diterima sudah benar
            var_dump($user);  // Memeriksa data yang diterima dari model

            // Set session dengan username dan full_name
            $this->session->set_userdata([
                'user_id' => $user['user_id'],
                'email' => $user['email'],  // Menyimpan email dalam session
                'role_id' => $user['role_id'],
                'username' => $user['username'],  // Menyimpan username
                'full_name' => $user['first_name'] . ' ' . $user['last_name'],  // Menyimpan full_name
                'logged_in' => true
            ]);

            // Redirect ke Dashboard
            redirect('Dashboard');
        } else {
            $this->session->set_flashdata('error', 'Invalid email or password');
            redirect('Auth/login');
        }
    }

    // Fungsi untuk logout
    public function logout() {
        $this->session->sess_destroy();
        redirect('Auth/login');
    }

    // Fungsi untuk registrasi pengguna
    public function register() {
        if ($this->input->post()) {
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $email = $this->input->post('email');
            $whatsapp = $this->input->post('whatsapp');
            $password = $this->input->post('password');
            $repeat_password = $this->input->post('repeat_password');

            // Validasi password
            if ($password !== $repeat_password) {
                $this->session->set_flashdata('error', 'Password dan repeat password tidak cocok');
                redirect('Auth/register');
            }

            // Validasi email (pastikan email tidak terdaftar)
            if ($this->User_m->is_email_exists($email)) {
                $this->session->set_flashdata('error', 'Email sudah terdaftar');
                redirect('Auth/register');
            }

            // Simpan data pengguna ke database (gunakan model untuk menyimpan data)
            $data = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'whatsapp' => $whatsapp,
                'password' => password_hash($password, PASSWORD_BCRYPT), // Menggunakan password hashing
                'role_id' => 2, // Misalnya role_id 2 untuk pengguna biasa
            ];

            $this->User_m->register_user($data);

            // Redirect ke halaman login setelah registrasi berhasil
            redirect('Auth/login');
        }

        $this->load->view('auth/register');
    }
}
