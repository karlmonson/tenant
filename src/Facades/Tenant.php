<?php

namespace Karlmonson\Tenant\Facades;

use Illuminate\Support\Facades\Facade;

class Tenant extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'tenant';
    }
}