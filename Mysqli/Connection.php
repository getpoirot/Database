<?php
namespace Poirot\Database\Mysqli;

use Poirot\Collection\Entity;
use Poirot\Database\Connection\ConnectionInterface;

class Connection implements ConnectionInterface
{
    /**
     * @var Entity
     */
    protected $config;

    /**
     * @var \mysqli
     */
    protected $engine;

    /**
     * @var \mysqli Initialized Config
     */
    protected $conn;

    /**
     * Construct
     *
     * @param Entity $config Connection Configuration
     */
    function __construct(Entity $config)
    {
        $this->setConfig($config);
    }

    /**
     * Set Configuration Options
     *
     * @param Entity $config Config
     *
     * @return $this
     */
    function setConfig(Entity $config)
    {
        $this->config = $config;
    }

    /**
     * Get Configuration Options
     *
     * @return Entity
     */
    function getConfig()
    {
        return $this->config;
    }

    /**
     * Get Options Initialized Connection Resource
     * - Initialize resource with Options
     * - connect
     *
     * @param null|Entity $config Connection Configs
     *
     * @return mixed
     */
    function getConnection(Entity $config = null)
    {
        $this->conn = $this->getEngine();

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

                $this->conn->options($option, $value);
            }
        }

        $this->conn->real_connect($hostname, $username, $password, $database, $port, $socket);

        if ($this->conn->connect_error) {
            throw new \RuntimeException(
                'Connection error',
                null,
                new \ErrorException($this->conn->connect_error, $this->conn->connect_errno)
            );
        }

        if ($p->has('charset')) {
            $this->conn->set_charset($p->get('charset'));
        }

        return $this->conn;
    }

    /**
     * Close Connection
     *
     */
    function close()
    {
        if ($this->engine instanceof \mysqli) {
            $this->engine->close();
        }

        unset($this->engine);
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
    function getEngine()
    {
        if (!$this->engine instanceof \mysqli) {
            $this->engine = new \mysqli();
            $this->engine->init();
        }

        return $this->engine;
    }
}
 