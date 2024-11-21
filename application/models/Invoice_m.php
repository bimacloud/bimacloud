<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_m extends CI_Model {

    // Fungsi untuk menyimpan data invoice
    public function save_invoice($data) {
        return $this->db->insert('invoices', $data);  // Menyimpan data invoice
    }

    // Fungsi untuk mendapatkan invoice berdasarkan ID
    public function get_invoice_by_id($invoice_id) {
        return $this->db->get_where('invoices', ['invoice_id' => $invoice_id])->row_array();
    }

    // Fungsi untuk memperbarui status invoice
    public function update_invoice_status($invoice_id, $status) {
        $this->db->set('status', $status);
        $this->db->where('invoice_id', $invoice_id);
        $this->db->update('invoices');
    }
}
