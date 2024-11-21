<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curl {

    // Perform a cURL request
    public function request($url, $data = [], $headers = []) {
        $ch = curl_init();

        // Check if the request is a POST
        if (!empty($data)) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Set headers if provided
        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        // Execute the cURL request
        $response = curl_exec($ch);

        // Handle errors
        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            return ['status' => 'error', 'message' => $error];
        }

        // Close the cURL session
        curl_close($ch);

        // Return the response
        return json_decode($response, true);
    }
}
