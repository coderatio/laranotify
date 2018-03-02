<?php
/**
 * Created by PhpStorm.
 * User: JOSIAH
 * Date: 2/25/2018
 * Time: 7:12 PM
 */

namespace Coderatio\Laranotify\Facades;


use Illuminate\Support\Facades\Facade;

class Laranotify extends Facade
{
    /**
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'Laranotify';
    }
}