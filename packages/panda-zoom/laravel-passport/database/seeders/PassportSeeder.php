<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use PandaZoom\LaravelPassport\Models\Client;
use PandaZoom\LaravelPassport\Models\PersonalAccessClient;

class PassportSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedByCustomerTestData();
    }

    protected function seedByCustomerTestData(): void
    {
        Model::unguard();

        Client::query()->upsert($this->getClientData(), 'id');

        PersonalAccessClient::query()->upsert($this->getPersonalAccessClientData(), 'id');

        Model::reguard();
    }

    protected function getPersonalAccessClientData(): array
    {
        return [
            [
                'id' => 1,
                'client_id' => '978fe9df-d8d6-49f1-bc80-ae232dc135d6',
                'created_at' => '2022-10-22 12:59:58',
                'updated_at' => '2022-10-22 12:59:58',
            ],
        ];
    }

    protected function getClientData(): array
    {
        return [
            [
                'id' => '978fe9df-d8d6-49f1-bc80-ae232dc135d6',
                'name' => 'Laravel Personal Access Client',
                'secret' => 'ZrHC1P1uG3mk5uRUoTXgwriukcqkpqIGtjUCv6m0',
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' => '2022-10-22 12:59:58',
                'updated_at' => '2022-10-22 12:59:58',
            ],
            [
                'id' => '978fe9df-ebea-49a6-9a3e-c668cb20affc',
                'name' => 'Laravel Password Grant Client',
                'secret' => 'oNspHKM7uNV1Rm2TpzuANXsdaKjDRERZcEahp9RV',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
                'created_at' => '2022-10-22 12:59:58',
                'updated_at' => '2022-10-22 12:59:58',
            ],
        ];
    }
}
