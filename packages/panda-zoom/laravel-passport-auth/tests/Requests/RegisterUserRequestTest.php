<?php

namespace PandaZoom\LaravelPassportAuthTests\Requests;

use PandaZoom\LaravelPassportAuth\Http\Requests\RegisterUserRequest;
use PandaZoom\LaravelUser\Models\User;
use Tests\TestCase;

class RegisterUserRequestTest extends TestCase
{
    public function testCallAsUserIsFailure(): void
    {
        $this->be(User::factory(1)->create()->first());

        $request = new RegisterUserRequest();

        $this->assertFalse($request->authorize());
    }
}
