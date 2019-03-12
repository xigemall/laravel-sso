# laravel-sso

## install
`composer require xigemall/laravel-sso`

## configure
`php artisan vendor:publish --provider="Xigemall\LaravelSso\LaravelSsoServiceProvider"`

## add to your config/auth.php
```php
'guards' => [
    'api' => [
        'driver' => 'sso',
        'provider' => 'sso',
    ],
],
'providers' => [
    'sso' => [
        'driver' => 'sso',
    ]
],
```

## update to your config/sso.php
```php
return [
    // 单点登录地址
    'url' => env('OA_URL', 'http://localhost'),

    // 自增key (字段的名称) 默认id
    'increment_key' => 'staff_sn',

    // 密码字段 默认password
    'password' => 'password',

    //获取用户接口地址
    'get_user_info_path' => '/api/staff/',

    // 获取当前用户接口地址
    'get_current_user_path' => '/api/current-user/',
];
```