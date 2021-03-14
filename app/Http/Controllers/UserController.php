<?php

namespace App\Http\Controllers;

use App\Application\User\RegisterUser\RegisterUserCommand;
use App\Application\User\RegisterUser\RegisterUserDTO;
use App\Infrastructure\User\PasswordHash;
use App\Infrastructure\User\UserCapsuleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'cpf' => ['required', 'unique:users,cpf'],
            'email' => ['required', 'unique:users,email'],
            'category' => ['required', Rule::in(['user', 'shopman'])],
            'password' => ['required', 'min:6'],
        ]);

        $db = DB::connection();

        try {
            $requestBody = $request->all();

            $command = new RegisterUserCommand(
                new UserCapsuleRepository($db),
                new PasswordHash
            );

            $dto = new RegisterUserDTO($requestBody);

            $db->beginTransaction();

            $command->execute($dto);

            $db->commit();

            return response()->json([], 201);
        } catch (Throwable $t) {
            $db->rollBack();

            $code = $t->getCode();
            if ($t->getCode() < 100 || $t->getCode() > 599) {
                $code = 500;
            }

            return response()->json([
                'message' => $t->getMessage()
            ], $code);
        }
    }
}
