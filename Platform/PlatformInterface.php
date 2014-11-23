<?php
namespace Poirot\Database\Platform;

use Poirot\Database\Connection\ConnectionInterface;
use Poirot\Database\Driver\Result\ResultInterface;
use Poirot\Database\Statement\StatementEngineInterface;

interface PlatformInterface extends
    StatementEngineInterface
{
    /**
     * @return mixed
     */
    public function getSupportedPlatform();

    /**
     * Set Platform Connection
     *
     * @param ConnectionInterface $conn Connection
     *
     * @return $this
     */
    public function setConnection(ConnectionInterface $conn);

    /**
     * Attain To Abstract Result From Specific Engine Result
     *
     * @param mixed $result Connection Engine(resource) Result
     *
     * @return ResultInterface
     */
    public function prepareExecResult($result);
}
