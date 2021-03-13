<?php

use App\Application\User\RegisterUser\RegisterUserCommand;
use App\Application\User\RegisterUser\RegisterUserDTO;
use App\Infra\Database\PdoConnection;
use App\Infra\User\PasswordHash;
use App\Infra\User\UserPdoRepository;
use Dotenv\Dotenv;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

try {
    $dotenv = Dotenv::createImmutable('../');
    $dotenv->load();

    $app = AppFactory::create();
    $app->addBodyParsingMiddleware();

    $app->post('/', function (Request $request, Response $response, $args) {
        $requestBody = $request->getParsedBody();
        $pdo = PdoConnection::getConnection();

        $command = new RegisterUserCommand(
            new UserPdoRepository($pdo),
            new PasswordHash()
        );

        $dto = new RegisterUserDTO(
            $requestBody['name'],
            $requestBody['cpf'],
            $requestBody['email'],
            "12345",
            $requestBody['category'],
        );

        $command->execute($dto);

        $response->getBody()->write('ok');
        return $response;
    });

    $app->run();
} catch (Throwable $t) {
    echo $t->getMessage();
    echo "<br>";
    echo $t->getFile();
    echo "<br>";
    echo $t->getLine();
}

