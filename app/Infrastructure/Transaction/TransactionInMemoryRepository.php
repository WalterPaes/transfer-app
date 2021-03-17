<?php

namespace App\Infrastructure\Transaction;

use App\Domain\Transaction\Transaction;
use App\Domain\Transaction\TransactionRepository;

class TransactionInMemoryRepository implements TransactionRepository
{
    /**
     * @var array
     */
    private array $transactions;

    /**
     * @param Transaction $transaction
     */
    public function save(Transaction $transaction): void
    {
        $this->transactions[] = $transaction;
    }
}
