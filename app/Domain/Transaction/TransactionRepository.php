<?php

namespace App\Domain\Transaction;

/**
 * Interface TransactionRepository
 * @package App\Domain\Transaction
 */
interface TransactionRepository
{
    /**
     * @param Transaction $transaction
     */
    public function save(Transaction $transaction): void;
}
