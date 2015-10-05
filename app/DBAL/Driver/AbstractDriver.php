<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Marik
 * Date: 05.10.15
 * Time: 22:46
 * To change this template use File | Settings | File Templates.
 */

namespace Api\DBAL\Driver;


use Api\DBAL\QueryInterface;

abstract class AbstractDriver implements DriverInterface
{
    protected $connection;
    protected $password;
    protected $user;
    protected $host;
    protected $database;

    abstract public function execute(QueryInterface $query);

    /**
     * @param mixed $database
     */
    public function setDatabase($database)
    {
        $this->database = $database;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

}