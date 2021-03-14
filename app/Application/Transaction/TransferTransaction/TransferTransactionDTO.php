<?php

namespace App\Application\TransferTransaction;

class TransferTransactionDTO
{
    public float $value;
    public int $payer;
    public int $payee;

    /**
     * TransferTransactionDTO constructor.
     * @param float $value
     * @param int $payer
     * @param int $payee
     */
    public function __construct(float $value, int $payer, int $payee)
    {
        $this->value = $value;
        $this->payer = $payer;
        $this->payee = $payee;
    }


}
