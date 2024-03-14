<?php

namespace Astricelng\Careerform\Console;

use Illuminate\Console\Command;
use Statamic\Facades\AssetContainer;
use Statamic\Facades\Form;
use Statamic\Facades\Collection;

class InstallCareerPackage extends Command
{
    protected $signature = 'careerpackage:install';

    protected $description = 'Install the CareerPackage';

    public function handle()
    {
        $this->info('Installing CareerPackage...');

        $this->info('Creating career assets folder...');
        $this->createCareerAssetsFolder();

        $this->info('Copying career form blueprint...');
        $this->copyCareerFormBlueprint();

        $this->info('Creating career form...');
        $this->createCareerForm();

        $this->info('Copying career collection blueprint...');
        $this->copyCareerCollectionBlueprint();

        $this->info('Creating career collection...');
        $this->createCareerCollection();


        $this->info('Installed CareerPackage');
    }

    private function createCareerAssetsFolder(){
        $files = AssetContainer::find('files');

        if ($files === null)
            $files = AssetContainer::make('files');

        $files->assetFolder('career')->save();
    }

    private function copyCareerFormBlueprint(){

        $careerForm = app('files')->get(__DIR__ . '/../templates/blueprints/forms/career.yaml');

        // If forms directory doesn't exist, create it
        if (!file_exists(base_path('resources/blueprints/forms/')))
            mkdir(base_path('resources/blueprints/forms/'), 0770, true);

        app('files')->put(base_path('resources/blueprints/forms/career.yaml'), $careerForm);
    }

    private function createCareerForm(){
        // Create career form
        $form = Form::make()->handle('career');
        $form
            ->handle('career')
            ->honeypot('fax')
            ->title('Career')
            ->save();
    }

    private function copyCareerCollectionBlueprint(){

        $careerCollection = app('files')->get(__DIR__ . '/../templates/blueprints/collections/career.yaml');

        // If collections/careers directory doesn't exist, create it
        if (!file_exists(base_path('resources/blueprints/collections/careers/')))
            mkdir(base_path('resources/blueprints/collections/careers/'), 0770, true);

        app('files')->put(base_path('resources/blueprints/collections/careers/career.yaml'), $careerCollection);
    }

    private function createCareerCollection(){

        $collection = Collection::make('careers');
        $collection
            ->title('Careers')
            ->dated(true)
            ->template('default')
            ->layout('layout')
            ->revisionsEnabled(false)
            ->sortDirection('asc')
            ->save();
    }

}
