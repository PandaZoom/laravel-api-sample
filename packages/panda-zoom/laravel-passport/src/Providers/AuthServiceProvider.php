<?php
declare(strict_types=1);

namespace PandaZoom\LaravelPassport\Providers;

use function class_exists;
use function config;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Carbon;
use Laravel\Passport\Passport;
use PandaZoom\LaravelBase\Http\Middleware\HeaderAcceptJson;
use PandaZoom\LaravelPassport\Models\AuthCode;
use PandaZoom\LaravelPassport\Models\Client;
use PandaZoom\LaravelPassport\Models\PersonalAccessClient;
use PandaZoom\LaravelPassport\Models\Token;
use PandaZoom\LaravelUserLocale\Middleware\AcceptLanguageFallback;

class_exists(Token::class);
class_exists(Client::class);
class_exists(AuthCode::class);
class_exists(PersonalAccessClient::class);

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerPolicies();

        Passport::useTokenModel(Token::class);
        Passport::useClientModel(Client::class);
        Passport::useAuthCodeModel(AuthCode::class);
        Passport::usePersonalAccessClientModel(PersonalAccessClient::class);

        Passport::tokensExpireIn(Carbon::now()->addDays(15));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
        Passport::personalAccessTokensExpireIn(Carbon::now()->addMonths(6));

        if (! $this->app->routesAreCached()) {
            Passport::routes(null, [
                'prefix' => config('common-api.api_prefix').'/oauth',
                'middleware' => [HeaderAcceptJson::class, AcceptLanguageFallback::class, 'api'],
            ]);
        }
    }
}
