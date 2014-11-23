<?php
namespace Poirot\Database\Mysqli;

class ResultAggregate implements \Iterator
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
     * Construct
     *
     * @param \mysqli_result $resultOrigin
     */
    public function __construct(\mysqli_result $resultOrigin)
    {
        $this->resultOrigin = $resultOrigin;
    }

    /**
     * Get Original Connection Query Result
     * From Connection Origin Engine
     *
     * @return \mysqli_result
     */
    public function getOrigin()
    {
        return $this->resultOrigin;
    }

    /**
     * Is Buffered Mysqli Result?
     *
     * Unbuffered
     * If client memory is a short resource and freeing server resources
     * as early as possible to keep server load low is not needed,
     * unbuffered results can be used.
     * Scrolling through unbuffered results is not possible
     * before all rows have been read.
     *
     * @return bool
     */
    public function isBuffered()
    {
        ($this->isBuffered !== null) ?:
            $this->isBuffered =
            !(
                $this->getOrigin()->field_count > 0
                && $this->getOrigin()->num_rows == 0
            );

        return $this->isBuffered;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        $this->getOrigin()->data_seek($this->position);
        if ($this->currData)
            $return = $this->currData;
        else
            $return = $this->getCurrentData();

        $this->currData = null;

        return $return;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        if (!$this->isBuffered())
            $return = $this->getCurrentData();
        else
            $return = $this->position < $this->resultOrigin->num_rows;

        return $return;
    }

    /**
     * Get Current Data
     *
     * - it's implemented for Unbuffered results,
     *   so we don't have num_rows exactly
     *   and check valid() with getting data
     *
     * @return array
     */
    protected function getCurrentData()
    {
        $this->currData = $this->getOrigin()->fetch_assoc();

        return $this->currData;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        $this->position++;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->position = 0;
        $this->getOrigin()->data_seek($this->position);
    }
}
