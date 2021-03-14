<?php

namespace App\Application\Services\Transaction\NotifyTransaction;

/**
 * Interface TransactionNotifier
 * @package App\Application\Services\Transaction\NotifyTransaction
 */
interface TransactionNotifier
{
    /**
     * @return bool
     */
    public function sendNotification(): bool;
}
