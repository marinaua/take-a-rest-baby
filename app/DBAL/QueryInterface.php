<?php
namespace Api\DBAL;

interface QueryInterface {

    public function setQuery($query);

    public function addParam($name, $value);

    public function getParams();
}