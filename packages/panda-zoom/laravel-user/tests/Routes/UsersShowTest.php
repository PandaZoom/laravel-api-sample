<?php

namespace PandaZoom\LaravelUserTests\Routes;

use Illuminate\Testing\TestResponse;
use PandaZoom\LaravelUser\Models\User;
use function route;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UsersShowTest extends TestCase
{
    public function testShowRouteSuccessful(): TestResponse
    {
        $user = User::active()->inRandomOrder()->first();

        $response = $this->getJson(route('api.users.show', $user));

        $response->assertStatus(Response::HTTP_OK);

        return $response;
    }
}
