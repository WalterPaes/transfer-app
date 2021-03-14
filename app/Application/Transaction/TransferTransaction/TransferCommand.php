<?php

namespace App\Application\Transaction\TransferTransaction;

use App\Application\Transaction\AuthorizeTransaction\TransactionAuthorizer;
use App\Domain\Transaction\Exception\UnauthorizedTransactionException;
use App\Domain\Transaction\Transaction;
use App\Domain\Transaction\TransactionRepository;
use App\Domain\User\Exception\IsNotTransferibleException;
use App\Domain\User\UserRepository;
use Exception;

/**
 * Class TransferCommand
 * @package App\Application\TransferTransaction
 */
class TransferCommand
{
    /**
     * @var TransactionRepository
     */
    private TransactionRepository $transactionRepository;
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;
    /**
     * @var TransactionAuthorizer
     */
    private TransactionAuthorizer $authorizer;

    /**
     * TransferCommand constructor.
     * @param TransactionRepository $transactionRepository
     * @param UserRepository $userRepository
     * @param TransactionAuthorizer $authorizer
     */
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

    /**
     * @param TransferTransactionDTO $transferTransactionDTO
     * @throws Exception
     */
    public function execute(TransferTransactionDTO $transferTransactionDTO): void
    {
        $payer = $this->userRepository
            ->findById($transferTransactionDTO->payer);

        if (!$payer->isTransferable()) {
            throw new IsNotTransferibleException;
        }

        $payee = $this->userRepository
            ->findById($transferTransactionDTO->payee);

        $transaction = new Transaction($transferTransactionDTO->value, $payee, $payer);

        if (!$this->authorizer->authorize()) {
            throw new UnauthorizedTransactionException();
        }

        $this->transactionRepository->save($transaction);
    }
}
