<?php
namespace Poirot\Database\Platform;

use Poirot\Database\Driver\Result\ResultInterface;

interface PlatformInterface
{
    /**
     * @return mixed
     */
    public function getSupportedPlatform();

    /**
     * Attain To Abstract Result From Specific Engine Result
     *
     * @param mixed $result Connection Engine(resource) Result
     *
     * @return ResultInterface
     */
    public function attainAbstractResult($result);

    /**
     * Get Query Statement
     *
     * @param mixed $statement Statement
     * @return mixed
     */
    public function attainQueryFromStatement($statement);
}

