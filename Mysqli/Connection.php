<?php
namespace Poirot\Database\Mysql;

use Poirot\Collection\Entity;
use Poirot\Database\Connection\ConnectionInterface;

class Connection implements ConnectionInterface
{
    /**
     * Connect
     *
     * @param null|Entity $config Connection Configs
     *
     * @throws \Exception
     * @return $this
     */
    function connect(Entity $config = null)
    {
        // TODO: Implement connect() method.
    }

    /**
     * Get Options Initialized Connection Resource
     * - Initialize resource with Options
     * - connect
     *
     * @return mixed
     */
    function getConn()
    {
        // TODO: Implement getConn() method.
    }

    /**
     * Close Connection
     *
     * @return $this
     */
    function close()
    {
        if ($this->resource instanceof \mysqli) {
            $this->resource->close();
        }
        unset($this->resource);
    }

    /**
     * Is Connected
     *
     * @return boolean
     */
    function isConnected()
    {
        return ($this->resource instanceof \mysqli);
    }

    /**
     * Get Configs
     *
     * @return Entity
     */
    function config()
    {
        // TODO: Implement config() method.
    }

    /**
     * Get UnInitialized Resource Engine
     *
     * @return mixed
     */
    function getEngine()
    {
        if ($this->resource instanceof \mysqli) {
            return $this;
        }

        // localize
        $p = $this->connectionParameters;

        // given a list of key names, test for existence in $p
        $findParameterValue = function (array $names) use ($p) {
            foreach ($names as $name) {
                if (isset($p[$name])) {
                    return $p[$name];
                }
            }
            return;
        };

        $hostname = $findParameterValue(array('hostname', 'host'));
        $username = $findParameterValue(array('username', 'user'));
        $password = $findParameterValue(array('password', 'passwd', 'pw'));
        $database = $findParameterValue(array('database', 'dbname', 'db', 'schema'));
        $port     = (isset($p['port'])) ? (int) $p['port'] : null;
        $socket   = (isset($p['socket'])) ? $p['socket'] : null;

        $this->resource = new \mysqli();
        $this->resource->init();

        if (!empty($p['driver_options'])) {
            foreach ($p['driver_options'] as $option => $value) {
                if (is_string($option)) {
                    $option = strtoupper($option);
                    if (!defined($option)) {
                        continue;
                    }
                    $option = constant($option);
                }
                $this->resource->options($option, $value);
            }
        }

        $this->resource->real_connect($hostname, $username, $password, $database, $port, $socket);

        if ($this->resource->connect_error) {
            throw new Exception\RuntimeException(
                'Connection error',
                null,
                new Exception\ErrorException($this->resource->connect_error, $this->resource->connect_errno)
            );
        }

        if (!empty($p['charset'])) {
            $this->resource->set_charset($p['charset']);
        }

        return $this;
    }
}
 