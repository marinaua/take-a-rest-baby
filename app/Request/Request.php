<?php

namespace Api\Request;

class Request
{
    /** @var array */
    private $get;

    /** @var array */
    private $post;

    /** @var string */
    private $requestUri;

    /** @var string */
    private $requestMethod;

    /** @var string */
    private $rawData;

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->requestUri = $_SERVER['REQUEST_URI'];
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        $this->rawData = file_get_contents("php://input");
    }

    /**
     * @param string $rawData
     */
    public function setRawData($rawData)
    {
        $this->rawData = $rawData;
    }

    /**
     * @return string
     */
    public function getRawData()
    {
        return $this->rawData;
    }

    /**
     * @return array
     */
    public function getGet()
    {
        return $this->get;
    }

    /**
     * @return array
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @return string
     */
    public function getRequestUri()
    {
        return $this->requestUri;
    }

    /**
     * @return string
     */
    public function getRequestMethod()
    {
        return $this->requestMethod;
    }
}