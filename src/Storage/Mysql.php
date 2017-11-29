<?php

namespace Shortener\Storage;

use Slim\PDO\Database;

class Mysql
{
    private $dsn;
    private $user;
    private $password;

    private $pdo;

    public function __construct(string $dsn, string $user, string $password)
    {
        $this->dsn = $dsn;
        $this->user = $user;
        $this->password = $password;
    }

    private function connect()
    {
        if (!$this->isConnected()) {
            $this->pdo = new Database($this->dsn, $this->user, $this->password);
        }
    }

    private function isConnected(): bool
    {
        return $this->pdo !== null;
    }

    public function getConnection(): Database
    {
        if (!$this->isConnected()) {
            $this->connect();
        }

        return $this->pdo;
    }

    public function insertOne(string $table, array $data)
    {
        $stmt = $this->getConnection()
            ->insert(array_keys($data))
            ->into($table)
            ->values(array_values($data));

        return $stmt->execute(false);
    }

    public function exists(string $table, array $condition): bool
    {
        $stmt = $this->getConnection()
            ->select(['COUNT(*)'])
            ->from($table);

        $this->applyCondition($stmt, $condition);

        $count = $stmt->execute()->fetchColumn();

        return $count > 0;
    }

    public function selectOne(string $table, array $condition): array
    {
        $stmt = $this->getConnection()
            ->select()
            ->from($table)
            ->limit(1);

        $this->applyCondition($stmt, $condition);

        return $stmt->execute()->fetch(\PDO::FETCH_ASSOC);
    }

    private function applyCondition(\Slim\PDO\Statement\SelectStatement $stmt, array $condition)
    {
        foreach ($condition as $column => $value) {
            $stmt->where($column, '=', $value);
        }
    }
}
