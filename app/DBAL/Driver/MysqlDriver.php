<?php
namespace Api\DBAL\Driver;


use Api\DBAL\QueryInterface;

class MysqlDriver extends AbstractDriver
{

    public function execute(QueryInterface $query)
    {
        $statement = $this->connection->prepare($query->getQuery());

        foreach($query->getParams() as $name => $value) {
            $type = \PDO::PARAM_INT;

            switch($value){
                case is_string($value):
                    $type = \PDO::PARAM_STR;
            }

            $statement->bindParam($name, $value, $type);
        }

        $statement->execute();

        return $statement;
    }

    public function fetchAll(QueryInterface $query)
    {
        $statement = $this->execute($query);

        return $statement->fetchAll();
    }


    public function connect()
    {
        try {
            $this->connection  = new \PDO(
                "mysql:host=" . $this->getHost(). ";dbname=" . $this->database,
                $this->getUser(),
                $this->getPassword()
            );
        } catch (\PDOException $e) {
            throw $e;
        }

        return $this;
    }
}