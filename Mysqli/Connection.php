<?php
namespace Poirot\Database\Mysqli;

use Poirot\Collection\Entity;
use Poirot\Database\Connection\AbstractConnection;
use Poirot\Database\Connection\Exception\ConnectionException;

class Connection extends AbstractConnection
{
    /**
     * @var \mysqli
     */
    protected $mysqli;

    /**
     * @var \mysqli Initialized Config
     */
    protected $conn;

    /**
     * Get Options Initialized Connection Resource
     * - Initialize resource with Options
     * - connect
     *
     * @param null|Entity $config Connection Configs
     *
     * @throws \Exception On Unsuccessful Connection
     * @return \mysqli
     */
    function getConnection(Entity $config = null)
    {
        $conn = $this->getOrigin();

        // localize
        $p = ($config) ?: $this->getConfig();

        // given a list of key names, test for existence in $p
        $findParameterValue = function (array $names) use ($p) {
            foreach ($names as $name) {
                if ($p->has($name)) {
                    return $p->get($name);
                }
            }

            return null;
        };

        $hostname = $findParameterValue(array('hostname', 'host'));
        $username = $findParameterValue(array('username', 'user'));
        $password = $findParameterValue(array('password', 'passwd', 'pw'));
        $database = $findParameterValue(array('database', 'dbname', 'db', 'schema'));
        $port     = $p->has('port') ? (int) $p->get('port') : null;
        $socket   = $p->has('socket') ? $p->get('socket') : null;

        if ($p->has('driver_options') && is_array($p->get('driver_options'))) {
            foreach ($p->get('driver_options') as $option => $value) {
                if (!is_string($option)) {
                    continue;
                }

                $option = strtoupper($option);
                if (!defined($option)) {
                    continue;
                }
                $option = constant($option);

                $conn->options($option, $value);
            }
        }

        if (!$this->isConnected()) {
            $this->conn = $conn;
            $this->conn->real_connect($hostname, $username, $password, $database, $port, $socket);

            if ($error = $this->hasError())
                throw $error;

            if ($p->has('charset'))
                $this->conn->set_charset($p->get('charset'));
        }

        return $this->conn;
    }

    /**
     * Get Last Error From Connection
     *
     * @return false|ConnectionException|\Exception
     */
    function hasError()
    {
        $exception = false;

        $conn = $this->getConnection();
        if ($conn->connect_errno)
            $exception = new ConnectionException($conn->connect_error, $conn->connect_errno);
        elseif ($conn->errno)
            $exception = new \Exception($conn->connect_error, $conn->connect_errno);

        return $exception;
    }

    /**
     * Close Connection
     *
     */
    function close()
    {
        if ($this->mysqli instanceof \mysqli) {
            $this->mysqli->close();
        }

        unset($this->mysqli);
    }

    /**
     * Is Connected
     *
     * @return boolean
     */
    function isConnected()
    {
        return ($this->conn instanceof \mysqli);
    }

    /**
     * Get UnInitialized Resource Engine
     *
     * @return mixed
     */
    function getOrigin()
    {
        if (!$this->mysqli instanceof \mysqli) {
            $this->mysqli = new \mysqli();
            $this->mysqli->init();
        }

        return $this->mysqli;
    }
}
 