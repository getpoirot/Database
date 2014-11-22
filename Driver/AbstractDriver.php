<?php
namespace Poirot\Database\Driver;

use Poirot\Database\Connection\ConnectionInterface;

abstract class AbstractDriver implements DriverInterface
{
    final function __construct(ConnectionInterface $connection)
    {
        $this->setConnection($connection);
    }
}
