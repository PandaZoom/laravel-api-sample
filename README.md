<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

- [About Api sample](#about-api-sample)
- [Requirements](#requirements)
- [Setup API](#setup-api)
- [Setup Postman](#setup-postman)
- [Implemented](#implemented)


## About Api Sample

- Sessions removed, for api - not required at all;
- [Sanctum](https://laravel.com/docs/9.x/sanctum) removed, against using [Passport](https://laravel.com/docs/9.x/passport);
- all source code located at `packages/panda-zoom/*`, packages enabled by symlink via composer;

> __NOTE:__ if you got app via `git clone ..` - you may run `composer update` or `composer install` for create a symlink from `<DocumentRoot>/vendor` to `<DocumentRoot>/packages/...`

### Requirements
`php8.1` and connection to database.

### Setup API
1. install `composer create-project panda-zoom/laravel-api-sample`;
2. configure connection to database at `.env`;
3. run migrations:
```shell
php artisan migrate
```
5. run seed:
```shell
php artisan db:seed
```
> NOTE: `laravel/passport` already configured, file `.env` already has all required keys, also seeds has actual keys:

```shell
PASSPORT_GRANT_ACCESS_CLIENT_ID=978fe9df-ebea-49a6-9a3e-c668cb20affc
PASSPORT_GRANT_ACCESS_CLIENT_SECRET=oNspHKM7uNV1Rm2TpzuANXsdaKjDRERZcEahp9RV
```

### Setup Postman
1. import postman environment properties from file: `postman/1. Local.environment.json`;
2. import postman collections from file: `postman/1. Localhost Api.collection.json`;
3. set your to environment config `1. Local` next properties:  
`baseUri` - your api domain;
`userEmail` - get any existing email from table `users` from any user (all users has successful passed role as `admin`, just for demo)

> __NOTE:__ password for any user is `00000000`, 8 times `0`

> __NOTE:__ any `POST`, `PUT`, `PATCH`, `DELETE` request methods - required authorized user. 

### Implemented:
- timezones.  User could watch all timestamps at preferred timezone, and change timezone, property will be stored at table `users.timezone` for authorized users, or will be using a server default timezone by `UTC`
- Support multi-languages, for models:  
    `packages/panda-zoom/laravel-article/src/Models/Article`  
  English is required by default and using as fallback language on api and translations.
- header `Accept-Language`, ex: `Accept-Language: de` will be asks from server `de` translations, if `de` is not found, will be return a fallback `en` translation;
- any changes logging for models:  
  `packages/panda-zoom/laravel-user/src/Models/User` - `fully`  
  `packages/panda-zoom/laravel-article/src/Models/Article` - `partially`  
  `packages/panda-zoom/laravel-language/src/Models/Language` - `partially`  
- at responses properties returns at `camelCase`; 
- at requests params incoming as `camelCase` and transformed to `snake_case`, under hood on backend side - using a proposed by laravel `snake_case`;
- advanced logs views for articles at model:  
 `packages/panda-zoom/laravel-article-log/src/Models/ArticleViewLog` 
  views increases by user or ip every `15` minutes.
- Implemented some test for packages, could be run from `<DocumentRoot>/phpunit.xml`

> Note: `Action` - using for multiple tasks/actions an operations, `Tasks` - only for one an operation.

## Advanced GET
> __NOTE:__  all GET requests supporting a next params:
- `with` - for eager loading a related relations, separated by `,`;
- `include` - for shown at response a children relations, separated by `,`;
- `filter` - for shown only required properties from model, separated by `,`;  

