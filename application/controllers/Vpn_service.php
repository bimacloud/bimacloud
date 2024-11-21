<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vpn_service extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Vpn_service_m');  // Memuat model VPN
        $this->load->model('User_m');  // Memuat model User untuk validasi
        $this->load->model('Coins_m');

    }

    // Fungsi untuk menampilkan halaman order VPN
    public function index() {
        $user_id = $this->session->userdata('user_id');  // Mendapatkan user_id dari session

        if (!$user_id) {
            redirect('Auth/login');  // Jika pengguna belum login, arahkan ke halaman login
        }

        $data['username'] = $this->session->userdata('username');
        $data['full_name'] = $this->session->userdata('full_name');
        $data['vpn_services'] = $this->Vpn_service_m->get_vpn_services_by_user($user_id);  // Mendapatkan data VPN

        // Pilihan server yang tersedia
        $data['servers'] = ['Server 1', 'Server 2', 'Server 3', 'Server 4'];

        // Menampilkan view dengan data
        $this->load->view('templates/header', $data);
        $this->load->view('vpn_service/index', $data);
        $this->load->view('templates/footer');
    }

    // Fungsi untuk membuat order VPN
    public function create_order() {
        $user_id = $this->session->userdata('user_id');  // Mendapatkan user_id dari session

        if (!$user_id) {
            redirect('Auth/login');  // Jika pengguna belum login, arahkan ke halaman login
        }

        // Validasi inputan form
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('port_forwarding', 'Port Forwarding', 'required');
        $this->form_validation->set_rules('server', 'Server', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['username'] = $this->session->userdata('username');
            $data['servers'] = ['Server 1', 'Server 2', 'Server 3', 'Server 4'];  // Pilihan server
            $this->load->view('templates/header', $data);
            $this->load->view('vpn_service/create_order');  // Menampilkan form order VPN
            $this->load->view('templates/footer');
        } else {
            // Menyiapkan data order VPN
            $vpn_data = [
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'port_forwarding' => $this->input->post('port_forwarding'),
                'port_remote' => $this->Vpn_service_m->generate_random_port(),  // Port acak
                'remote_address' => $this->Vpn_service_m->generate_random_ip(),  // IP acak dari range
                'server' => $this->input->post('server'),
                'user_id' => $user_id
            ];

            // Tentukan harga VPN berdasarkan server atau paket yang dipilih
            $vpn_price = 0;
            $server = $this->input->post('server');
            
            // Misalkan harga VPN berbeda berdasarkan pilihan server (Anda bisa sesuaikan)
            if ($server == 'Server 1') {
                $vpn_price = 2000;
            } elseif ($server == 'Server 2') {
                $vpn_price = 5000;
            } elseif ($server == 'Server 3') {
                $vpn_price = 10000;
            }

            // Cek apakah saldo koin cukup untuk membuat order
            $user_coins = $this->Coins_m->get_user_coins($user_id);
            if ($user_coins >= $vpn_price) {
                // Deduct coins from user's account
                if ($this->Coins_m->deduct_user_coins($user_id, $vpn_price)) {
                    // Simpan order VPN
                    if ($this->Vpn_service_m->save_vpn_order($vpn_data)) {
                        $this->session->set_flashdata('success', 'Order VPN berhasil dibuat.');
                        redirect('Vpn_service');  // Redirect ke halaman utama setelah berhasil
                    } else {
                        $this->session->set_flashdata('error', 'Gagal membuat order VPN.');
                        redirect('Vpn_service/create_order');  // Kembali ke halaman form order VPN jika gagal
                    }
                } else {
                    $this->session->set_flashdata('error', 'Saldo koin tidak cukup untuk melakukan order.');
                    redirect('Vpn_service/create_order');  // Kembali ke halaman form order VPN jika gagal
                }
            } else {
                $this->session->set_flashdata('error', 'Saldo koin tidak cukup untuk melakukan order.');
                redirect('Vpn_service/create_order');  // Kembali ke halaman form order VPN jika saldo tidak cukup
            }
        }
    }

    public function check_username_exists() {
        $username = $this->input->post('username');  // Ambil username dari request

        // Cek apakah username sudah ada di database
        if ($this->Vpn_service_m->check_username_exists($username)) {
            echo json_encode(['exists' => true]);
        } else {
            echo json_encode(['exists' => false]);
        }
    }


}
