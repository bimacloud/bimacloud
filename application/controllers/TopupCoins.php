<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TopupCoins extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // Cek apakah pengguna sudah login
        if (!$this->session->userdata('logged_in')) {
            redirect('Auth/login'); // Arahkan ke halaman login jika belum login
        }

        // Load model untuk menangani operasi database
        $this->load->model('Invoice_m');
        $this->load->model('User_m');
    }

    // Menampilkan form untuk melakukan top-up
    public function index() {
        $data = [
            'username' => $this->session->userdata('username'),
            'full_name' => $this->session->userdata('full_name')
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('topup/form');
        $this->load->view('templates/footer');
    }

    public function process() {
    // Ambil data dari form
    $coin_amount = $this->input->post('coin_amount');
    $payment_method = $this->input->post('payment_method');

    // Simulasi ID invoice, status, dan data lain yang diperlukan
    $invoice_id = rand(100000, 999999); // Generating a random invoice ID
    $status = "UNPAID"; // Status invoice, bisa disesuaikan
    $total_amount = $coin_amount;  // Nilai total sesuai dengan jumlah koin yang dipilih

    // Pastikan data email dan phone ada di session
    $email = $this->session->userdata('email');
    $phone = $this->session->userdata('phone');

    // Data invoice
    $data = [
        'invoice_id' => $invoice_id,
        'user_id' => $this->session->userdata('user_id'), // Gunakan user_id yang valid
        'coin_amount' => $coin_amount,
        'payment_method' => $payment_method,
        'total_amount' => $total_amount,
        'invoice_date' => date('Y-m-d H:i:s'),
        'status' => $status,
        'email' => $email, // Ambil email dari session
        'phone' => $phone, // Ambil phone dari session
    ];

    // Simpan transaksi ke dalam database
    $this->Invoice_m->save_invoice($data);

    // Simpan transaksi ke dalam session untuk menampilkan di invoice page
    $this->session->set_userdata('last_invoice', $data);

    // Redirect ke halaman invoice
    redirect('TopupCoins/invoice');
}


    // Menampilkan invoice
    public function invoice() {
        // Ambil data invoice dari session
        $data['invoice'] = $this->session->userdata('last_invoice');
        
        // Pastikan data tersedia, jika tidak, redirect kembali ke halaman form
        if (empty($data['invoice'])) {
            redirect('TopupCoins/index');
        }

        // Ambil data user untuk menampilkan role
        $this->load->model('User_m');
        $user_data = $this->User_m->get_user_by_username($data['invoice']['username']);
        $data['role'] = $user_data['role_name'];  // Mengambil role_name dari tabel roles

        // Tampilkan halaman invoice
        $this->load->view('templates/header', $data);
        $this->load->view('topup/invoice', $data);
        $this->load->view('templates/footer');
    }

    // Admin approve invoice dan update koin pengguna
    public function approve_invoice($invoice_id) {
        // Ambil data invoice berdasarkan invoice_id
        $invoice = $this->Invoice_m->get_invoice_by_id($invoice_id);

        // Jika invoice ditemukan dan statusnya 'UNPAID'
        if ($invoice && $invoice['status'] === 'UNPAID') {
            // Update status invoice menjadi 'PAID'
            $this->Invoice_m->update_invoice_status($invoice_id, 'PAID');

            // Ambil user_id berdasarkan username invoice
            $user = $this->User_m->get_user_by_username($invoice['username']);

            if ($user) {
                // Tambahkan jumlah koin yang dibeli ke dalam kolom 'coins' di tabel users
                $new_coin_balance = $user['coins'] + $invoice['coin_amount'];
                $this->User_m->update_user_coins($user['user_id'], $new_coin_balance);
            }

            // Redirect ke halaman invoice
            redirect('TopupCoins/invoice');
        } else {
            // Jika invoice tidak ditemukan atau sudah terbayar, redirect ke halaman lainnya
            show_error('Invoice not found or already paid', 404);
        }
    }
}
