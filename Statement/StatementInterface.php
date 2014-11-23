<?php
namespace Poirot\Database\Statement;

use Zend\Db\Sql\ExpressionInterface;

/**
 * Interface StatementInterface
 * @package Poirot\Database\Statement
 *
 * Statements are methods that get Expr
 * each Expr can nest with AND | OR
 *
 * Methods:
 * - Call    to invoke procedural from server
 * - Select  ...
 */
interface StatementInterface extends StatementEngineInterface
{
    /**
     * Get Supported Platforms Name
     *
     * @return array
     */
    function getSupportedPlatform();

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
     * Set Statement Engine
     *
     * ! used by prepareStatement
     *   by calling prepareStatement from engine
     *
     * @param StatementEngineInterface $ste
     *
     * @return $this
     */
    function setEngine(StatementEngineInterface $ste);
}
