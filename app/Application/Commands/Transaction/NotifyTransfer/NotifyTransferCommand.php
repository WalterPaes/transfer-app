<?php

namespace App\Application\Commands\Transaction\NotifyTransfer;

use App\Application\Services\Transaction\NotifyTransaction\TransactionNotifier;
use App\Domain\Transaction\Exception\NotNotifiedException;

/**
 * Class NotifyTransferCommand
 * @package App\Application\Commands\Transaction\NotifyTransfer
 */
class NotifyTransferCommand
{
    /**
     * @var TransactionNotifier
     */
    private TransactionNotifier $notifier;

    /**
     * NotifyTransferCommand constructor.
     * @param TransactionNotifier $notifier
     */
    public function __construct(TransactionNotifier $notifier)
    {
        $this->notifier = $notifier;
    }

    /**
     * @throws NotNotifiedException
     */
    public function execute()
    {
        if (!$this->notifier->sendNotification()) {
            throw new NotNotifiedException();
        }
    }
}
