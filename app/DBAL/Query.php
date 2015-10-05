<?php
namespace Api\DBAL;


class Query implements QueryInterface{

    private $params = [];
    private $query;

    public function __construct()
    {
//        $this->statement = new \PDOStatement();
    }


    public function setQuery($query){
        $this->query = $query;

        return $this;
    }

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
     * @return mixed
     */
    public function getQuery()
    {
        return $this->query;
    }





}