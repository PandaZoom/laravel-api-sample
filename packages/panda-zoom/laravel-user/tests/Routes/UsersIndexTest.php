<?php

namespace PandaZoom\LaravelUserTests\Routes;

use Illuminate\Testing\TestResponse;
use function route;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UsersIndexTest extends TestCase
{
    public function testIndexRouteSuccessful(): TestResponse
    {
        $response = $this->getJson(route('api.users.index'));

        $response->assertStatus(Response::HTTP_OK);

        return $response;
    }
}
