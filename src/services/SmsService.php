<?php 

namespace App\services;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class SmsService{

    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function send( $to , $content ){

        $this->client->request(
            'GET',
            "https://platform.clickatell.com/messages/http/send?apiKey=JQHZLSAJSWKfkYChmuZNjg==&to=". $to ."&content=".$content
        );
        
    }



}