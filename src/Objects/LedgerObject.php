<?php

namespace IEXBase\RippleAPI\Objects;


class LedgerObject extends AbstractObject
{
    /**
     * A unique hash, unique to this book, like a hexadecimal string.
     *
     * @return string
     */
    public function getLedgerHash()
    {
        return $this->getField('ledger_hash');
    }

    /**
     * Register Sequence Number.
     *
     * @return integer
     */
    public function getLedgerIndex()
    {
        return $this->getField('ledger_index');
    }

    /**
     * The identification hash of the previous book.
     *
     * @return string
     */
    public function getParentHash()
    {
        return $this->getField('parent_hash');
    }

    /**
     * The total number of "drops" XRP still exists during the book. (Each XRP is 1,000,000 drops.)
     *
     * @return string
     */
    public function getTotalCoins()
    {
        return $this->getField('total_coins');
    }

    /**
     * The closing time of the book is rounded up to this many seconds.
     *
     * @return integer
     */
    public function getCloseTimeRes()
    {
        return $this->getField('close_time_res');
    }

    /**
     * A hash of the account information contained in this book.
     *
     * @return string
     */
    public function getAccountsHash()
    {
        return $this->getField('accounts_hash');
    }

    /**
     * A hash of the transaction information contained in this book.
     *
     * @return string
     */
    public function getTransactionsHash()
    {
        return $this->getField('transactions_hash');
    }

    /**
     * When this book was closed during UNIX.
     *
     * @return integer
     */
    public function getCloseTime()
    {
        return $this->getField('close_time');
    }

    /**
     * When this book was closed.
     *
     * @return string
     */
    public function getCloseTimeHuman()
    {
        return $this->getField('close_time_human');
    }
}
