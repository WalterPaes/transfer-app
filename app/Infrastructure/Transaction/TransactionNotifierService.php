<?php

namespace App\Infrastructure\Transaction;

use App\Application\Services\Transaction\NotifyTransaction\TransactionNotifier;
use Illuminate\Support\Facades\Http;

/**
 * Class TransactionNotifierService
 * @package App\Infrastructure\Transaction
 */
class TransactionNotifierService implements TransactionNotifier
{
    /**
     * @return bool
     */
    public function sendNotification(): bool
    {
        $response = Http::get(env('NOTIFIER_ENDPOINT'));

        if (!$response->ok() || $response['message'] != 'Enviado') {
            return false;
        }
        return true;
    }
}
