<?php
namespace Poirot\Database\Mysqli;

use Poirot\Database\Connection\ConnectionInterface;
use Poirot\Database\Driver\AbstractDriver;
use Poirot\Database\Driver\Exception;
use Poirot\Database\Driver\Result\ResultInterface;

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
     * @var string Query Statement
     */
    protected $lastStatement;

    /**
     * Execute Statement Directly To Resource
     *
     * @param mixed $stm Statement
     *
     * @return ResultInterface
     */
    function exec($stm)
    {
        $this->lastStatement = $stm;

        // Unbuffered
        /*
        $this->connection->getConnection()->real_query($stm);
        $res = $this->connection->getConnection()->use_result();
        */

        // Buffered
        $res = $this->connection->getConnection()
            ->query($stm);

        if ($error = $this->connection->hasError())
            $res = $error;

        return $this->platform()->attainAbstractResult($res);
    }

    /**
     * Get Last Executed Statement
     *
     * @return mixed
     */
    function getLastStatement()
    {
        return $this->lastStatement;
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
        if (! $connection->getOrigin() instanceof \mysqli)
            throw new \Exception('This driver only support "mysqli" connection engine.');

        $this->connection = $connection;

        return $this;
    }
}
 