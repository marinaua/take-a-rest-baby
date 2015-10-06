<?php

namespace Api\Model;

use Api\DBAL\DBAL;
use Api\DBAL\Query;
use Api\Helper\ArrayHelper;

class AddressModel
{
    /** @var array */
    private $tableColumns = [
        'ADDRESSID',
        'LABEL',
        'STREET',
        'HOUSENUMBER',
        'POSTALCODE',
        'CITY',
        'COUNTRY'
    ];

    /**
     * @param array $params
     *
     * @return array
     */
    public function getList(array $params)
    {
        $selectFields = $this->prepareSelectFields(
            ArrayHelper::get('fields', $params)
        ); // TODO: replace static 'get' with DI

        $dbal = DBAL::getInstance();

        $queryString = 'SELECT ' . (empty($selectFields) ? '*' : implode(', ', $selectFields))
            . ' FROM address';

        $query = (new Query())->setQuery($queryString);
        $result = $dbal->getDefaultConnection()->fetchAll($query);

        return $result;
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function getById($id)
    {
        $queryString = 'SELECT * FROM address WHERE ADDRESSID = :id';

        $dbal = DBAL::getInstance();

        $query = (new Query())->setQuery($queryString)->addParam(':id', $id);
        $result = $dbal->getDefaultConnection()->fetchAll($query);

        return isset($result[0]) ? $result[0] : [];
    }

    /**
     * @param int $id
     * @param array $params
     *
     * @return void
     */
    public function updateById($id, array $params)
    {
        $queryString = 'UPDATE address SET ' . $this->prepareSetFields($params) . '  WHERE `ADDRESSID` = :id';

        $dbal = DBAL::getInstance();

        $query = (new Query())->setQuery($queryString)->addParam(':id', $id);

        foreach($params as $key => $value) {
            $query->addParam(':' . strtolower($key), $value);
        }

        $dbal->getDefaultConnection()->execute($query);
    }

    /**
     * @param array $params
     *
     * @return string
     */
    private function prepareSetFields(array $params)
    {
        $setFields = [];

        foreach($params as $key => $value) {
            $setFields[] = '`' . $key . '` = :' . strtolower($key);
        }

        return implode(', ', $setFields);
    }

    /**
     * @param string $fieldsString
     *
     * @return array
     */
    private function prepareSelectFields($fieldsString)
    {
        return array_intersect($this->parseFields($fieldsString), $this->tableColumns);
    }

    /**
     * @param string $fieldsString
     *
     * @return array
     */
    private function parseFields($fieldsString)
    {
        return explode(',', str_replace([' '], '', trim($fieldsString, '()')));
    }
}