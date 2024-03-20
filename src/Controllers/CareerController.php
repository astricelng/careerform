<?php
namespace Astricelng\Careerform\Controllers;

use Illuminate\Http\Request;


class CareerController
{
    public function __invoke()
    {
        $test = 'prueba';
        return view('careerform::index', compact('test'));
    }
}
