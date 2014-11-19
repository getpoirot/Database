<?php
namespace Poirot\Database\Connection;

use Poirot\Collection\Entity;

interface ConnectionInterface
{
    /**
     * Initialize Resource Connection
     * - before get connect, initialize the engine
     *   with options
     *
     * @return $this
     */
    public function initialize();

    /**
     * Connect
     * - set options if conveyor passed as argument
     *
     * @param null|Entity\ConveyorInputInterface $options Options
     *
     * @throws \Exception
     * @return $this
     */
    public function connect(Entity\ConveyorInputInterface $options = null);

    /**
     * Close Connection
     *
     * @return $this
     */
    public function close();

    /**
     * Is Connected
     *
     * @return boolean
     */
    public function isConnected();

    /**
     * Get Options
     * - set options if conveyor passed as argument
     *
     * @param null|Entity\ConveyorInputInterface $options Options
     *
     * @return Entity
     */
    public function option(Entity\ConveyorInputInterface $options = null);

    /**
     * Get UnInitialized Resource Engine
     *
     * @return mixed
     */
    public function getEngine();
}
