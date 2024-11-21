<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coins extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Memuat model yang diperlukan
        $this->load->model('Coins_m');
        $this->load->model('User_m');
        // Memastikan user login
        if (!$this->session->userdata('user_id')) {
            redirect('Auth/login');  // Jika user belum login, arahkan ke halaman login
        }
    }

    // Halaman utama: Menampilkan saldo dan transaksi
    public function index() {
        $user_id = $this->session->userdata('user_id');  // Mendapatkan user_id dari session
        
        $user = $this->User_m->get_users_by_id($user_id);
        if (!$user) {
            show_error('User not found', 404);  // Menampilkan error jika pengguna tidak ditemukan
        }

        // Data yang akan ditampilkan
        $data = [
            'transactions' => $this->Coins_m->get_user_transactions($user_id),
            'coins' => $user['coins'],
            'username' => $this->session->userdata('username'),
            'full_name' => $this->session->userdata('full_name'),
        ];
        // Load view
        $this->load->view('templates/header', $data);
        $this->load->view('coins/index', $data);  // Menampilkan halaman saldo koin
        $this->load->view('templates/footer');
    }

    // Fungsi untuk memproses top-up koin
    public function add_coins() {
        $user_id = $this->session->userdata('user_id');
        $payment_method = $this->input->post('payment_method');
        $coins = $this->input->post('coins');

        if (!$user_id || !$payment_method || !$coins) {
            $this->session->set_flashdata('error', 'Semua kolom harus diisi!');
            redirect('Coins');
        }

        // Data untuk transaksi
        $transaction_data = [
            'user_id' => $user_id,
            'payment_method' => $payment_method,
            'coins_amount' => $coins,
            'transaction_status' => 'unpaid',  // Status awal transaksi
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // Simpan transaksi
        if ($this->Coins_m->save_transaction($transaction_data)) {
            $this->session->set_flashdata('success', 'Transaksi top-up berhasil. Menunggu konfirmasi.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyimpan transaksi.');
        }

        redirect('Coins');
    }

    // Fungsi untuk menghapus transaksi yang dibatalkan
    public function cancel_transaction($transaction_id) {
        // Menghapus transaksi
        if ($this->Coins_m->delete_transaction($transaction_id)) {
            $this->session->set_flashdata('success', 'Transaksi berhasil dibatalkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal membatalkan transaksi.');
        }

        redirect('Coins');
    }

    // Fungsi untuk mengonfirmasi dan memperbarui status transaksi menjadi 'paid'
    public function approve_transaction($transaction_id) {
        $transaction = $this->Coins_m->get_transaction_by_id($transaction_id);

        if (!$transaction) {
            $this->session->set_flashdata('error', 'Transaksi tidak ditemukan.');
            redirect('Admin_Coins');  // Jika transaksi tidak ditemukan, kembali ke halaman admin
        }

        // Memperbarui status transaksi menjadi 'paid'
        if ($this->Coins_m->update_transaction_status($transaction_id, 'paid')) {
            // Menambahkan jumlah koin ke pengguna setelah transaksi disetujui
            $user_id = $transaction['user_id'];
            $this->Coins_m->process_topup($user_id, $transaction['coins_amount']);
            $this->session->set_flashdata('success', 'Transaksi berhasil diproses.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memproses transaksi.');
        }

        redirect('Admin_Coins');  // Redirect ke halaman admin setelah transaksi diproses
    }

    // Fungsi untuk mendapatkan transaksi berdasarkan user_id (untuk riwayat transaksi pengguna)
    public function get_user_transactions($user_id) {
        return $this->Coins_m->get_user_transactions($user_id);
    }

    // Fungsi untuk menampilkan riwayat transaksi top-up koin
    public function transaction_history() {
        $user_id = $this->session->userdata('user_id');
        $transactions = $this->Coins_m->get_user_transactions($user_id);
        
        $data = [
            'transactions' => $transactions,
            'coins' => $this->Coins_m->get_user_coins($user_id),
        ];
        
        $this->load->view('templates/header', $data);
        $this->load->view('coins/transaction_history', $data);
        $this->load->view('templates/footer');
    }
}
