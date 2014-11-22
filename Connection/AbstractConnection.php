<?php
namespace Poirot\Database\Connection;

use Poirot\Collection\Entity;

abstract class AbstractConnection implements
    ConnectionInterface
{
    /**
     * @var Entity
     */
    protected $config;

    /**
     * Construct
     *
     * @param Entity $config Connection Configuration
     */
    final function __construct(Entity $config)
    {
        $this->setConfig($config);
    }

    /**
     * Get Default Config Entity
     *
     * @return Entity
     */
    static function getDefaultConfig()
    {
        return new Entity(array(
            /*
             * It is bound to the use of Unix domain sockets.
             * It is not possible to open a TCP/IP connection using
             * the hostname localhost you must use 127.0.0.1 instead.
             *
             * mysqli.default_host=192.168.2.27
               mysqli.default_user=root
               mysqli.default_pw=""
               mysqli.default_port=3306
               mysqli.default_socket=/tmp/mysql.sock
             */
            'host'             => 'localhost',
            'username'         => 'root',
            'password'         => '',
            'db'               => 'information_schema',
            // connection driver, connection resource, ...
            'driver_options' => null,
        ));
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
}
 