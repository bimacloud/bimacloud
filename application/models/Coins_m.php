<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coins_m extends CI_Model {

    public function get_user_coins($user_id) {
        $this->db->select('coins');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('users');
        return $query->row_array()['coins'];
    }

    public function save_transaction($data) {
        return $this->db->insert('coins_transactions', $data);
    }

    public function get_transaction_by_id($transaction_id) {
        return $this->db->get_where('coins_transactions', ['transaction_id' => $transaction_id])->row_array();
    }

    public function update_transaction_status($transaction_id, $status) {
        $this->db->set('transaction_status', $status);
        $this->db->where('transaction_id', $transaction_id);
        return $this->db->update('coins_transactions');
    }

    public function get_user_transactions($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('coins_transactions')->result_array();
    }

    public function process_topup($user_id, $amount) {
        $this->db->set('coins', 'coins + ' . (int)$amount, FALSE);
        $this->db->where('user_id', $user_id);
        return $this->db->update('users');
    }

    public function delete_transaction($transaction_id) {
        $this->db->where('transaction_id', $transaction_id);
        return $this->db->delete('coins_transactions');
    }
    public function get_all_transactions() {
        $this->db->order_by('created_at', 'DESC');  // Urutkan berdasarkan tanggal terbaru
        return $this->db->get('coins_transactions')->result_array();  // Mengambil semua data transaksi
    }
    // Fungsi untuk mengurangi koin pengguna
    public function deduct_user_coins($user_id, $amount) {
        $this->db->set('coins', 'coins - ' . (int)$amount, FALSE);  // Mengurangi jumlah koin
        $this->db->where('user_id', $user_id);
        return $this->db->update('users');  // Update saldo koin di tabel users
    }

}
