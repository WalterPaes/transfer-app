<?php

namespace App\Application\TransferTransaction;

use App\Application\Transaction\AuthorizeTransaction\TransactionAuthorizer;
use App\Domain\Transaction\Transaction;
use App\Domain\Transaction\TransactionRepository;
use App\Domain\User\UserRepository;
use Exception;

class TransferCommand
{
    private TransactionRepository $transactionRepository;
    private UserRepository $userRepository;
    private TransactionAuthorizer $authorizer;

    public function __construct(
        TransactionRepository $transactionRepository,
        UserRepository $userRepository,
        TransactionAuthorizer $authorizer
    )
    {
        $this->transactionRepository = $transactionRepository;
        $this->userRepository = $userRepository;
        $this->authorizer = $authorizer;
    }

    public function execute(TransferTransactionDTO $transferTransactionDTO): void
    {
        $payer = $this->userRepository
            ->findById($transferTransactionDTO->payer);
        $payee = $this->userRepository
            ->findById($transferTransactionDTO->payee);

        $transaction = new Transaction($transferTransactionDTO->value, $payee, $payer);

        if (!$this->authorizer->authorize()) {
            throw new Exception('transaction was not authorized', 500);
        }

        $this->transactionRepository->save($transaction);
    }
}
