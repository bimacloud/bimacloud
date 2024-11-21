<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('User_m');
        $this->load->model('Role_m');
    }

    public function index() {
        // Ambil email user berdasarkan session
        $email = $this->session->userdata('email');
        $data = [];

        // Jika form di-submit untuk mengubah data
        if ($this->input->post('form_submission') === 'edit_user') {
            // Ambil data dari form
            $first_name = $this->input->post('firstname');
            $last_name = $this->input->post('lastname');
            $new_password = $this->input->post('newpass');
            $confirm_password = $this->input->post('conf_newpass');

            // Validasi password baru
            if (!empty($new_password) && $new_password !== $confirm_password) {
                $this->session->set_flashdata('error', 'Password dan konfirmasi password tidak cocok!');
                redirect('User/index');
            }

            // Persiapkan data untuk pembaruan
            $update_data = [
                'first_name' => $first_name,
                'last_name' => $last_name
            ];

            // Jika password diubah, hash password dan update
            if (!empty($new_password)) {
                $update_data['password'] = password_hash($new_password, PASSWORD_DEFAULT);
            }

            // Update data pengguna
            $this->User_m->update_user_by_email($email, $update_data);

            // Set flash message dan redirect ke halaman index
            $this->session->set_flashdata('success', 'Data akun berhasil diperbarui');
            redirect('User/index');
        }

        // Ambil data pengguna berdasarkan email
        if ($email) {
            $user_data = $this->User_m->get_user_by_email($email);
            if ($user_data) {
                // Menambahkan data user ke dalam array data
                $data['user'] = $user_data;
                $data['email'] = $user_data['email'];
                $data['created_at'] = $user_data['created_at'];
                $data['first_name'] = $user_data['first_name'];
                $data['last_name'] = $user_data['last_name'];
            } else {
                $data['email'] = 'Email tidak ditemukan';
                $data['created_at'] = 'Tanggal tidak ditemukan';
                $data['first_name'] = 'first name tidak ditemukan';
                $data['last_name'] = 'last name tidak ditemukan';
            }
        } else {
            $data['email'] = 'Email tidak ditemukan';
            $data['created_at'] = 'Tanggal tidak ditemukan';
            $data['first_name'] = 'first name tidak ditemukan';
            $data['last_name'] = 'last name tidak ditemukan';
        }

        // Data tambahan dari session
        $data['full_name'] = $this->session->userdata('full_name');
        
        // Memuat view
        $this->load->view('templates/header', $data);
        $this->load->view('users/index', $data);
        $this->load->view('templates/footer');
    }


    public function create() {
        $data['roles'] = $this->Role_m->get_roles();
        $this->load->view('users/create', $data);
    }

    public function store() {
        $userData = [
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'email' => $this->input->post('email'),
            'role_id' => $this->input->post('role_id')
        ];

        $this->User_m->insert_user($userData);
        redirect('User/index');
    }
}
