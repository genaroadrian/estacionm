<?php

namespace App\Http\Controllers;

// use GuzzleHttp\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index() {

        $client = new Client([
            'base_uri' => 'https://backend.thinger.io',
        ]);
        $url = 'https://backend.thinger.io/v1/users/Rubes/buckets/Variables_Meteorologicas/data?items=100&max_ts=0&sort=desc';
        $headers = ['Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE2MzY1OTI4MTUsImlhdCI6MTYzNjU4NTYxNSwicm9sZSI6InVzZXIiLCJ1c3IiOiJSdWJlcyJ9.XUsyyMYF8ifg2-2Ast6evzu3FNR60ESq2VRr06vS5vY'];
    
        try{
            $request = new Psr7Request('GET', $url, $headers);
            $response = $client->send($request);
            $variables =  $response->getBody();
            return $variables[0];
        }catch(\Throwable $error) {
            $response = $error;
            return $response;
        }
        
    }
}
