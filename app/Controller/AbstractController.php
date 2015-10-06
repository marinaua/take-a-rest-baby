<?php

namespace Api\Controller;

use Api\Request\Request;

class AbstractController
{
    /** @var  Request */
    private $request;

    /**
     * @param Request $request
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