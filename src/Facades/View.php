<?php
namespace GeistPress\Helpers\Facades;

use GeistPress\Helpers\Services;

class View extends \Mrubiosan\Facade\FacadeAccessor
{
    static public function getServiceName()
    {
        return 'view';
    }
}
