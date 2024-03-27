<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CareerController extends Controller
{

    public function index(Request $request)
    {
        $entries = \Statamic\Facades\Collection::find('careers')->queryEntries()->where('published', true)->get();

        $careers = $entries->map(function ($entry) {
            return $entry
                ->toAugmentedCollection(['id', 'title', 'description', 'vacancy', 'slug'])
                ->withShallowNesting()
                ->toArray();
        });

        return json_encode(['data' => $careers]);
    }
}
