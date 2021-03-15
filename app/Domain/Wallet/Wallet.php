<?php

namespace App\Domain\Wallet;

use App\Domain\User\User;

class Wallet
{
    private User $owner;
    private float $balance;

    public function __construct(float $balance = 0)
    {
        $this->balance = $balance;
    }

    public function balance(): float
    {
        return $this->balance;
    }

    public function deposit()
    {
    }

    public function withdraw()
    {
    }
}
