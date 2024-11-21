<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tripay_m extends CI_Model {

    private $api_url;
    private $api_key;
    private $merchant_code;

    public function __construct() {
        parent::__construct();
        $this->load->config('tripay');  // Memuat konfigurasi tripay.php
        $this->api_url = $this->config->item('tripay_api_url');
        $this->api_key = $this->config->item('tripay_api_key');
        $this->merchant_code = $this->config->item('merchant_code');
    }

    // Fungsi untuk membuat transaksi pembayaran dengan Tripay
    public function create_payment($amount, $order_id) {
        $post_data = [
            'method' => 'BANK_TRANSFER',  // Pilih metode pembayaran, bisa berubah sesuai pilihan
            'merchant_code' => $this->merchant_code,
            'order_id' => $order_id,
            'amount' => $amount,
            'customer_name' => 'Nama Pengguna',  // Nama pengguna bisa diambil dari sesi pengguna
            'customer_email' => 'email@pengguna.com',  // Email pengguna
            'callback_url' => base_url('coins/payment_callback'),  // Callback URL untuk status pembayaran
            'return_url' => base_url('coins/topup_success'),  // Redirect setelah pembayaran berhasil
        ];

        $signature = hash_hmac('sha256', $this->merchant_code . $order_id . $amount . $this->api_key, $this->api_key);  // Menghitung signature untuk keamanan
        $post_data['signature'] = $signature;

        // Mengirim permintaan ke API Tripay
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api_url . 'payment/create');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
