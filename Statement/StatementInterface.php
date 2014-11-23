<?php
namespace Poirot\Database\Statement;

use Zend\Db\Sql\ExpressionInterface;

interface StatementInterface extends StatementEngineInterface
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
     * @return mixed
     */
    function setEngine(StatementEngineInterface $ste);
}
