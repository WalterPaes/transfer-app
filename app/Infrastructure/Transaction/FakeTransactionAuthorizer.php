<?php

namespace App\Infrastructure\Transaction;

use App\Application\Services\Transaction\AuthorizeTransaction\TransactionAuthorizer;

class FakeTransactionAuthorizer implements TransactionAuthorizer
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
