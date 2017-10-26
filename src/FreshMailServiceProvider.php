<?php

namespace PawelMysior\FreshMail;

use Illuminate\Support\ServiceProvider;

class FreshMailServiceProvider extends ServiceProvider
{
    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('FreshMail', function () {
            return new FreshMail(
                config('services.freshmail.key'),
                config('services.freshmail.secret'),
                config('services.freshmail.list')
            );
        });
    }
}
