<?php
namespace Poirot\Database\Statement;

use Zend\Db\Sql\ExpressionInterface;

interface StatementInterface
{
    /**
     * Bind Expression To Statement
     *
     * @param ExpressionInterface $expr        Expression
     * @param null|string         $placeholder Placeholder name
     *
     * @return $this
     */
    function bind(ExpressionInterface $expr, $placeholder = null);

    /**
     * Prepare new Statement
     *
     * @param string $stm Statement
     *
     * @return StatementInterface
     */
    function prepare($stm);

    /**
     * Get Statement as String
     *
     * @return string
     */
    function toString();
}
