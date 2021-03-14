<?php

namespace App\Application\Transaction\AuthorizeTransaction;

interface TransactionAuthorizer
{
    public function authorize(): bool;
}
