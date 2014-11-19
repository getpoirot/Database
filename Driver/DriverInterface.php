<?php
namespace Poirot\Database\Driver;

use Poirot\Database\Connection\ConnectionInterface;

interface DriverInterface
{
    /**
     * Set Connection
     * - validate connection engine against driver
     *   by Connection::getEngine()
     *
     * @param ConnectionInterface $conn Connection
     *
     * @throws \Exception
     * @return $this
     */
    public function setConnection(ConnectionInterface $conn);

    /**
     * Get Database(Schema) name from connection
     *
     * @return string
     */
    public function getDb();

    /**
     * Execute Statement
     *
     * @param mixed $statement Statement
     * @return ResultInterface
     */
    public function exec($statement);

    /**
     * Get Database Engine Platform
     *
     * @return PlatformInterface
     */
    public function platform();
}
