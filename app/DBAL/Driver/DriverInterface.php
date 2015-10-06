<?php

namespace Api\DBAL\Driver;

use Api\DBAL\QueryInterface;

interface DriverInterface
{
    /**
     * @return $this
     * @throws \Exception|\PDOException
     */
    public function connect();

    /**
     * @param string $password
     *
     * @return $this
     */
    public function setPassword($password);

    /**
     * @param string $user
     *
     * @return $this
     */
    public function setUser($user);

    /**
     * @param string $database
     *
     * @return $this
     */
    public function setDatabase($database);

    /**
     * @param string $host
     *
     * @return $this
     */
    public function setHost($host);

    /**
     * @param QueryInterface $query
     *
     * @return \PDOStatement
     * @throws \PDOException
     */
    public function execute(QueryInterface $query);

    /**
     * @return string
     */
    public function getPassword();

    /**
     * @return string
     */
    public function getUser();

    /**
     * @return string
     */
    public function getDatabase();

    /**
     * @return string
     */
    public function getHost();

    /**
     * @param QueryInterface $query
     *
     * @return array
     */
    public function fetchAll(QueryInterface $query);

}