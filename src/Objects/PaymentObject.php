<?php

namespace IEXBase\RippleAPI\Objects;

class PaymentObject extends AbstractObject
{
    protected static $objectMap = [
        'destination_balance_changes' => '\IEXBase\RippleAPI\Objects\BalanceObject',
        'source_balance_changes' => '\IEXBase\RippleAPI\Objects\BalanceObject'
    ];

    /**
     * The amount of the recipient’s currency that the transaction was instructed to send.
     * In case of partial payments, this is the "maximum" amount.
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->getField('amount');
    }

    /**
     * The amount of the destination currency actually received by the target account.
     *
     * @return string
     */
    public function getDeliveredAmount()
    {
        return $this->getField('delivered_amount');
    }

    /**
     * An array of balance change objects indicating all changes,
     * made on the balances of the final account.
     *
     * @return BalanceObject
     */
    public function getDestinationBalanceChanges()
    {
        return $this->getField('destination_balance_changes');
    }

    /**
     * An array of balance change objects indicating all changes to the balances of the source account
     * (excluding transaction cost XRP).
     *
     * @return BalanceObject
     */
    public function getSourceBalanceChanges()
    {
        return $this->getField('source_balance_changes');
    }

    /**
     * The amount of XRP spent by the original account on the transaction cost.
     *
     * @return string
     */
    public function getTransactionCost()
    {
        return $this->getField('transaction_cost');
    }

    /**
     * (Optional) Destination tag specified in this payment.
     *
     * @return string
     */
    public function getDestinationTag()
    {
        return $this->getField('destination_tag');
    }

    /**
     * (Optional) The source tag specified in this payment.
     *
     * @return string
     */
    public function getSourceTag()
    {
        return $this->getField('source_tag');
    }

    /**
     * Currency received by the recipient.
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->getField('currency');
    }

    /**
     * The account that received the payment.
     *
     * @return string
     */
    public function getDestination()
    {
        return $this->getField('destination');
    }

    /**
     * The time when the accountant who included this payment was closed.
     *
     * @return string
     */
    public function getExecutedTime()
    {
        return $this->getField('executed_time');
    }

    /**
     * The sequence number of the register that included this payment.
     *
     * @return integer
     */
    public function getLedgerIndex()
    {
        return $this->getField('ledger_index');
    }

    /**
     * The account that sent the payment.
     *
     * @return string
     */
    public function getSource()
    {
        return $this->getField('source');
    }

    /**
     * The currency that the original account spent.
     *
     * @return string
     */
    public function getSourceCurrency()
    {
        return $this->getField('source_currency');
    }

    /**
     * The identification hash of the transaction that caused the payment.
     *
     * @return string
     */
    public function getTxHash()
    {
        return $this->getField('tx_hash');
    }
}
