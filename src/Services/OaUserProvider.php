<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/4/004
 * Time: 14:21
 */

namespace Xigemall\LaravelSso\Services;


use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Xigemall\LaravelSso\Facades\Curl;

class OaUserProvider implements UserProvider
{
    // sso 地址
    protected $url;

    // 自增key (字段的名称) 默认id
    protected $incrementKey;

    public function __construct()
    {
        $this->url = rtrim(config('sso.url'), '/');
        $this->incrementKey = config('sso.increment_key', 'id');
    }

    public function retrieveById($identifier)
    {
        $path = config('sso.get_user_info_path');
        $user = Curl::get($this->url . $path . $identifier);
        return $this->getSsoUser($user);
    }

    public function retrieveByToken($identifier, $token)
    {

    }

    public function updateRememberToken(Authenticatable $user, $token)
    {

    }

    public function retrieveByCredentials(array $credentials)
    {
        $path = config('sso.get_current_user_path');
        $user = Curl::get($this->url . $path, [], $credentials);
        return $this->getSsoUser($user);
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {

    }

    /**
     * @param $user
     * @return OaUser
     * @throws \Exception
     */
    protected function getSsoUser($user)
    {
        if (is_array($user) && array_has($user, $this->incrementKey)) {
            return new OaUser($user);
        }
        throw new \Exception(json_encode($user), 400);
    }
}