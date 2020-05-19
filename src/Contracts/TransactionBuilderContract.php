<?php

namespace IEXBase\RippleAPI\Contracts;

interface TransactionBuilderContract
{
    /**
     * Get Transaction Type
     *
     * @return string
     */
    public function getTransactionType();

    /**
     * Specify Transaction Type
     *
     * @param mixed $TransactionType
     * @return TransactionBuilderContract
     */
    public function setTransactionType($TransactionType);

    /**
     * Get sender address
     *
     * @return string
     */
    public function getAccount();

    /**
     * Enter a new sender address
     * @param mixed $Account
     *
     * @return TransactionBuilderContract
     */
    public function setAccount($Account);

    /**
     * Get the amount
     *
     * @return integer
     */
    public function getAmount(): int;

    /**
     * Specify a new amount to send
     *
     * @param mixed $Amount
     * @return TransactionBuilderContract
     */
    public function setAmount($Amount);

    /**
     * Get recipient address
     *
     * @return string
     */
    public function getDestination();

    /**
     * Enter a new recipient address
     *
     * @param mixed $Destination
     * @return TransactionBuilderContract
     */
    public function setDestination($Destination);

    /**
     * Get DestinationTag
     *
     * @return mixed
     */
    public function getDestinationTag();

    /**
     * Specify a new DestinationTag
     *
     * @param mixed $DestinationTag
     * @return TransactionBuilderContract
     */
    public function setDestinationTag($DestinationTag);

    /**
     * Sign the message
     *
     * @return array
     */
    public function sign();
}
