<?php
namespace Poirot\Database\Connection;

use Poirot\Collection\Entity;

/**
 * Interface ConnectionInterface
 * @package Poirot\Database\Connection
 */
interface ConnectionInterface
{
    /**
     * Set Configuration Options
     *
     * @param Entity $config Config
     *
     * @return $this
     */
    function setConfig(Entity $config);

    /**
     * Get Configuration Options
     *
     * @return Entity
     */
    function getConfig();

    /**
     * Get Options Initialized Connection Resource
     * - Initialize resource with Options
     * - connect
     *
     * @param null|Entity $config Connection Configs
     *
     * @return mixed
     */
    function getConnection(Entity $config = null);

    /**
     * Close Connection
     *
     */
    function close();

    /**
     * Is Connected
     *
     * @return boolean
     */
    function isConnected();

    /**
     * Get UnInitialized Resource Engine
     *
     * @return mixed
     */
    function getOrigin();
}
