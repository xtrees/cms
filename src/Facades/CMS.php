<?php

namespace XTrees\CMS\Facades;

use Illuminate\Support\Facades\Facade;

class CMS extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'cms';
    }
}
