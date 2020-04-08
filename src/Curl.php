<?php

namespace Webserver;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Webserver\Config\Config;

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
     * @var integer
     */
    private $responseHttpCode;

    /**
     * Curl constructor.
     * @throws \ErrorException
     */
    public function __construct($url)
    {
        $this->url = $url;
        if (!extension_loaded('curl')) {
            throw new \ErrorException('cURL library is not loaded');
        }

        $this->curl = curl_init();
        $this->initialize($url);
    }

    /**
     * @return int
     */
    public function getResponseHttpCode(): int
    {
        return $this->responseHttpCode;
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
    }

    /**
     * @param $data_json
     * @return bool|string
     */
    public function put($data_json)
    {
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data_json);
        $this->response  = curl_exec($this->curl);
        $this->responseHttpCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
        $errors = curl_error($this->curl);
        $this->close();
        if($this->response) {
            return $this->response;
        }
        return $errors;
    }

    /**
     * @param $data_json
     * @return bool|string
     */
    public function get()
    {
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $this->response  = curl_exec($this->curl);
        $this->responseHttpCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
        $errors = curl_error($this->curl);
        $this->close();
        if (404 === $this->responseHttpCode) {
            throw new \RuntimeException('Quesiton not found', 404);
        }
        if($this->response) {
            return $this->response;
        }
        return $errors;
    }
}