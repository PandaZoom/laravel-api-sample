<?php

namespace PandaZoom\LaravelUserTests\Models;

use Carbon\CarbonImmutable;
use PandaZoom\LaravelUser\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    protected User|null $model;

    public function test_userModel(): ?User
    {
        $this->model = User::inRandomOrder()->first();

        if ($this->model instanceof User) {

            $this->checkColumns();

        } else {
            $this->assertNull($this->model);
        }

        return $this->model;
    }

    public function testDummyUserModel(): void
    {
        $this->model = User::factory(1)->make()->first();

        $this->assertNotNull($this->model);
        $this->assertInstanceOf(User::class, $this->model);

        $this->checkColumnFirstName();
        $this->checkColumnLastName();
        $this->checkColumnEmailVerifiedAt();
        $this->checkColumnPassword();
        $this->checkColumnRememberToken();
        $this->checkColumnDeletedAt();
        $this->checkColumnLocale();
        $this->checkColumnTimezone();
    }

    protected function checkColumns(): void
    {
        $this->checkColumnId();
        $this->checkColumnFirstName();
        $this->checkColumnLastName();
        $this->checkColumnEmailVerifiedAt();
        $this->checkColumnPassword();
        $this->checkColumnRememberToken();
        $this->checkColumnCreatedAt();
        $this->checkColumnUpdatedAt();
        $this->checkColumnDeletedAt();
        $this->checkColumnActive();
        $this->checkColumnLocale();
        $this->checkColumnTimezone();
    }

    protected function checkColumnId(): void
    {
        $this->assertNotEmpty($this->model->getAuthIdentifier());
        $this->assertIsInt($this->model->getAuthIdentifier());
    }

    protected function checkColumnFirstName(): void
    {
        $this->assertNotEmpty($this->model->first_name);
        $this->assertIsString($this->model->first_name);
    }

    protected function checkColumnLastName(): void
    {
        if (! empty($this->model->last_name)) {
            $this->assertIsString($this->model->last_name);
        } else {
            $this->assertNull($this->model->last_name);
        }
    }

    protected function checkColumnEmail(): void
    {
        $this->assertNotEmpty($this->model->email);
        $this->assertIsString($this->model->email);
    }

    protected function checkColumnRememberToken(): void
    {
        if (! empty($this->model->remember_token)) {
            $this->assertIsString($this->model->remember_token);
        } else {
            $this->assertNull($this->model->remember_token);
        }
    }

    protected function checkColumnEmailVerifiedAt(): void
    {
        if (! empty($this->model->email_verified_at)) {
            $this->assertNotNull($this->model->email_verified_at);
            $this->assertInstanceOf(CarbonImmutable::class, $this->model->email_verified_at);
        } else {
            $this->assertNull($this->model->email_verified_at);
        }
    }

    protected function checkColumnPassword(): void
    {
        $this->assertNotEmpty($this->model->password);
        $this->assertIsString($this->model->password);
    }

    protected function checkColumnCreatedAt(): void
    {
        $this->assertNotNull($this->model->created_at);
        $this->assertInstanceOf(CarbonImmutable::class, $this->model->created_at);
    }

    protected function checkColumnUpdatedAt(): void
    {
        $this->assertNotNull($this->model->updated_at);
        $this->assertInstanceOf(CarbonImmutable::class, $this->model->updated_at);
    }

    protected function checkColumnDeletedAt(): void
    {
        if (! empty($this->model->deleted_at)) {
            $this->assertNotNull($this->model->deleted_at);
            $this->assertInstanceOf(CarbonImmutable::class, $this->model->deleted_at);
        } else {
            $this->assertNull($this->model->deleted_at);
        }
    }

    protected function checkColumnActive(): void
    {
        $this->assertIsBool($this->model->active);
    }

    protected function checkColumnLocale(): void
    {
        if (! empty($this->model->locale)) {
            $this->assertNotNull($this->model->locale);
            $this->assertIsString($this->model->locale);
        } else {
            $this->assertNull($this->model->locale);
        }
    }

    protected function checkColumnTimezone(): void
    {
        if (! empty($this->model->timezone)) {
            $this->assertNotNull($this->model->timezone);
            $this->assertIsString($this->model->timezone);
        } else {
            $this->assertNull($this->model->timezone);
        }
    }
}
