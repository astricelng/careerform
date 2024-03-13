<?php

use Illuminate\Support\Facades\Route;

Route::get('career', function(){
    app('files')->put(base_path('resources/blueprints/forms/career.yaml'), 'hola');
    return 'Hello from the career form package';
});


