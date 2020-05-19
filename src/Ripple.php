<?php

namespace IEXBase\RippleAPI;

use IEXBase\RippleAPI\Objects\AccountObject;
use IEXBase\RippleAPI\Objects\PaymentObject;
use IEXBase\RippleAPI\Objects\SignObject;
use IEXBase\RippleAPI\Objects\TransactionObject;
use IEXBase\RippleAPI\Transaction\TransactionBuilder;

class Ripple
{
    /**
     * Wallet address
     *
     * @var string
     */
    protected string $address;

    /**
     * Private wallet key
     *
     * @var string
     */
    protected ?string $secret;

    /**
     * Ripple client service
     *
     * @var RippleClient
     */
    protected RippleClient $client;

    /**
     * Get the Hash of the signed transaction
     *
     * @var string
     */
    protected string $tx_blob;

    /**
     * Create a Ripple superclass object.
     *
     * @param $address
     * @param null $secret
     * @param array $nodes
     */
    public function __construct($address, $secret = null, $nodes = [])
    {
        $this->address = $address;
        $this->secret = $secret;

        $this->client = new RippleClient($nodes);
    }

    /**
     * Receive Ping
     *
     * @return array
     */
    public function getPing(): array
    {
        return $this->call('ping', '/');
    }

    /**
     * Get detailed server information
     *
     * @return array
     */
    public function getServerInfo(): array
    {
        return $this->call('server_info', '/');
    }

    /**
     * Random number generation
     *
     * @return array
     */
    public function getRandom(): array
    {
        return $this->call('random', '/');
    }

    /**
     * Get a list of active accounts
     *
     * @param array $params
     * @return array
     */
    public function getAccounts($params = [])
    {
        return $this->call('GET', '/accounts', $params);
    }

    /**
     * Get account information
     *
     * @param null $address
     * @return AccountObject
     */
    public function getAccount($address = null): AccountObject
    {
        $address = $address ?? $this->address;
        $response = $this->call('GET', sprintf('/accounts/%s', $address));

        return new AccountObject($response['account_data']);
    }

    /**
     * Get account balance
     *
     * @param null $address
     * @param array $params
     * @return array
     */
    public function getAccountBalances($address = null, $params = []): array
    {
        $address = $address ?? $this->address;
        return $this->call('GET', sprintf('/accounts/%s/balances', $address), $params);
    }

    /**
     * Account Transaction List
     *
     * @param null $address
     * @param array $params
     * @return PaymentObject | array
     */
    public function getAccountPayments($address = null, $params = [])
    {
        $address = $address ?? $this->address;
        $response = $this->call('GET', sprintf('/accounts/%s/payments', $address), $params);

        if ($response['count'] == 1) {
            return new PaymentObject($response['payments'][0]);
        } else {
            return $response['payments'];
        }
    }

    /**
     * We receive customer orders
     *
     * @param $address
     * @param array $params
     * @return array
     */
    public function getAccountOrder($address = null, $params = [])
    {
        $address = $address ?? $this->address;
        return $this->call('GET', sprintf('/accounts/%s/orders', $address), $params);
    }

    /**
     * Get client transaction history
     *
     * @param $address
     * @param array $params
     * @return TransactionObject
     */
    public function getAccountTransactionHistory($address = null, $params = [])
    {
        $address = $address ?? $this->address;
        $response = $this->call('GET', sprintf('/accounts/%s/transactions', $address), $params);

        return new TransactionObject($response['transactions']);
    }

    /**
     * We get the transaction by account and sequence
     *
     * @param null $address
     * @param null $sequence
     * @param array $params
     * @return array
     */
    public function getTransactionAccountAndSequence($address = null, $sequence = null, $params = [])
    {
        $address = $address ?? $this->address;
        return $this->call('GET', sprintf('/accounts/%s/transactions/%s', $address, $sequence), $params);
    }

    /**
     * Get account transaction statistics
     *
     * @param null $address
     * @param array $params
     * @return array
     */
    public function getAccountTransactionStats($address = null, $params = [])
    {
        $address = $address ?? $this->address;
        return $this->call('GET', sprintf('/accounts/%s/stats/transactions', $address), $params);
    }

    /**
     * Get account statistics
     *
     * @param null $address
     * @param array $params
     * @return array
     */
    public function getAccountValueStat($address = null, $params = [])
    {
        $address = $address ?? $this->address;
        return $this->call('GET', sprintf('/accounts/%s/stats/value', $address), $params);
    }

    /**
     * Get Transaction Information
     *
     * @param null $hash
     * @param array $params
     * @return TransactionObject | array
     */
    public function getTransaction($hash = null, $params = [])
    {
        $response = $this->call('GET', '/transactions/' . $hash, $params);

        if (isset($response['count']) and $response['count'] > 1) {
            return $response['transactions'];
        }
        return new TransactionObject($response['transaction']);
    }

    /**
     * Getting the latest versions
     *
     * @return array
     */
    public function getRippledVersion()
    {
        return $this->call('GET', '/network/rippled_versions');
    }

    /**
     * Get a list of all gateways
     *
     * @return array
     */
    public function getGateways()
    {
        return $this->call('GET', '/gateways');
    }

    /**
     * Get a specific gateway
     *
     * @param $gateway
     * @return array
     */
    public function getGateway($gateway)
    {
        return $this->call('GET', '/gateways/' . $gateway);
    }

    /**
     * Health Check - API
     *
     * @param array $params
     * @return array
     */
    public function getHealthCheck($params = [])
    {
        return $this->call('GET', '/health/api', $params);
    }

    /**
     * Health Check - Book Importer
     *
     * @param array $params
     * @return array
     */
    public function getHealthImporter($params = [])
    {
        return $this->call('GET', '/health/importer', $params);
    }

    /**
     * Health Check - ETL Nodes
     *
     * @param array $params
     * @return array
     */
    public function getHealthNodesEtl($params = [])
    {
        return $this->call('GET', '/health/nodes_etl', $params);
    }

    /**
     * Health Check - ETL Checks
     *
     * @param array $params
     * @return array
     */
    public function getHealthValidationsEtl($params = [])
    {
        return $this->call('GET', '/health/validations_etl', $params);
    }

    /**
     * We get a commission
     *
     * @return array
     */
    public function getFee()
    {
        return $this->call('fee', '/');
    }

    /**
     * Check transaction
     *
     * @param $tx
     * @return array
     */
    public function verifyTransaction($tx)
    {
        return $this->call('tx', '/', [
            'transaction' => $tx
        ]);
    }

    /**
     * Get a list of all transactions
     * @param array $params
     * @return array
     */
    public function getTransactions($params = [])
    {
        return $this->call('GET', '/transactions', $params);
    }

    /**
     * Get detailed account statistics
     *
     * @param array $params
     * @return array
     */
    public function getStats($params = [])
    {
        return $this->call('GET', '/stats', $params);
    }

    /**
     * Create a new transaction
     *
     * @param \Closure $closure
     * @return Ripple
     */
    public function buildTransaction(\Closure $closure)
    {
        $payment = new TransactionBuilder();
        $payment->setSecret($this->secret);
        $payment->setAccount($this->address);

        if ($closure instanceof \Closure) {
            $response = $this->call('sign', '/', $closure->call($payment, $payment));
            if ($response['result']['status'] == 'success') {
                $this->tx_blob = (new SignObject($response['result']))->getTxBlob();
            }

            return $this;
        }

        return null;
    }

    /**
     * We send the signed transaction to the Ripple server
     *
     * @return array
     * @throws \Exception
     */
    public function submit()
    {
        $result = $this->call('submit', '/', [
            'tx_blob' => $this->tx_blob
        ]);

        if (empty($result)) {
            throw new \Exception('Signature received is invalid');
        } else {
            return $result;
        }
    }

    /**
     * We send funds using a strontium server
     *
     * @param $options
     * @return array
     * @throws \Exception
     */
    public function sendAndSubmitForServer($options)
    {
        $result = $this->client->sendRequestWss('POST', '/send-xrp', $options);

        if (empty($result)) {
            throw new \Exception('Transaction not sent');
        } else {
            return $result;
        }
    }

    /**
     * Basic function for generating queries
     *
     * @param $method
     * @param $path
     * @param array $params
     * @return array
     */
    protected function call($method, $path, $params = [])
    {
        if (in_array($method, ['GET', 'POST', 'PUT', 'DELETE'])) {
            return $this->client->sendRequest(
                $method,
                trim($path),
                $params,
                true
            );
        } else {
            return $this->client->sendRequest(
                $method,
                trim($path),
                $params,
                false
            );
        }
    }
}
