<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait Revolut
{
    private function createOrder($amount, $currency, $email)
    {
        $headers = [
            'Authorization' => 'Bearer ' . env('REVOLUT_API_KEY'),
        ];
        $client = new Client([
            'headers' => $headers,
        ]);
        // CONVERTING MAJOR CURRENCY TO MINOR CURRENCY // REVOLUT ACCEPTS MINOR CURRENCY
        $amount = $amount * 100;

        // SETTING UP PARAMS TO SEND IN CREATE ORDER API
        $params = [
            'amount' => $amount,
            'currency' => $currency,
            'email' => $email,
        ];
        // 3rd PARTY API CALL TO CREATE AN ORDER
        $data = $client->post(env('REVOLUT_API_URL') . '/orders', [
            \GuzzleHttp\RequestOptions::JSON => $params
        ]);
        $data = $data->getBody()->getContents();
        $data = json_decode($data, true);
        return $data;
    }
}
