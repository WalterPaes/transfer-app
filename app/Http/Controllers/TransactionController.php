<?php

namespace App\Http\Controllers;

use App\Application\Commands\Transaction\NotifyTransfer\NotifyTransferCommand;
use App\Application\Commands\Transaction\TransferTransaction\TransferCommand;
use App\Application\Commands\Transaction\TransferTransaction\TransferFacade;
use App\Application\Commands\Transaction\TransferTransaction\TransferTransactionDTO;
use App\Infrastructure\Transaction\TransactionAuthorizerService;
use App\Infrastructure\Transaction\TransactionCapsuleRepository;
use App\Infrastructure\Transaction\TransactionNotifierService;
use App\Infrastructure\User\UserCapsuleRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

/**
 * Class TransactionController
 * @package App\Http\Controllers
 */
class TransactionController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'value' => ['required', 'numeric'],
            'payee' => ['required', 'exists:users,id'],
            'payer' => ['required', 'exists:users,id']
        ]);

        $requestBody = $request->all();

        $db = DB::connection();

        $dto = new TransferTransactionDTO($requestBody);

        $transferCommand = new TransferCommand(
            new TransactionCapsuleRepository($db),
            new UserCapsuleRepository($db),
            new TransactionAuthorizerService
        );

        $notifyCommand = new NotifyTransferCommand(
            new TransactionNotifierService
        );

        $db->beginTransaction();

        (new TransferFacade($transferCommand, $notifyCommand))
            ->execute($dto);

        $db->commit();

        return response()->json([], 201);
    }
}
