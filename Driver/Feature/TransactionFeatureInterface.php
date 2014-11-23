<?php
namespace Poirot\Database\Driver\Feature;

interface TransactionFeatureInterface
{
    /**
     * Begin Transaction
     *
     * @return $this
     */
    function transStart();

    /**
     * Transaction Commit
     *
     * @return $this
     */
    function transCommit();

    /**
     * Rollback Transaction
     *
     * @return $this
     */
    function transRollback();
}
