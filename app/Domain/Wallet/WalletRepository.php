<?php

namespace App\Domain\Wallet;

use App\Domain\User\User;

interface WalletRepository
{
    public function save(User $owner, float $amount): void;
}
