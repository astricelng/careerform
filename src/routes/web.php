<?php

use Illuminate\Support\Facades\Route;

use Statamic\Facades\AssetContainer;
use Statamic\Facades\Form;
use Statamic\Facades\Collection;

Route::get('career', function(){

    /*$files = AssetContainer::find('files');
    $files->assetFolder('career')->save();

    $careerForm = app('files')->get(__DIR__ . '/../templates/blueprints/forms/career.yaml');
    app('files')->put(base_path('resources/blueprints/forms/career.yaml'), $careerForm);

    $form = Form::make()->handle('career');
    $form
        ->handle('career')
        ->honeypot('fax')
        ->title('Career')
        ->save();*/


    $careerCollection = app('files')->get(__DIR__ . '/../templates/blueprints/collections/career.yaml');

    if (!file_exists(base_path('resources/blueprints/collections/careers/')))
        mkdir(base_path('resources/blueprints/collections/careers/'), 0770, true);

    app('files')->put(base_path('resources/blueprints/collections/careers/career.yaml'), $careerCollection);

    $collection = Collection::make('careers');
    $collection
        ->title('Careers')
        ->dated(true)
        ->template('default')
        ->layout('layout')
        ->revisionsEnabled(false)
        ->sortDirection('asc')
        ->save();

    return 'Hello from the career form package 4';
});


