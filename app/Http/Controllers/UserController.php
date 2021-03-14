<?php

namespace App\Http\Controllers;

use App\Application\User\RegisterUser\RegisterUserCommand;
use App\Application\User\RegisterUser\RegisterUserDTO;
use App\Infrastructure\User\PasswordHash;
use App\Infrastructure\User\UserCapsuleRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'cpf' => ['required', 'unique:users,cpf'],
            'email' => ['required', 'unique:users,email'],
            'category' => ['required', Rule::in(['user', 'shopman'])],
            'password' => ['required', 'min:6'],
        ]);

        $requestBody = $request->all();

        $db = DB::connection();

        $command = new RegisterUserCommand(
            new UserCapsuleRepository($db),
            new PasswordHash
        );

        $dto = new RegisterUserDTO($requestBody);

        $db->beginTransaction();

        $command->execute($dto);

        $db->commit();

        return response()->json([], 201);
    }
}
