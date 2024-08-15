<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{



    public function home(): View
    {
        return View('welcome');
    }


    public function getUser($User)
    {

        print_r($User);
    }
}
