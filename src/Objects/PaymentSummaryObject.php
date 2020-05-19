<?php

namespace IEXBase\RippleAPI\Objects;

class PaymentSummaryObject extends AbstractObject
{
    /**
     * The identification hash of the transaction that caused the payment.
     *
     * @return string
     */
    public function getTxHash()
    {
        return $this->getField('tx_hash');
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
     * Currency delivered to the transaction recipient.
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->getField('currency');
    }

    /**
     * Currency issuing gateway or blank line for XRP.
     *
     * @return string
     */
    public function getIssuer()
    {
        return $this->getField('issuer');
    }

    /**
     * Either sent or received, indicating whether the prospect is an account
     * sender or receiver of this transaction.
     *
     * @return string
     */
    public function getType()
    {
        return $this->getField('type');
    }
}
