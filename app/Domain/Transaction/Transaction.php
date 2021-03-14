<?php

namespace App\Domain\Transaction;

use App\Domain\User\User;

class Transaction
{
    protected float $value;
    protected User $payer;
    protected User $payee;

    public function __construct(float $value, User $payee, User $payer)
    {
        $this->value = $value;
        $this->payer = $payer;
        $this->payee = $payee;
    }
}