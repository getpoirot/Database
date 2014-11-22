<?php
namespace Poirot\Database\Platform;

interface LastValueProviderInterface
{
    /**
     * Get Last Generated Value (Insert ID)
     *
     * @return mixed
     */
    public function getLastGeneratedValue();
}
