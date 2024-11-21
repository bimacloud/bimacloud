<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tripay {
    private $api_key = 'DEV-5nwHydNEZ4wermXH5CyPV5j0KeD2zIeOzZpLfK15';
    private $private_key = 'wMzua-RldvU-Et3wK-YbJ8E-Lj4FV';
    private $url = 'https://api.tripay.co.id/transaction/create';

    public function createTransaction($params) {
        $data = [
            'merchant_code' => 'T17938',
            'order_id' => $params['order_id'],
            'amount' => $params['amount'],
            'customer_name' => $params['customer_name'],
            'email' => $params['email'],
            'phone' => $params['phone'],
            'callback_url' => $params['callback_url'],
            'return_url' => $params['return_url']
        ];

        $signature = hash_hmac('sha256', implode('', $data), $this->private_key);
        $data['signature'] = $signature;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
