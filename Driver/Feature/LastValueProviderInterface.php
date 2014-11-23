<?php
namespace Poirot\Database\Driver\Feature;

interface LastValueProviderInterface
{
    /**
     * Get Last Generated Value (Insert ID)
     *
     * @return mixed
     */
    public function getLastGeneratedValue();
}
