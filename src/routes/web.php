<?php

use Illuminate\Support\Facades\Route;

use Statamic\Facades\AssetContainer;
use Statamic\Facades\Form;
use Statamic\Facades\Collection;

Route::get('career', function(){

    // Check if files container exists, if not create it
    // Create career folder within files container
    $files = AssetContainer::find('files');
    if ($files === null)
        $files = AssetContainer::make('files');

    $files->assetFolder('career')->save();

    // Copy career form blueprint to project
    $careerForm = app('files')->get(__DIR__ . '/../templates/blueprints/forms/career.yaml');

    // If forms directory doesn't exist, create it
    if (!file_exists(base_path('resources/blueprints/forms/')))
        mkdir(base_path('resources/blueprints/forms/'), 0770, true);

    app('files')->put(base_path('resources/blueprints/forms/career.yaml'), $careerForm);

    // Create career form
    $form = Form::make()->handle('career');
    $form
        ->handle('career')
        ->honeypot('fax')
        ->title('Career')
        ->save();

    // Copy career collection blueprint to project
    $careerCollection = app('files')->get(__DIR__ . '/../templates/blueprints/collections/career.yaml');

    // If collections/careers directory doesn't exist, create it
    if (!file_exists(base_path('resources/blueprints/collections/careers/')))
        mkdir(base_path('resources/blueprints/collections/careers/'), 0770, true);

    app('files')->put(base_path('resources/blueprints/collections/careers/career.yaml'), $careerCollection);

    // Create career collection
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


