<?php

namespace IEXBase\RippleAPI\Objects;

class SignObject extends AbstractObject
{
    /**
     * Signature Status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->getField('status');
    }

    /**
     * Binary representation of a fully qualified signed transaction
     *
     * @return string
     */
    public function getTxBlob()
    {
        return $this->getField('tx_blob');
    }

    /**
     * The jSON specification of the complete transaction, signed, including any fields,
     * which were automatically filled
     *
     * @return TransactionCommonObject
     */
    public function getTxJson()
    {
        return $this->getField('tx_json');
    }
}
