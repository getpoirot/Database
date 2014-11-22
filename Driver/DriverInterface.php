<?php
namespace Poirot\Database\Driver;

use Poirot\Database\Connection\ConnectionInterface;
use Poirot\Database\Platform\PlatformInterface;

interface DriverInterface
{
    /**
     * Get Database(Schema) name from connection
     *
     * @return string
     */
    function getDbName();

    /**
     * Execute Statement Directly To Resource
     *
     * @param mixed $stm Statement
     *
     * @return ResultInterface
     */
    function exec($stm);

    /**
     * Get Database Engine Platform
     *
     * @return PlatformInterface
     */
    function platform();

    /**
     * Set Connection
     *
     * @param ConnectionInterface $connection Connection Instance
     *
     * @throws \Exception If Wont Support Connection Engine
     * @return $this
     */
    function setConnection(ConnectionInterface $connection);
}
