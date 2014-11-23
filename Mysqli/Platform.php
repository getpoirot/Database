<?php
namespace Poirot\Database\Mysqli;

use Poirot\Database\Connection\ConnectionInterface;
use Poirot\Database\Platform\PlatformInterface;
use Poirot\Database\Statement\StatementExecutableInterface;
use Poirot\Database\Statement\StatementInterface;

class Platform implements
    PlatformInterface,
    StatementExecutableInterface
{
    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @return mixed
     */
    public function getSupportedPlatform()
    {
        return array('mysqli', 'mysql');
    }

    /**
     * Get Driver Query From Statement
     *
     * @param StatementInterface $statement Statement
     *
     * @return mixed Usually String
     */
    public function prepareStatement($statement)
    {
        // convert statement to sql
        // return sql as query string
    }

    /**
     * Get Executable Query From Statement
     * @link http://php.net/manual/en/mysqli.quickstart.prepared-statements.php
     *
     * @param StatementInterface $statement Statement
     *
     * @return mixed
     */
    public function prepareExecutableStatement($statement)
    {
        // convert statement to sql
        // bind values
        // return prepared execute statement
    }

    /**
     * Attain To Abstract Result From Specific Engine Result
     *
     * @param mixed $result Connection Engine(resource) Result
     *
     * @return Result
     */
    public function prepareExecResult($result)
    {
        $return = new Result();
        $return->setOrigin($result);

        return $return;
    }

    /**
     * Set Platform Connection Origin
     *
     * @param ConnectionInterface $conn Connection
     *
     * @return $this
     */
    public function setConnection(ConnectionInterface $conn)
    {
        $this->connection = $conn;

        return $this;
    }
}
