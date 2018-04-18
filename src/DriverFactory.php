<?php

namespace Fixture;

use Fixture\Driver\PDODriver;
use Fixture\Exception\FixtureDriverException;

class DriverFactory
{
    const PDO_DRIVER = 'pdo';
    const DEFAULT_DRIVER = 'pdo';

    /** @var PDODriver */
    private $pdoDriver;

    /**
     * DriverFactory constructor.
     * @param PDODriver $pdoDriver
     */
    public function __construct(PDODriver $pdoDriver)
    {
        $this->pdoDriver = $pdoDriver;
    }

    /**
     * Get driver
     * @param string $driver
     * @return PDODriver
     * @throws FixtureDriverException
     */
    public function getDriver(string $driver = self::DEFAULT_DRIVER)
    {
        switch ($driver) {
            case self::PDO_DRIVER:
                return $this->pdoDriver;
                break;
            default:
                throw new FixtureDriverException(sprintf('Driver %s not found!', $driver));
        }
    }
}
