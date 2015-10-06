<?php

namespace Api\Response;

abstract class AbstractResponse
{
    /** @var int */
    protected $status = HttpStatusCodesEnum::HTTP_STATUS_OK;

    /** @var array */
    private $arrayData = [];

    /**
     * @return void
     */
    abstract public function render();

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setArrayData(array $data)
    {
        $this->arrayData = $data;

        return $this;
    }

    /**
     * @return array
     */
    public function getArrayData()
    {
        return $this->arrayData;
    }

    /**
     * @param int $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return void
     */
    protected  function throwStatus()
    {
        http_response_code($this->status);
    }


}