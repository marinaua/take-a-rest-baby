<?php

namespace Api\Response;

abstract class AbstractResponse
{
    const HTTP_STATUS_OK = 200;
    const HTTP_STATUS_NOT_FOUND = 404;

    private $arrayData;
    protected $status = self::HTTP_STATUS_OK;


    abstract public function render();

    public function setArrayData(array $data)
    {
        $this->arrayData = $data;
    }

    public function getArrayData()
    {
        return $this->arrayData;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    protected  function throwStatus(){
        http_response_code($this->status);
    }


}