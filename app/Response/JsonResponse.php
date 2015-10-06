<?php

namespace Api\Response;

use Api\Response\AbstractResponse;

class JsonResponse extends AbstractResponse
{
    /**
     * @return void
     */
    public function render()
    {
        $this->throwStatus();
        echo json_encode($this->getArrayData());
    }
}