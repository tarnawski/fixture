<?php

namespace Fixture\Driver;

use Fixture\DriverInterface;
use Fixture\Exception\FixtureDriverException;

/**
 * Class PDODriver
 * @package Fixture\Driver
 */
class PDODriver implements DriverInterface
{
    /** @var \PDO */
    private $pdo;

    /**
     * PDODriver constructor.
     * @param $database
     * @param $host
     * @param $port
     * @param $user
     * @param $password
     * @throws FixtureDriverException
     */
    public function __construct($database, $host, $port, $user, $password)
    {
        $dns = sprintf('mysql:dbname=%s;host=%s;port=%s', $database, $host, $port);

        try {
            $this->pdo = new \PDO($dns, $user, $password);
        } catch (\PDOException $exception) {
            throw new FixtureDriverException($exception->getMessage());
        }
    }

    /**
     * Load data to database
     * @param array $data
     * @throws FixtureDriverException
     */
    public function load(array $data)
    {
        foreach ($data as $table => $items) {
            foreach ($items as $item) {
                $fields = array_keys($item);
                $values = array_values($item);
                $values = array_map(function ($value) {
                    return sprintf("'%s'", $value);
                }, $values);
                $insert = "INSERT INTO document (" . implode(",", $fields) . ") VALUES (" . implode(",", $values) . ")";
                $status = $this->pdo->exec($insert);

                if (!$status) {
                    throw new FixtureDriverException(implode(":", $this->pdo->errorInfo()));
                }
            }
        }
    }
}
