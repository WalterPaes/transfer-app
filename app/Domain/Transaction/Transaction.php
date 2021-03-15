<?php

namespace App\Domain\Transaction;

use App\Domain\Amount;
use App\Domain\User\User;

/**
 * Class Transaction
 * @package App\Domain\Transaction
 */
class Transaction
{
    /**
     * @var Amount
     */
    protected Amount $value;
    /**
     * @var User
     */
    protected User $payer;
    /**
     * @var User
     */
    protected User $payee;

    /**
     * Transaction constructor.
     * @param Amount $value
     * @param User $payee
     * @param User $payer
     */
    public function __construct(Amount $value, User $payee, User $payer)
    {
        $this->value = $value;
        $this->payer = $payer;
        $this->payee = $payee;
    }

    public function transfer()
    {
        $this->payer
            ->wallet()
            ->withdraw($this->value->amount());
        $this->payee
            ->wallet()
            ->deposit($this->value->amount());
    }

    /**
     * @return float
     */
    public function value(): float
    {
        return $this->value->amount();
    }

    /**
     * @return User
     */
    public function payer(): User
    {
        return $this->payer;
    }

    /**
     * @return User
     */
    public function payee(): User
    {
        return $this->payee;
    }
}
