<?php

use App\Application\User\RegisterUser\RegisterUserCommand;
use App\Application\User\RegisterUser\RegisterUserDTO;
use App\Infra\Database\PdoConnection;
use App\Infra\User\PasswordHash;
use App\Infra\User\UserPdoRepository;
use Dotenv\Dotenv;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

error_reporting(E_ERROR);

$dotenv = Dotenv::createImmutable('../');
$dotenv->load();

$app = AppFactory::create();
$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();

$app->post('/users/create', function (Request $request, Response $response, $args) {
    try {
        $requestBody = $request->getParsedBody();

        $validation = Validator::make($requestBody, [
            'name' => ['required'],
            'cpf' => ['required'],
            'email' => ['required', 'email'],
            'category' => ['required', Rule::in(['user', 'shopman'])],
            'password' => ['required', 'min:6'],
        ]);

        if ($validation->fails()) {
            var_dump($validation->errors());
        }

        $pdo = PdoConnection::getConnection();

        $command = new RegisterUserCommand(
            new UserPdoRepository($pdo),
            new PasswordHash()
        );

        $dto = new RegisterUserDTO(
            $requestBody['name'],
            $requestBody['cpf'],
            $requestBody['email'],
            $requestBody['password'],
            $requestBody['category'],
        );

        $pdo->beginTransaction();

        $command->execute($dto);

        $pdo->commit();

        $newResponse = $response->withHeader('Content-type', 'application/json');
        return $newResponse->withStatus(201);
    } catch (Throwable $t) {
        //$pdo->rollBack();
        throw new Exception($t->getMessage(), $t->getCode());
    }
});

$customErrorHandler = function (
    Request $request,
    Throwable $exception,
    bool $displayErrorDetails,
    bool $logErrors,
    bool $logErrorDetails,
    ?LoggerInterface $logger = null
) use ($app) {
    $payload = [
        'message' => $exception->getMessage(),
    ];

    $response = $app->getResponseFactory()->createResponse();
    $newResponse = $response->withHeader('Content-type', 'application/json');
    $newResponse->getBody()->write(
        json_encode($payload, JSON_UNESCAPED_UNICODE)
    );

    $code = $exception->getCode() === 0 ? 500 : $exception->getCode();

    return $newResponse->withStatus($code);
};

$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler($customErrorHandler);

$app->run();

