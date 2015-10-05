<?php

namespace Api\Model;

use Api\DBAL\DBAL;
use Api\DBAL\Query;
use Api\Model\ArrayHelper;

class AddressModel
{
    private $tableColumns = [
        'ADDRESSID',
        'LABEL',
        'STREET',
        'HOUSENUMBER',
        'POSTALCODE',
        'CITY',
        'COUNTRY'
    ];

    private $connection;

    public function __construct()
    {
        $this->connection = new \mysqli("localhost", "root", "", "rest");

        if ($this->connection->connect_errno) {
            echo "Failed to connect to MySQL: (" . $this->connection->connect_errno . ") " . $this->connection->connect_error;
            die;
        }
    }

    public function getList(array $params)
    {
        $result = [];

        $selectFields = $this->prepareSelectFields(ArrayHelper::get('fields', $params)); // TODO: replace static 'get' with DI

        $sql = 'SELECT ' . (empty($selectFields) ? '*' : implode(', ', $selectFields))
            . ' FROM address';

        $queryResult = $this->connection->query($sql);

        while($row = $queryResult->fetch_assoc()) {
            $result[] = $row;
        }

        return $result;
    }

    public function getById($id)
    {
        $query = 'SELECT * FROM address WHERE ADDRESSID = :id';

        $dbal = DBAL::getInstance();

        $query = (new Query())->setQuery($query)->addParam(':id', $id);
        $res = $dbal->getDefaultConnection()->fetchAll($query);

        return isset($res[0]) ? $res[0] : [];
    }

    private function prepareSelectFields($fieldsString)
    {
        return array_intersect($this->parseFields($fieldsString), $this->tableColumns);
    }

    private function parseFields($fieldsString)
    {
        return explode(',', trim($fieldsString, '()'));
    }
}