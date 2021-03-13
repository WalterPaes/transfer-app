<?php

namespace App\Domain\Transaction;

interface TransactionRepository
{
    public function save(Transaction $transaction): bool;
}