<?php

namespace IEXBase\RippleAPI\Objects;

class AccountObject extends AbstractObject
{
    /**
     * The account ID for this account is base-58.
     *
     * @return string
     */
    public function getAccount()
    {
        return $this->getField('account');
    }

    /**
     * UTC timestamp when the address was funded
     *
     * @return string
     */
    public function getInception()
    {
        return $this->getField('inception');
    }

    /**
     * Sequential log number when creating an account
     *
     * @return integer
     */
    public function getLedgerIndex()
    {
        return $this->getField('ledger_index');
    }

    /**
     * (Omitted for genesis accounts) Address that XRP provided for funding.
     *
     * @return string
     */
    public function getParent()
    {
        return $this->getField('parent');
    }

    /**
     * (Omitted for genesis accounts)
     * The authentication hash of the transaction that financed this account.
     *
     * @return string
     */
    public function getTxHash()
    {
        return $this->getField('tx_hash');
    }

    /**
     * Available XRP Balance
     *
     * @return string
     */
    public function getInitialBalance()
    {
        return $this->getField('initial_balance');
    }

    /**
     * (Genesis accounts only) The XRP amount for which account number 32570 is calculated.
     *
     * @return string
     */
    public function getGenesisBalance()
    {
        return $this->getField('genesis_balance');
    }

    /**
     * (Genesis accounts only)
     * The sequence number of the transaction in the account with registration book # 32570.
     *
     * @return integer
     */
    public function getGenesisIndex()
    {
        return $this->getField('genesis_index');
    }
}
