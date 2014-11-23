<?php
namespace Poirot\Database\Mysqli;

use Poirot\Database\Connection\ConnectionInterface;
use Poirot\Database\Platform\PlatformInterface;

class Platform implements PlatformInterface
{
    /**
     * Attain To Abstract Result From Specific Engine Result
     *
     * @param mixed $result Connection Engine(resource) Result
     *
     * @return Result
     */
    public function attainAbstractResult($result)
    {
        $return = new Result();
        $return->setOrigin($result);

        return $return;
    }

    /**
     * Set Platform Connection
     *
     * @param ConnectionInterface $conn Connection
     *
     * @return $this
     */
    public function setConnection(ConnectionInterface $conn)
    {
        // TODO: Implement setConnection() method.
    }

    /**
     * Get Connection Info
     *
     * @return mixed
     */
    function getInfo()
    {
        // TODO: Implement getInfo() method.
    }
}
 