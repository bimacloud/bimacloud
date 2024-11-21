<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Router extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // Cek apakah pengguna sudah login dan memiliki role admin
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role_id') != 1) {
            redirect('Auth/login'); // Arahkan ke halaman login jika bukan admin
        }

        $this->load->model('Router_m');
        $this->load->library('Routerosapi'); // Memuat library Routerosapi
    }

    // Fungsi untuk menampilkan daftar router MikroTik
    public function index() {
        $data = [
            'routers' => $this->Router_m->get_active_routers(),    // Mengambil daftar routers
            'username' => $this->session->userdata('username'),    // Menambahkan username ke data
            'full_name' => $this->session->userdata('full_name')   // Menambahkan full_name ke data
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('router/index', $data);
        $this->load->view('templates/footer');
    }

    // Fungsi untuk menambahkan router baru
    public function add_router() {
        if ($this->input->post()) {
            $data = [
                'name' => $this->input->post('name'),
                'ip_address' => $this->input->post('ip_address'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'port' => $this->input->post('port') ?: 8728,
                'status' => $this->input->post('status')
            ];
            $this->Router_m->add_router($data);
            redirect('Router/index');
        }
        $this->load->view('router/add');
    }

    // Fungsi untuk menghubungkan ke router MikroTik tertentu dan menjalankan perintah
      public function connect_to_router($id) {
        $router = $this->Router_m->get_router_by_id($id);

        if ($router && $router['status'] === 'active') {
            // Coba menghubungkan ke MikroTik
            $connected = $this->routerosapi->connect(
                $router['ip_address'],
                $router['username'],
                $router['password'],
                $router['port']
            );

            if ($connected) {
                echo "Berhasil terkoneksi ke " . $router['name'];
                $this->routerosapi->disconnect();
            } else {
                echo "Gagal terkoneksi ke " . $router['name'];
            }
        } else {
            echo "Router tidak ditemukan atau tidak aktif.";
        }
    }

}
