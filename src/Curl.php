<?php

namespace Webserver;

/**
 * Class Curl
 * @package WebServer
 */
class Curl
{
    /**
     * @var false|resource
     */
    private  $curl;
    /**
     * @var
     */
    private  $url;
    /**
     * @var
     */
    private  $response;

    /**
     * Curl constructor.
     * @param null $url
     * @throws \ErrorException
     */
    public function __construct($url = null)
    {
        if (!extension_loaded('curl')) {
            throw new \ErrorException('cURL library is not loaded');
        }

        $this->curl = curl_init();
        $this->initialize($url);
    }

    /**
     *
     */
    public function close()
    {
        if (is_resource($this->curl)) {
            curl_close($this->curl);
        }
    }

    /**
     * @param null $url
     */
    private function initialize($url = null)
    {
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, "PUT");
    }

    /**
     * @param $data_json
     */
    public function put($data_json){
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data_json);
        $this->response  = curl_exec($this->curl);
        $x = curl_error($this->curl);
        $this->close();
    }
}