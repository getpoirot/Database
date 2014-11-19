<?php
namespace Poirot\Database\Connection;

interface TransactionFeatureInterface
{
    /**
     * Begin Transaction
     *
     * @return $this
     */
    public function transaction();

    /**
     * Transaction Commit
     *
     * @return $this
     */
    public function transCommit();

    /**
     * Rollback Transaction
     *
     * @return $this
     */
    public function transRollback();
}
