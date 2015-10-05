<?php

namespace Api\Controller;

use Api\Request\Request;

class AbstractController
{
    private $request;

    /**
     * @param mixed $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }
}