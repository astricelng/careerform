<?php

namespace Astricelng\Careerform\Providers;
use Astricelng\Careerform\Console\InstallCareerPackage;
use Illuminate\Support\ServiceProvider;

class CareerFormServiceProvider extends ServiceProvider {

    public function boot()
    {
        /*$this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../views', 'careerform');*/

       /* $this->publishes([
            __DIR__.'/../views' => resource_path('views/vendor/careerform'),
        ]);*/

        // Register the command if we are using the application via the CLI
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCareerPackage::class,
            ]);
        }

    }

    public function register()
    {
    }
}

