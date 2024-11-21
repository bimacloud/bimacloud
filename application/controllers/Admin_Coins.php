<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Coins extends CI_Controller {

    public function __construct() {
    parent::__construct();
    
    // Pastikan pengguna sudah login
    if (!$this->session->userdata('user_id')) {
        redirect('Auth/login');  // Jika belum login, arahkan ke halaman login
    }

    // Cek apakah pengguna adalah admin
    $this->load->model('User_m');  // Pastikan model User_m dimuat di sini
    if (!$this->is_admin($this->session->userdata('user_id'))) {
        show_error('Akses ditolak. Hanya admin yang dapat mengelola transaksi.', 403);  // Jika bukan admin, tampilkan pesan error
    }

    $this->load->model('Coins_m');  // Model untuk transaksi top-up
}


    // Fungsi untuk mengecek apakah pengguna adalah admin
    private function is_admin($user_id) {
        // Ambil data pengguna berdasarkan user_id
        $user = $this->User_m->get_users_by_id($user_id); 

        // Cek apakah role pengguna adalah admin
        return $user && $user['role_id'] == 1 ;  // Asumsi 'admin' adalah role untuk admin
    }

    // Fungsi untuk menampilkan semua transaksi top-up
    public function index() {


        $data = [
            'transactions' => $this->Coins_m->get_all_transactions(),
            'username' => $this->session->userdata('username'),
            'full_name' => $this->session->userdata('full_name')
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('admin/coins_transactions', $data);  // Tampilkan daftar transaksi
        $this->load->view('templates/footer');
    }

    // Fungsi untuk approve transaksi
    public function approve($transaction_id) {
        // Ambil transaksi berdasarkan ID
        $transaction = $this->Coins_m->get_transaction_by_id($transaction_id);

        if (!$transaction) {
            $this->session->set_flashdata('error', 'Transaksi tidak ditemukan!');
            redirect('Admin_Coins/index');
        }

        // Pastikan status transaksi adalah unpaid
        if ($transaction['transaction_status'] != 'unpaid') {
            $this->session->set_flashdata('error', 'Transaksi sudah diproses atau disetujui.');
            redirect('Admin_Coins/index');
        }

        // Update status transaksi menjadi 'approved'
        $this->Coins_m->update_transaction_status($transaction_id, 'paid');

        // Tambahkan koin ke saldo pengguna
        $this->Coins_m->process_topup($transaction['user_id'], $transaction['coins_amount']);

        // Set pesan berhasil
        $this->session->set_flashdata('success', 'Transaksi berhasil disetujui dan koin ditambahkan.');
        
        redirect('Admin_Coins/index');  // Redirect ke halaman transaksi
    }

    // Fungsi untuk menolak transaksi (cancel)
    public function cancel($transaction_id) {
        // Ambil transaksi berdasarkan ID
        $transaction = $this->Coins_m->get_transaction_by_id($transaction_id);

        if (!$transaction) {
            $this->session->set_flashdata('error', 'Transaksi tidak ditemukan!');
            redirect('Admin_Coins/index');
        }

        // Hapus transaksi yang dibatalkan
        $this->Coins_m->delete_transaction($transaction_id);

        // Set pesan berhasil
        $this->session->set_flashdata('success', 'Transaksi telah dibatalkan.');
        
        redirect('Admin_Coins/index');  // Redirect ke halaman transaksi
    }
}
