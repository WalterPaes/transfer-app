<?php

namespace App\Infrastructure\Transaction;

use App\Domain\Transaction\Transaction;
use App\Domain\Transaction\TransactionRepository;
use Illuminate\Database\ConnectionInterface;

/**
 * Class TransactionCapsuleRepository
 * @package App\Infrastructure\Transaction
 */
class TransactionCapsuleRepository implements TransactionRepository
{
    /**
     * @var ConnectionInterface
     */
    private ConnectionInterface $db;

    /**
     * TransactionCapsuleRepository constructor.
     * @param ConnectionInterface $db
     */
    public function __construct(ConnectionInterface $db)
    {
        $this->db = $db;
    }

    /**
     * @param Transaction $transaction
     * @return bool
     */
    public function save(Transaction $transaction): bool
    {
        $this->db->table('transactions')
            ->insert([
                'value' => $transaction->value(),
                'payee' => $transaction->payee()->id(),
                'payer' => $transaction->payer()->id(),
            ]);
    }
}
