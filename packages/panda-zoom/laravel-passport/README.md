
check at `config/passport` existing a next properties, if not then input:

```php
<?php

return [
// ...

    'grant_access_client' => [
        'id' => env('PASSPORT_GRANT_ACCESS_CLIENT_ID'),
        'secret' => env('PASSPORT_GRANT_ACCESS_CLIENT_SECRET'),
    ],

// ...
];
```
