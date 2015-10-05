<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Marik
 * Date: 04.10.15
 * Time: 16:03
 * To change this template use File | Settings | File Templates.
 */

namespace Api\Response;

use Api\Response\AbstractResponse;

class EmptyResponse extends AbstractResponse
{
    public function render()
    {
        $this->throwStatus();
        echo '';
    }
}