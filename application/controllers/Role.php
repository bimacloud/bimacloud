<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url'); // Load URL helper
        $this->load->model('Role_m');
    }

    // Menampilkan semua role
    public function index() {
        $data['roles'] = $this->Role_m->get_roles();
        $this->load->view('roles/index', $data);
    }

    // Form untuk menambahkan role baru
    public function create() {
        $this->load->view('roles/create');
    }

    // Menyimpan role baru
    public function store() {
        $roleData = [
            'role_name' => $this->input->post('role_name')
        ];
        $this->Role_m->insert_role($roleData);
        redirect('Role/index');
    }

    // Form untuk mengedit role
    public function edit($role_id) {
        $data['role'] = $this->Role_m->get_role_by_id($role_id);
        $this->load->view('roles/edit', $data);
    }

    // Menyimpan perubahan role
    public function update($role_id) {
        $roleData = [
            'role_name' => $this->input->post('role_name')
        ];
        $this->Role_m->update_role($role_id, $roleData);
        redirect('Role/index');
    }

    // Menghapus role
    public function delete($role_id) {
        $this->Role_m->delete_role($role_id);
        redirect('Role/index');
    }
}
