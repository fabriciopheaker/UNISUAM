<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{



    public function index()
    {
        return Inertia::render('app');
    }


    public function getUser($User)
    {
        return Inertia::render('HomeUsers');
    }
}
