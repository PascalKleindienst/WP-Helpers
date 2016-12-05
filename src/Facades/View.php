<?php
namespace GeistPress\Helpers\Facades;

use GeistPress\Helpers\Services;

class View extends \Mrubiosan\Facade\FacadeAccessor
{
    public static function getServiceName()
    {
        return 'view';
    }
}
