<?php
namespace Poirot\Database\Statement;

use Zend\Db\Sql\ExpressionInterface;

interface StatementInterface
{
    /**
     * Get Supported Platforms Name
     *
     * @return array
     */
    function getSupportedPlatform();

    /**
     * Prepare new Statement
     *
     * @param mixed $stm Statement
     *
     * @return $this
     */
    function setStatement($stm);

    /**
     * @param $stm
     * @return mixed
     */
    function prepare($stm);

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
     * Get Statement as String
     *
     * @return string
     */
    function toString();
}
