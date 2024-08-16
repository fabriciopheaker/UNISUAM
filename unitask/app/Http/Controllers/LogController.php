<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{

    public function __construct(private Log $LogModel) {}



    public function store() {}



    public function validator(string $param): bool
    {
        if (!isset($param) && empty($param)) {
            return false;
        }
        return true;
    }
}
