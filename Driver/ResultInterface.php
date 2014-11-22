<?php
namespace Poirot\Database\Driver;

use Countable;
use Iterator;

interface ResultInterface extends Countable, Iterator
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
}
