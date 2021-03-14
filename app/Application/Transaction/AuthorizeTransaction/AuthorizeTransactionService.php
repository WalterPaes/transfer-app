<?php

namespace App\Application\Transaction\AuthorizeTransaction;

use Illuminate\Support\Facades\Http;

/**
 * Class AuthorizeTransactionService
 * @package App\Application\Transaction\AuthorizeTransaction
 */
class AuthorizeTransactionService implements TransactionAuthorizer
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        $response = Http::get(env('AUTHORIZER_ENDPOINT'));

        if (!$response->ok() || $response['message'] != 'Autorizado') {
            return false;
        }
        return true;
    }
}
