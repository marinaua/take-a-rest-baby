<?php

namespace Api\Response;

interface HttpStatusCodesEnum
{
    const HTTP_STATUS_OK = 200;
    const HTTP_STATUS_BAD_REQUEST = 400;
    const HTTP_STATUS_NOT_FOUND = 404;
    const HTTP_STATUS_INTERNAL_SERVER_ERROR = 500;
}