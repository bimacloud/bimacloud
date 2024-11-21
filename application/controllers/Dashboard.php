<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        
        if (!$this->session->userdata('logged_in')) {
            redirect('Auth/login');
        }
    }

    public function index() {
        $role_id = $this->session->userdata('role_id');
        $data = [
            'username' => $this->session->userdata('username'),
            'full_name' => $this->session->userdata('full_name'),
        ];

        if ($role_id == 1) { // Admin
            $data['role'] = 'Admin';
            $data['message'] = 'Welcome to the Admin Dashboard';
        } elseif ($role_id == 2) { // Customer
            $data['role'] = 'Customer';
            $data['message'] = 'Welcome to the Customer Dashboard';
        } else {
            show_error('Access Denied', 403);
        }

        // Load views dengan data tambahan untuk username dan full_name
        $this->load->view('templates/header', $data);
        $this->load->view('templates/content', $data);
        $this->load->view('templates/footer');
    }
}
