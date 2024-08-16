<?php

namespace App\Http\Controllers;

use App\Http\Resources\FollowersResource;
use App\Http\Resources\UserResource;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use stdClass;

class HomeController extends Controller
{





    public function index()
    {
        return Inertia::render('app');
    }


    public function show(Request $request, string $User)
    {
        $ipAddress = $request->ip();
        $nomeGit = $this->validator($User);

        if (! $nomeGit) {
            $response = $this->objectResponse('Error', 'Nome de usuário não encontrado');
            return response()->json($response);
        }

        $github = Http::get("https://api.github.com/users/$User");

        if ($github->status() != 200) {
            $response = $this->objectResponse('Error', 'Usuário não encontrado ou problemas no servidor');
            return response()->json($response);
        }


        $github = $github->object();
        $githubData = new UserResource($github);
        $githubData = $githubData->toArray(request());

        return Inertia::render('HomeUsers', [
            'User' => $githubData
        ]);
    }

    public function getfollowers(Request $request, string $User): JsonResponse
    {

        $ipAddress = $request->ip();




        $github = Http::get("https://api.github.com/users/$User/followers");
        if ($github->status() != 200) {
            return response()->json();
        }
        $github = $github->object();
        $githubData = FollowersResource::collection($github);
        $githubData = $githubData->toArray(request());

        return response()->json($githubData);
    }

    public function getfollowing(Request $request, string $User): JsonResponse
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


    public function validator(string $param): bool
    {
        if (!isset($param) && empty($param)) {
            return false;
        }
        return true;
    }

    public function objectResponse(String $status, String $message): object
    {
        $obj = new stdClass();
        $obj->Status =  $status;
        $obj->Message = $message;
        return $obj;
    }
}
