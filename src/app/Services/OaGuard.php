<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/4/004
 * Time: 14:10
 */

namespace Xigemall\LaravelSso\App\Services;


use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;

class OaGuard implements Guard
{
    use GuardHelpers;

    protected $provider;
    protected $request;
    protected $user = null;

    protected $authorizationKey = 'Authorization';

    public function __construct(UserProvider $provider, Request $request)
    {
        $this->provider = $provider;
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function check()
    {
        if (!$this->getToken()) {
            return false;
        }
        return true;
    }

    public function guest()
    {
        return true;
    }

    /**
     * @return Authenticatable|null
     */
    public function user()
    {
        if (!is_null($this->user)) {
            return $this->user;
        }
        $token = $this->getToken();
        $this->user = $this->provider->retrieveByCredentials([$this->authorizationKey => $token]);
        return $this->user;
    }


    public function validate(array $credentials = [])
    {
        return true;
    }

    public function setUser(Authenticatable $user)
    {
        // TODO: Implement setUser() method.
    }

    /**
     * 获取token
     * @return array|string
     */
    protected function getToken()
    {
        return $this->request->header($this->authorizationKey);
    }
}