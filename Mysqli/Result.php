<?php
namespace Poirot\Database\Mysqli;

use Poirot\Database\Driver\Result\ResultInterface;
use Traversable;

class Result implements
    ResultInterface
{
    /**
     * @var \mysqli_result
     */
    protected $resultOrigin;

    /**
     * @var int Iteration Position
     */
    protected $position = 0;

    /**
     * @var boolean Set From First Call To isBuffer()
     */
    protected $isBuffered = null;

    /**
     * @var array Using within getCurrentData()
     */
    protected $currData;

    /**
     * Set Query Result Origin
     *
     * @param \mysqli_result|\Exception $resultOrigin Query Result Connection Origin
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setOrigin($resultOrigin)
    {
        if (! $resultOrigin instanceof \mysqli_result
        && ! $resultOrigin instanceof \Exception
        )
            throw new \InvalidArgumentException(
                sprintf(
                    'Result Only Support "mysqli_result" or "Exception" as origin, but "%s" given.'
                    , is_object($resultOrigin) ? get_class($resultOrigin) : gettype($resultOrigin)
                )
            );

        $this->resultOrigin = $resultOrigin;

        return $this;
    }

    /**
     * Get Original Connection Query Result
     * From Connection Origin Engine
     *
     * @return \mysqli_result|\Exception
     */
    public function getOrigin()
    {
        return $this->resultOrigin;
    }

    /**
     * Is Result Consuming Fault
     *
     * @return boolean
     */
    public function isFault()
    {
        return $this->getOrigin() instanceof \Exception;
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     */
    public function count()
    {
        $count = 0;
        if (!$this->isFault())
            $count = $this->getOrigin()->num_rows;

        return $count;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @throws \Exception
     * @throws \mysqli_result
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     */
    public function getIterator()
    {
        if ($this->isFault())
            throw $this->getOrigin();

        return new ResultAggregate($this->getOrigin());
    }
}
