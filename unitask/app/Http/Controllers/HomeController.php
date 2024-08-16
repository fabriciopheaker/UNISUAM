<?php

namespace App\Http\Controllers;

use App\Http\Resources\FollowersResource;
use App\Http\Resources\UserResource;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use stdClass;

class HomeController extends Controller
{



    public function index()
    {
        return Inertia::render('app');
    }


    public function show($User)
    {
        // 404 - 200
        $github = Http::get("https://api.github.com/users/$User");

        if ($github->status() != 200) {
            // codigo de error
        }
        $github = $github->object();
        $githubData = new UserResource($github);
        $githubData = $githubData->toArray(request());

        return Inertia::render('HomeUsers', [
            'User' => $githubData
        ]);
    }

    public function getfollowers($User): JsonResponse
    {

        $github = Http::get("https://api.github.com/users/$User/followers");
        if ($github->status() != 200) {
            // codigo de error
        }
        $github = $github->object();
        $githubData = FollowersResource::collection($github);
        $githubData = $githubData->toArray(request());

        return response()->json($githubData);
    }

    public function getfollowing($User): JsonResponse
    {

        $github = Http::get("https://api.github.com/users/$User/following");
        if ($github->status() != 200) {
            // codigo de error
        }
        $github = $github->object();
        $githubData = FollowersResource::collection($github);
        $githubData = $githubData->toArray(request());

        return response()->json($githubData);
    }




    public function validator($param): bool
    {
        if (!isset($param) && empty($param)) {
            return false;
        }
        return true;
    }
}
