<?php

namespace IEXBase\RippleAPI\Objects;

class BalanceObject extends AbstractObject
{
    /**
     * Counterparty or issuer of currency. In the case of XRP, this is an empty string.
     *
     * @return string
     */
    public function getCounterParty()
    {
        return $this->getField('counterparty');
    }

    /**
     * The currency for which this balance has changed.
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->getField('currency');
    }

    /**
     * The amount of currency that the linked account received or lost.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->getField('value');
    }
}
