<?php
namespace Poirot\Database\Mysqli;

use Poirot\Database\Connection\ConnectionInterface;
use Poirot\Database\Driver\AbstractDriver;
use Poirot\Database\Driver\ResultInterface;

class Driver extends AbstractDriver
{
    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @var Platform
     */
    protected $platform;

    /**
     * Get Database(Schema) name from connection
     *
     * @return string
     */
    function getDbName()
    {
        // TODO: Implement getDbName() method.
    }

    /**
     * Execute Statement Directly To Resource
     *
     * @param mixed $stm Statement
     *
     * @return ResultInterface
     */
    function exec($stm)
    {
        $res = $this->connection->getConnection()
            ->query($stm);

        return $this->platform()->attainAbstractResult($res);
    }

    /**
     * Get Database Engine Platform
     *
     * @return Platform
     */
    function platform()
    {
        if (!$this->platform instanceof Platform) {
            $platform = new Platform();
            $platform->setConnection($this->connection);

            $this->platform = $platform;
        }

        return $this->platform;
    }

    /**
     * Set Connection
     *
     * @param ConnectionInterface $connection Connection Instance
     *
     * @throws \Exception
     * @return $this
     */
    function setConnection(ConnectionInterface $connection)
    {
        if (! $connection->getEngine() instanceof \mysqli)
            throw new \Exception('This driver only support "mysqli" connection engine.');

        $this->connection = $connection;

        return $this;
    }
}
 