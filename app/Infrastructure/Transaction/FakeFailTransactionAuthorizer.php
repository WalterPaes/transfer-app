<?php

namespace App\Infrastructure\Transaction;

use App\Application\Services\Transaction\AuthorizeTransaction\TransactionAuthorizer;

class FakeFailTransactionAuthorizer implements TransactionAuthorizer
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return false;
    }
}
