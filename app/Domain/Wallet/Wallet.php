<?php

namespace App\Domain\Wallet;

use App\Domain\Amount;
use App\Domain\InvalidAmountException;
use App\Domain\Wallet\Exceptions\InsufficientFundsException;

/**
 * Class Wallet
 * @package App\Domain\Wallet
 */
class Wallet
{
    /**
     * @var Amount
     */
    private Amount $balance;

    /**
     * Wallet constructor.
     * @param float $balance
     */
    public function __construct(float $balance = 0.0)
    {
        $this->balance = new Amount($balance);
    }

    /**
     * @return float
     */
    public function balance(): float
    {
        return $this->balance->amount();
    }

    /**
     * @param float $value
     */
    public function deposit(float $value)
    {
        if ($value <= 0) {
            throw new InvalidAmountException($value);
        }

        $newAmount = $this->balance->amount() + $value;
        $this->balance = new Amount($newAmount);
    }

    /**
     * @param float $value
     */
    public function withdraw(float $value)
    {
        if ($value <= 0) {
            throw new InvalidAmountException($value);
        }

        if ($this->balance->amount() < $value) {
            throw new InsufficientFundsException;
        }

        $newAmount = $this->balance->amount() - $value;
        $this->balance = new Amount($newAmount);
    }
}
