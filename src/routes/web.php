<?php

use Illuminate\Support\Facades\Route;

Route::get('career', function(){
    app('files')->put(resource_path('blueprints/forms/career.yaml'), 'hola');
    return 'Hello from the career form package 1';
});


