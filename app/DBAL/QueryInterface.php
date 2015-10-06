<?php

namespace Api\DBAL;

interface QueryInterface
{
    /**
     * @return string
     */
    public function getQuery();

    /**
     * @param string $query
     *
     * @return $this
     */
    public function setQuery($query);

    /**
     * @param string $name
     * @param int|string $value
     *
     * @return $this
     */
    public function addParam($name, $value);

    /**
     * @return array
     */
    public function getParams();
}