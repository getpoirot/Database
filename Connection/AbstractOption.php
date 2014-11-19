<?php
namespace Poirot\Database\Connection;

use Poirot\Collection\Entity;
use Poirot\Collection\Entity\ConveyorInputInterface;

class AbstractOption implements ConveyorInputInterface
{
    /**
     * @var array Default Properties
     */
    protected $properties = [
        'host'             => null,
        'port'             => null,
        'username'         => null,
        'password'         => null,
        // connection driver, connection resource, ...
        'resource_options' => null,
    ];

    /**
     * Set Properties with type used by conveyor
     * : it can be array or any kind of data
     *   related to conveyor strategy
     *
     * @param mixed $properties Properties
     *
     * @throws \Exception
     * @return $this
     */
    public function setProperties($properties)
    {
        if (!is_array($properties))
            throw new \Exception('Properties must be an array');

        $this->properties = $properties;

        return $this;
    }

    /**
     * Fill Conveyor Props. With Entity Object
     *
     * @param Entity $entity Entity
     *
     * @return $this
     */
    public function from(Entity $entity)
    {
        $props = [];
        foreach($entity->keys() as $key)
            $props[$key] = $entity->get($key);

        $this->setProperties($props);

        return $this;
    }

    /**
     * Set Properties From Conveyor To Entity
     *
     * @param Entity $entity Entity Object
     *
     * @return $this
     */
    public function into(Entity $entity)
    {
        foreach($this->properties as $key => $val) {
            $entity->set($key, $val);
        }

        return $this;
    }

    /**
     * Output Conveyor Properties
     *
     * @return array
     */
    public function borrow()
    {
        return $this->properties;
    }
}
