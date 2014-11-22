<?php
namespace Poirot\Database\Driver;

use Poirot\Database\Connection\ConnectionInterface;
use Poirot\Database\Platform\PlatformInterface;
use Poirot\Database\Statement\StatementInterface;

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
     * Get Statement
     *
     * @return StatementInterface
     */
    function statement();

    /**
     * Get Database Engine Platform
     *
     * @return PlatformInterface
     */
    function platform();

    /**
     * Get Connection
     *
     * @return ConnectionInterface
     */
    function connection();
}
