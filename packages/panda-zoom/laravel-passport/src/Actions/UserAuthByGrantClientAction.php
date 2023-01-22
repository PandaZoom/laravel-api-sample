<?php
declare(strict_types=1);

namespace PandaZoom\LaravelPassport\Actions;

use function app;
use function config;
use function json_decode;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Psr\Http\Message\ServerRequestInterface;

class UserAuthByGrantClientAction
{
    public function __construct(protected AccessTokenController $controller)
    {
        //
    }

    public function run(string $username, string $password): array
    {
        return json_decode($this->controller->issueToken($this->makeRequest($username, $password))->content(), true);
    }

    public function makeRequest(string $username, string $password, string $scope = '*'): ServerRequestInterface
    {
        return app(ServerRequestInterface::class)
            ->withParsedBody([
                'grant_type' => 'password',
                'username' => $username,
                'password' => $password,
                'client_id' => config('passport.grant_access_client.id'),
                'client_secret' => config('passport.grant_access_client.secret'),
                'scope' => $scope,
            ]);
    }
}
