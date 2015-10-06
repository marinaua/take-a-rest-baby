<?php

namespace Api\DBAL;

use Api\DBAL\Driver\DriverInterface;

class DBAL
{
    const DEFAULT_CONNECTION_ALIAS = 'default';

    /** @var null|DBAL  */
    private static $instance = null;

    /** @var array */
    private $connections = [];

    private function __construct() {}

    /**
     * @param DriverInterface $connection
     * @param string $alias
     */
    public function addConnection(DriverInterface $connection, $alias = self::DEFAULT_CONNECTION_ALIAS )
    {
        $this->connections[$alias] = $connection;
    }

    /**
     * @return DriverInterface
     */
    public function getDefaultConnection()
    {
        return $this->connections[self::DEFAULT_CONNECTION_ALIAS];
    }

    /**
     * @return DBAL
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return array
     */
    public function getConnections()
    {
        return $this->connections;
    }

    private function __clone(){}
}