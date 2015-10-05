<?php

namespace Api;

use Api\Router\Route;
use Api\Request\RequestMethodEnum;
use Api\Router\Router;

return [
    (new Route())
        ->setPattern('\/addresses\/(\d+)')
        ->setRequestMethod(RequestMethodEnum::GET)
        ->setController('Address')
        ->setAction('getById'),
    (new Route())
        ->setPattern('\/addresses\?{0,1}(.*)$')
        ->setRequestMethod(RequestMethodEnum::GET)
        ->setController('Address')
        ->setAction('list'),
    (new Route())
        ->setPattern('\/addresses\/(\d+)')
        ->setRequestMethod(RequestMethodEnum::PUT)
        ->setController('Address')
        ->setAction('updateById')
];