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
            'cpf' => ['required'],
            'email' => ['required', 'email'],
            'category' => ['required', Rule::in(['user', 'shopman'])],
            'password' => ['required', 'min:6'],
        ]);

        try {
            $requestBody = $request->all();

            $command = new RegisterUserCommand(
                new UserCapsuleRepository,
                new PasswordHash
            );

            $dto = new RegisterUserDTO(
                $requestBody->name,
                $requestBody->cpf,
                $requestBody->email,
                $requestBody->password,
                $requestBody->category
            );

            DB::beginTransaction();

            $command->execute($dto);

            DB::commit();

            response()->json([], 201);
        } catch (Throwable $t) {
            DB::rollBack();
            response()->json([
                'message' => $t->getMessage()
            ], $t->getCode());
        }
    }
}
