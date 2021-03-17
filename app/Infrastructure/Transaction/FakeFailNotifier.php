<?php

namespace App\Infrastructure\Transaction;

use App\Application\Services\Transaction\NotifyTransaction\TransactionNotifier;

class FakeFailNotifier implements TransactionNotifier
{
    /**
     * @return bool
     */
    public function sendNotification(): bool
    {
        return false;
    }
}
