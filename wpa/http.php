<?php

class HTTPRequest
{
    private $url;


    public function __construct()
    {
        $this->url = "http://127.0.0.1:3001/";
    }

    /**
     * GET
     * 
     */
    public function get($route)
    {
        $ch = curl_init($this->url . $route);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $response = $this->execute($ch);
        return $response;
    }

    /**
     * POST
     * 
     */
    public function post($route, $data)
    {
        $json = json_encode($data);

        $ch = curl_init($this->url . $route);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json)
        ]);

        $response = $this->execute($ch);
        return $response;
    }

    /**
     * PUT
     * 
     */
    public function put($route, $data)
    {
        $json = json_encode($data);

        $ch = curl_init($this->url . $route);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json)
        ]);

        $response = $this->execute($ch);
        return $response;
    }

    /**
     * DELETE
     * 
     */
    public function delete($route)
    {
        $ch = curl_init($this->url . $route);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

        $response = $this->execute($ch);
        return $response;
    }

    /**
     * Execute
     * 
     */
    private function execute($ch)
    {
        $response = json_decode(curl_exec($ch), true);
        return @$response['payload'];
    }
}
