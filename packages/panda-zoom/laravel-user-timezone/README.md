## Laravel Timezone

### Install:
1. `composer require panda-zoom/laravel-user-timezone`;
2. `php artisan vendor:publish --provider="PandaZoom\LaravelUserTimezone\Providers\AppServiceProvider"`;
3. `php artisan migrate` - it will be added new column `timezone` to `users` table;

### Implementing steps:
1. Set property `timezone` in config file `config/app.php`,  to default value like `UTC`.
2. Set casts as `immutable_[datetime|date|custom_datetime]` for all time fields / columns at Eloquent models.
3. Prepare Accessors & Mutators for all `datetime|date|timestamp` fields to state as on file:

`PandaZoom\LaravelUserTimezone\Models\HasTimestampCreatedAt`

or like here, if you like a new style by attributes:

`PandaZoom\LaravelUserTimezone\Models\HasTimestampCreatedAtAttribute`

> ***NOTE:*** Use `now()` for take a datetime as immutable, avoid to use `Carbon\Carbon`.

> Now all `datetime|timestamp` will be converted and stored on database as `UTC` and return to user at chosen timezone by user. 
