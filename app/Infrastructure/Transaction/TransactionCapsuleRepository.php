<?php

namespace App\Infrastructure\Transaction;

use App\Domain\Transaction\Transaction;
use App\Domain\Transaction\TransactionRepository;
use Illuminate\Database\Capsule\Manager as DB;

class TransactionCapsuleRepository implements TransactionRepository
{
    public function save(Transaction $transaction): bool
    {
        DB::table('transactions')
            ->insert((array)$transaction);
    }
}
