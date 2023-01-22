<?php

namespace PandaZoom\LaravelPassportAuthTests\Routes;

use Illuminate\Testing\TestResponse;
use function route;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    public function testRouteUnprocessableEntity(): TestResponse
    {
        $response = $this->postJson(route('api.logout'));

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);

        return $response;
    }

    public function testRouteNotFound(): TestResponse
    {
        $response = $this->post(route('api.logout'));

        $response->assertStatus(Response::HTTP_NOT_FOUND);

        return $response;
    }

    public function testRouteMethodNotAllowedByGet(): TestResponse
    {
        $response = $this->getJson(route('api.logout'));

        $response->assertStatus(Response::HTTP_METHOD_NOT_ALLOWED);

        return $response;
    }

    public function testRouteMethodNotAllowedByPut(): TestResponse
    {
        $response = $this->putJson(route('api.logout'));

        $response->assertStatus(Response::HTTP_METHOD_NOT_ALLOWED);

        return $response;
    }

    public function testRouteMethodNotAllowedByPatch(): TestResponse
    {
        $response = $this->patchJson(route('api.logout'));

        $response->assertStatus(Response::HTTP_METHOD_NOT_ALLOWED);

        return $response;
    }

    public function testRouteMethodNotAllowedByDelete(): TestResponse
    {
        $response = $this->deleteJson(route('api.logout'));

        $response->assertStatus(Response::HTTP_METHOD_NOT_ALLOWED);

        return $response;
    }
}
