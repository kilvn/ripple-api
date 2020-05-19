<?php

namespace IEXBase\RippleAPI\Objects;

class TransactionObject extends AbstractObject
{
    /**
     * A hash value that is unique to this transaction.
     *
     * @return string
     */
    public function getHash()
    {
        return $this->getField('hash');
    }

    /**
     * The time when this transaction was included in the verified book.
     *
     * @return string
     */
    public function getDate()
    {
        return $this->getField('date');
    }

    /**
     * The sequence number of the register this book is included in.
     *
     * @return integer
     */
    public function getLedgerIndex()
    {
        return $this->getField('ledger_index');
    }

    /**
     * The fields of this transaction object are defined in the transaction format.
     *
     * @return object
     */
    public function getTx()
    {
        return $this->getField('tx');
    }

    /**
     * Metadata about the results of this transaction.
     *
     * @return object
     */
    public function getMeta()
    {
        return $this->getField('meta');
    }
}
