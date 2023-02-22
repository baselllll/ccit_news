<?php

namespace App\Services;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class MsegatService
{
    public function __construct()
    {
        $this->URL = config('msegat.URL');
        $this->USER_NAME = config('msegat.USER_NAME');
        $this->API_KEY = config('msegat.API_KEY');
        $this->headers = [
            'Content-Type'=> 'application/json',
        ];
        $this->client = new Client(['base_uri' => $this->URL]);
    }

    public function sendMessage($phone, $message)
    {
        try {
            $res = $this->client
                ->request(
                    'POST',
                    'sendsms.php'
                    ,array(
                    'headers' => $this->headers,
                    'body' => $this->formatData($phone, $message)
                ));
            $responseJSON = json_decode($res->getBody(), true);

        }catch (RequestException $e) {
            return $e;
        };
        return $responseJSON;
    }

    protected function formatData($phone, $message)
    {
        $data = [
            "userName" => $this->USER_NAME,
            "numbers" => $phone,
            "userSender" => $this->USER_NAME,
            "apiKey" => $this->API_KEY,
            "msg" => $message,
        ];
        return json_encode($data);
    }
}
