<?php
namespace Poirot\Database\Driver\Result;

interface ResultInterface extends
    \IteratorAggregate, // Result Is Irritable if Count > 0
    \Countable
{
    /**
     * Set Query Result Origin
     *
     * @param mixed $resultOrigin Query Result Connection Origin
     *
     * @return $this
     */
    public function setOrigin($resultOrigin);

    /**
     * Get Original Connection Query Result
     * From Connection Origin Engine
     *
     * @return mixed
     */
    public function getOrigin();

    /**
     * Is Result Consuming Fault
     *
     * @return boolean
     */
    public function isFault();
}
