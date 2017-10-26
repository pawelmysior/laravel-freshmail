<?php

namespace PawelMysior\FreshMail;

use Illuminate\Support\Facades\Facade;

class FreshMailFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'FreshMail';
    }
}
