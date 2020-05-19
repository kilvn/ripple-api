<?php

namespace IEXBase\RippleAPI\Transaction;

use IEXBase\RippleAPI\Contracts\TransactionBuilderContract;
use IEXBase\RippleAPI\Support\Arr;

class TransactionBuilder implements TransactionBuilderContract
{
    /**
     * Transaction check
     *
     * @var boolean
     */
    protected bool $offline = false;

    /**
     * The secret key
     *
     * @var string
     */
    protected ?string $secret = null;

    /**
     * Transaction type
     *
     * @var string
     */
    protected ?string $TransactionType = null;

    /**
     * Sender Wallet Address
     *
     * @var string
     */
    protected ?string $Account = null;

    /**
     * Shipment Amount
     *
     * @var integer
     */
    protected int $Amount = 0;

    /**
     * Recipient's address
     *
     * @var string
     */
    protected ?string $Destination = null;

    /**
     * Label (DestinationTag)
     *
     * @var string
     */
    protected ?string $DestinationTag = null;

    /**
     * If true, do not try to automatically populate or check values ​​when building a transaction.
     *
     * @return bool
     */
    public function isOffline(): bool
    {
        return $this->offline;
    }

    /**
     * Set a new value
     *
     * @param bool $offline
     * @return TransactionBuilder
     */
    public function setOffline(bool $offline)
    {
        $this->offline = $offline;
        return $this;
    }

    /**
     * Get private key
     *
     * @return null
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * Specify a new private key
     *
     * @param null $secret
     * @return TransactionBuilder
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
        return $this;
    }

    /**
     * Get Transaction Type
     *
     * @return string
     */
    public function getTransactionType()
    {
        return $this->TransactionType;
    }

    /**
     * Specify Transaction Type
     *
     * @param mixed $TransactionType
     * @return TransactionBuilder
     */
    public function setTransactionType($TransactionType)
    {
        $this->TransactionType = $TransactionType;
        return $this;
    }

    /**
     * Get sender address
     *
     * @return string
     */
    public function getAccount()
    {
        return $this->Account;
    }

    /**
     * Enter a new sender address
     * @param mixed $Account
     *
     * @return TransactionBuilder
     */
    public function setAccount($Account)
    {
        $this->Account = $Account;
        return $this;
    }

    /**
     * Get the amount
     *
     * @return integer
     */
    public function getAmount(): int
    {
        return $this->Amount * 1e6;
    }

    /**
     * Specify a new amount to send
     *
     * @param mixed $Amount
     * @return TransactionBuilder
     */
    public function setAmount($Amount)
    {
        $this->Amount = $Amount;
        return $this;
    }

    /**
     * Get recipient address
     *
     * @return string
     */
    public function getDestination()
    {
        return $this->Destination;
    }

    /**
     * Enter a new recipient address
     *
     * @param mixed $Destination
     * @return TransactionBuilder
     */
    public function setDestination($Destination)
    {
        $this->Destination = $Destination;
        return $this;
    }

    /**
     * Get DestinationTag
     *
     * @return string|int
     */
    public function getDestinationTag()
    {
        return $this->DestinationTag;
    }

    /**
     * Specify a new DestinationTag
     *
     * @param mixed $DestinationTag
     * @return TransactionBuilder
     */
    public function setDestinationTag($DestinationTag)
    {
        $this->DestinationTag = $DestinationTag;
        return $this;
    }

    /**
     * Sign the message
     *
     * @return array
     */
    public function sign()
    {
        $array = [];
        if ($this->getDestinationTag() != null) {
            Arr::set($array, 'tx_json.DestinationTag', $this->getDestinationTag());
        }

        if ($this->getDestination() != null) {
            Arr::set($array, 'tx_json.Destination', $this->getDestination());
        }

        if ($this->getAmount() != null) {
            Arr::set($array, 'tx_json.Amount', $this->getAmount());
        }

        if ($this->getAccount() != null) {
            Arr::set($array, 'tx_json.Account', $this->getAccount());
        }

        if ($this->getTransactionType() != null) {
            Arr::set($array, 'tx_json.TransactionType', $this->getTransactionType());
        }

        return array_merge([
            'offline' => $this->isOffline(),
            'secret' => $this->getSecret()
        ], $array);
    }
}
