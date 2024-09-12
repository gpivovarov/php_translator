<?php
namespace Database;

abstract class ABSDatabase
{
    protected null|\PDO $connection = null;

    /**
     * Create a new connection to DB or returns existed
     * @return \PDO
     * @throws \Exception
     */
    public function connect(): \PDO
    {
        if (!(defined('PROJECT_MYSQL_DATABASE_HOST') && defined('PROJECT_MYSQL_DATABASE_NAME') && defined('PROJECT_MYSQL_USER_NAME') && defined('PROJECT_MYSQL_USER_PASSWORD'))) {
            throw new \Exception('DB configuration parameters missing');
        }
        if (is_null($this->connection)) {
            $this->connection = new \PDO('mysql:host=' . \PROJECT_MYSQL_DATABASE_HOST . ';dbname=' . \PROJECT_MYSQL_DATABASE_NAME . ';charset=utf8', \PROJECT_MYSQL_USER_NAME, \PROJECT_MYSQL_USER_PASSWORD);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        return $this->connection;
    }

    public function closeConnection(): void
    {
        $this->connection = null;
    }
}