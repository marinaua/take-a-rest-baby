<?php

namespace Api\DBAL;

class Query implements QueryInterface
{
    /** @var array */
    private $params = [];

    /** @var string */
    private $query;

    /**
     * @param string $query
     *
     * @return $this
     */
    public function setQuery($query){
        $this->query = $query;

        return $this;
    }

    /**
     * @param string $name
     * @param int|string $value
     *
     * @return $this
     */
    public function addParam($name, $value)
    {
        $this->params[$name] = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }
}