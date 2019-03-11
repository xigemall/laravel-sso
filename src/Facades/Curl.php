<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/6/006
 * Time: 16:56
 */

namespace Xigemall\LaravelSso\Facades;


use Illuminate\Support\Facades\Facade;

class Curl extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'curl';
    }
}