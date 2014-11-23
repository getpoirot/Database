<?php
namespace Poirot\Database\Platform;

use Poirot\Database\Connection\ConnectionInterface;
use Poirot\Database\Driver\Result\ResultInterface;
use Poirot\Database\Statement\StatementEngineInterface;
use Poirot\Database\Statement\StatementInterface;

interface PlatformInterface extends StatementEngineInterface
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
     * Get Driver Query From Statement
     *
     * @param StatementInterface $statement Statement
     *
     * @return mixed
     */
    public function prepareStatement($statement);

    /**
     * Get Executable Query From Statement
     * @link http://php.net/manual/en/mysqli.quickstart.prepared-statements.php
     *
     * @param StatementInterface $statement Statement
     *
     * @return mixed
     */
    public function prepareExecutableStatement($statement);

    /**
     * Attain To Abstract Result From Specific Engine Result
     *
     * @param mixed $result Connection Engine(resource) Result
     *
     * @return ResultInterface
     */
    public function prepareExecResult($result);
}
