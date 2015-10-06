<?php
namespace Api\DBAL\Driver;


use Api\DBAL\QueryInterface;

class MysqlDriver extends AbstractDriver
{
    /**
     * @param QueryInterface $query
     *
     * @return \PDOStatement
     * @throws \PDOException
     */
    public function execute(QueryInterface $query)
    {
        /** @var \PDOStatement $statement */
        $statement = $this->connection->prepare($query->getQuery());

        $statement->execute($query->getParams());

        if ($statement->errorCode() != 0) {
            throw new \PDOException(implode(',',$statement->errorInfo()));
        }

        return $statement;
    }

    /**
     * @param QueryInterface $query
     *
     * @return array
     */
    public function fetchAll(QueryInterface $query)
    {
        $statement = $this->execute($query);

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @return $this
     * @throws \Exception|\PDOException
     */
    public function connect()
    {
        try {
            $this->connection  = new \PDO(
                "mysql:host=" . $this->getHost(). ";dbname=" . $this->database,
                $this->getUser(),
                $this->getPassword()
            );
        } catch (\PDOException $e) {
            // TODO: Log error
            throw $e;
        }

        return $this;
    }
}