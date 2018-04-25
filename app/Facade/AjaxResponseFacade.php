<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/12/14
 * Time: 10:11
 */

namespace App\Facade;


use Illuminate\Support\Facades\Facade;

class AjaxResponseFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'AjaxResponseService';
    }
}