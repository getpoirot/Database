<?php
namespace Poirot\Database\Statement;

interface StatementExecutableInterface
{
    /**
     * Get Executable Query From Statement
     * @link http://php.net/manual/en/mysqli.quickstart.prepared-statements.php
     *
     * @param StatementInterface $statement Statement
     *
     * @return mixed
     */
    public function prepareExecutableStatement($statement);
}
