<?php

namespace App\Providers;

use App\Infrastructure\User\UserCapsuleRepository;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['auth']->viaRequest('api', function (Request $request) {
            if (!$request->hasHeader('Authorization')) {
                return null;
            }

            $authorizationHeader = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $data = JWT::decode($token, env('JWT_KEY'), ['HS256']);

            $db = DB::connection();
            $repository = new UserCapsuleRepository($db);
            return $repository->findByEmail($data->email);
        });
    }
}
