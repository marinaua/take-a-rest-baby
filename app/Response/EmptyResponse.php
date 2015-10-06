<?php

namespace Api\Response;

use Api\Response\AbstractResponse;

class EmptyResponse extends AbstractResponse
{
    /**
     * @return void
     */
    public function render()
    {
        $this->throwStatus();
        echo '';
    }
}