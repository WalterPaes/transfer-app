<?php

namespace App\Infrastructure\Transaction;

use App\Application\Services\Transaction\NotifyTransaction\TransactionNotifier;

class FakeNotifier implements TransactionNotifier
{
    /**
     * @return bool
     */
    public function sendNotification(): bool
    {
        return true;
    }
}
