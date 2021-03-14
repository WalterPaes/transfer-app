<?php

namespace App\Application\TransferTransaction;

/**
 * Class TransferTransactionDTO
 * @package App\Application\TransferTransaction
 */
class TransferTransactionDTO
{
    /**
     * @var float|mixed
     */
    public float $value;
    /**
     * @var int|mixed
     */
    public int $payer;
    /**
     * @var int|mixed
     */
    public int $payee;

    /**
     * TransferTransactionDTO constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->value = $data['value'];
        $this->payer = $data['payer'];
        $this->payee = $data['payee'];
    }
}
