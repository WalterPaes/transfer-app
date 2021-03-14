<?php

namespace App\Http\Controllers;

use App\Application\Transaction\AuthorizeTransaction\AuthorizeTransactionService;
use App\Application\TransferTransaction\TransferCommand;
use App\Application\TransferTransaction\TransferTransactionDTO;
use App\Infrastructure\Transaction\TransactionCapsuleRepository;
use App\Infrastructure\User\UserCapsuleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class TransactionController
 * @package App\Http\Controllers
 */
class TransactionController
{
    /**
     * @param Request $request
     * @throws \Exception
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'value', ['required', 'numeric'],
            'payee', ['required', 'exists:users,id'],
            'payer', ['required', 'exists:users,id']
        ]);

        $requestBody = $request->all();

        $db = DB::connection();

        $command = new TransferCommand(
            new TransactionCapsuleRepository($db),
            new UserCapsuleRepository($db),
            new AuthorizeTransactionService
        );

        $dto = new TransferTransactionDTO($requestBody);

        $db->beginTransaction();

        $command->execute($dto);

        $db->commit();

        response()->json([], 201);
    }
}
