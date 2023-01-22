<?php

namespace PandaZoom\LaravelUserTimezoneTests\Services;

use Illuminate\Support\Facades\Auth;
use PandaZoom\LaravelUser\Models\User;
use PandaZoom\LaravelUserTimezone\Services\TimezoneService;
use Tests\TestCase;
use function config;

class TimezoneServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('app.timezone', 'UTC');
    }

    public function testAppLocaleIsValid(): void
    {
        Auth::shouldReceive('user')
//            ->once()
            ->andReturn(null);

        $this->assertEquals('UTC', TimezoneService::getUserTimezone());
    }

    public function testUserLocaleIsValid(): void
    {
        $user = User::factory(1)->make()->first();

        Auth::shouldReceive('user')
//            ->once()
            ->andReturn($user);

        $this->assertEquals($user->timezone, TimezoneService::getUserTimezone());
    }
}
