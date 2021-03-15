<?php

namespace App\Infrastructure\Wallet;

use App\Domain\User\User;
use App\Domain\Wallet\WalletRepository;
use Illuminate\Database\ConnectionInterface;

class WalletCapsuleRepository implements WalletRepository
{
    /**
     * @var ConnectionInterface
     */
    private ConnectionInterface $db;

    /**
     * UserCapsuleRepository constructor.
     * @param ConnectionInterface $db
     */
    public function __construct(ConnectionInterface $db)
    {
        $this->db = $db;
    }

    public function save(User $owner, float $amount): void
    {
        $this->db->table('wallets')
            ->insert([
                'balance' => $amount,
                'user_id' => $owner->id(),
            ]);
    }
}
