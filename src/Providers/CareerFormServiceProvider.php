<?php

namespace Astricelng\Careerform\Providers;
use Illuminate\Support\ServiceProvider;

class CareerFormServiceProvider extends ServiceProvider {

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }

    public function register()
    {
    }
}

