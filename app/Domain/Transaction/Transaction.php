<?php

namespace App\Domain\Transaction;

use App\Domain\User\User;

/**
 * Class Transaction
 * @package App\Domain\Transaction
 */
class Transaction
{
    /**
     * @var float
     */
    protected float $value;
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
     * @param float $value
     * @param User $payee
     * @param User $payer
     */
    public function __construct(float $value, User $payee, User $payer)
    {
        $this->value = $value;
        $this->payer = $payer;
        $this->payee = $payee;
    }

    /**
     * @return float
     */
    public function value(): float
    {
        return $this->value;
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
