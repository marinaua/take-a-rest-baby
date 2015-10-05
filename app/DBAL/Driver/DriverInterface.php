<?php
namespace Api\DBAL\Driver;

use Api\DBAL\QueryInterface;

interface DriverInterface {

    public function connect();

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword($password);
    public function setUser($user);
    public function setDatabase($database);
    public function setHost($host);
    public function execute(QueryInterface $query);

    public function getPassword();
    public function getUser();
    public function getDatabase();
    public function getHost();
    public function fetchAll(QueryInterface $query);

}