<?php
namespace Poirot\Database\Statement;

interface StatementEngineInterface
{
    /**
     * Get Driver Query From Statement
     *
     * @param StatementInterface $statement Statement
     *
     * @return mixed Usually String
     */
    public function prepareStatement($statement);
} 