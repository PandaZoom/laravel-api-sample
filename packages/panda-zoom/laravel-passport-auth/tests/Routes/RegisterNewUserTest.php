<?php

namespace PandaZoom\LaravelPassportAuthTests\Routes;

use Illuminate\Testing\TestResponse;
use PandaZoom\LaravelUser\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use function route;

class RegisterNewUserTest extends TestCase
{
    public function testRouteSuccessful(): TestResponse
    {
        $user = User::factory(1)->make()->first();

        $data = $user->only(['email', 'password']);

        $data['firstName'] = $user->first_name;
        $data['lastName'] = $user->last_name;
        $data['locale'] = $user->locale;
        $data['timezone'] = $user->timezone;

        $response = $this->postJson(route('api.register'), $data);

        $response->assertStatus(Response::HTTP_CREATED);

        $response->assertJsonStructure([
            'token_type',
            'expires_in',
            'access_token',
            'refresh_token',
        ]);

        return $response;
    }

    public function testRouteUnprocessableEntity(): TestResponse
    {
        $userData = User::factory(1)->make()->first()->only(['first_name', 'last_name', 'email']);

        $response = $this->postJson(route('api.register'), $userData);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        return $response;
    }

    public function testRouteNotFound(): TestResponse
    {
        $response = $this->post(route('api.register'));

        $response->assertStatus(Response::HTTP_NOT_FOUND);

        return $response;
    }

    public function testRouteMethodNotAllowedByGet(): TestResponse
    {
        $response = $this->getJson(route('api.register'));

        $response->assertStatus(Response::HTTP_METHOD_NOT_ALLOWED);

        return $response;
    }

    public function testRouteMethodNotAllowedByPut(): TestResponse
    {
        $response = $this->putJson(route('api.register'));

        $response->assertStatus(Response::HTTP_METHOD_NOT_ALLOWED);

        return $response;
    }

    public function testRouteMethodNotAllowedByPatch(): TestResponse
    {
        $response = $this->patchJson(route('api.register'));

        $response->assertStatus(Response::HTTP_METHOD_NOT_ALLOWED);

        return $response;
    }

    public function testRouteMethodNotAllowedByDelete(): TestResponse
    {
        $response = $this->deleteJson(route('api.register'));

        $response->assertStatus(Response::HTTP_METHOD_NOT_ALLOWED);

        return $response;
    }
}
