<?php

namespace App\Http\Controllers;

use App\Application\Commands\User\AuthenticateUser\AuthUserCommand;
use App\Application\Commands\User\AuthenticateUser\AuthUserDTO;
use App\Infrastructure\User\PasswordHash;
use App\Infrastructure\User\UserCapsuleRepository;
use Firebase\JWT\JWT;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

/**
 * Class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6']
        ]);

        $email = $request['email'];
        $dto = new AuthUserDTO($email, $request['password']);

        $db = DB::connection();
        $command = new AuthUserCommand(
            new UserCapsuleRepository($db),
            new PasswordHash
        );

        $command->execute($dto);

        $token = JWT::encode(
            [
                'email' => $email
            ],
            env('JWT_KEY')
        );

        return response()->json([
            'access_token' => $token
        ], 200);
    }
}
