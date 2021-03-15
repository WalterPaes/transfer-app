<?php

namespace App\Application\Commands\Transaction\TransferTransaction;

use App\Application\Commands\Transaction\NotifyTransfer\NotifyTransferCommand;
use App\Domain\Transaction\Exception\NotNotifiedException;

/**
 * Class TransferFacade
 * @package App\Application\Commands\Transaction\TransferTransaction
 */
class TransferFacade
{
    /**
     * @var TransferCommand
     */
    private TransferCommand $transferCommand;
    /**
     * @var NotifyTransferCommand
     */
    private NotifyTransferCommand $notifyCommand;

    /**
     * TransferFacade constructor.
     * @param TransferCommand $transferCommand
     * @param NotifyTransferCommand $notifyTransferCommand
     */
    public function __construct(TransferCommand $transferCommand, NotifyTransferCommand $notifyTransferCommand)
    {
        $this->transferCommand = $transferCommand;
        $this->notifyCommand = $notifyTransferCommand;
    }

    /**
     * @param TransferTransactionDTO $transferTransactionDTO
     * @throws NotNotifiedException
     */
    public function execute(TransferTransactionDTO $transferTransactionDTO)
    {
        $this->transferCommand->execute($transferTransactionDTO);
        $this->notifyCommand->execute();
    }
}
