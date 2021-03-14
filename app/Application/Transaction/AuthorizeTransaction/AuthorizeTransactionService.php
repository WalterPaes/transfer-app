<?php

namespace App\Application\Transaction\AuthorizeTransaction;

use Illuminate\Support\Facades\Http;

class AuthorizeTransactionService implements TransactionAuthorizer
{
    public function authorize(): bool
    {
        $response = Http::get(env('AUTHORIZER_ENDPOINT'));

        if (!$response->ok() || $response['message'] != 'Autorizado') {
            return false;
        }
        return true;
    }
}
