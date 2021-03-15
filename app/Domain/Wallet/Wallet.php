<?php

namespace App\Domain\Wallet;

use App\Domain\Amount;

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
    public function __construct(float $balance = 0)
    {
        $this->balance = new Amount($balance);
    }

    public function balance(): float
    {
        return $this->balance->amount();
    }

    public function deposit()
    {
    }

    public function withdraw()
    {
    }
}
