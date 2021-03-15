<?php

namespace App\Infrastructure\Transaction;

use App\Application\Services\Transaction\AuthorizeTransaction\TransactionAuthorizer;
use Illuminate\Support\Facades\Http;

/**
 * Class TransactionAuthorizerService
 * @package App\Infrastructure\Transaction
 */
class TransactionAuthorizerService implements TransactionAuthorizer
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
