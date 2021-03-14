<?php

namespace App\Http\Controllers;

use App\Application\Transaction\AuthorizeTransaction\AuthorizeTransactionService;
use App\Application\TransferTransaction\TransferCommand;
use App\Application\TransferTransaction\TransferTransactionDTO;
use App\Infrastructure\Transaction\TransactionCapsuleRepository;
use App\Infrastructure\User\UserCapsuleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class TransactionController
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'value', ['required', 'numeric'],
            'payee', ['required', 'exists:users,id'],
            'payer', ['required', 'exists:users,id']
        ]);

        try {
            $requestBody = $request->all();

            $command = new TransferCommand(
                new TransactionCapsuleRepository,
                new UserCapsuleRepository,
                new AuthorizeTransactionService
            );

            $dto = new TransferTransactionDTO(
                $requestBody->value,
                $requestBody->payer,
                $requestBody->payee,
            );

            DB::beginTransaction();

            $command->execute($dto);

            DB::commit();

            response()->json([], 201);
        } catch (Throwable $t) {
            DB::rollBack();
            $code = $t->getCode() == 0 ? 500 : $t->getCode();
            response()->json([
                'message' => $t->getMessage()
            ], $code);
        }
    }
}
