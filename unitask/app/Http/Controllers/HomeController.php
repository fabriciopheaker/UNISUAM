<?php

namespace App\Http\Controllers;

use App\Http\Resources\FollowersResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use PhpParser\Node\Expr\FuncCall;
use stdClass;

class HomeController extends Controller
{

    public function __construct(private LogController $log) {}

    public function index()
    {
        return Inertia::render('app');
    }


    public function show(Request $request, string $User)
    {
        $ipAddress = $request->ip();
        $github = Http::get("https://api.github.com/users/$User");


        // quando tiver error no github ou não existir usuario
        if ($github->status() != 200) {
            $response = $this->objectResponse('Error', 'Whoops Aconteceu algum error');
            $dadosLog = $this->processData($User, $ipAddress, $request->url(), json_encode($response));
            $this->log->store($dadosLog);
            return response()->json($response);
        }


        //transforma em objeto
        $github = $github->object();

        //tratamento do response
        $github = new UserResource($github);
        $github = $github->toArray(request());

        // trata e registra log
        $dadosLog = $this->processData($User, $ipAddress, $request->url(), json_encode($github));
        $this->log->store($dadosLog);

        // return view/component vue
        return Inertia::render('HomeUsers', [
            'User' => $github
        ]);
    }




    public function getfollowers(Request $request, string $User): JsonResponse
    {
        $ipAddress = $request->ip();
        $github = Http::get("https://api.github.com/users/$User/followers");

        // quando tiver error no github ou não existir usuario
        if ($github->status() != 200) {
            $response = $this->objectResponse('Error', 'Whoops Aconteceu algum error');
            $dadosLog = $this->processData($User, $ipAddress, $request->url(), json_encode($response));
            $this->log->store($dadosLog);
            return response()->json($response);
        }


        //transforma em objeto
        $github = $github->object();
        //tratamento do response
        $github = FollowersResource::collection($github);
        $github = $github->toArray(request());

        // trata e registra log
        $dadosLog = $this->processData($User, $ipAddress, $request->url(), json_encode($github));
        $this->log->store($dadosLog);


        return response()->json($github);
    }

    public function getfollowing(Request $request, string $User): JsonResponse
    {
        $ipAddress = $request->ip();
        $github = Http::get("https://api.github.com/users/$User/following");

        if ($github->status() != 200) {
            $response = $this->objectResponse('Error', 'Whoops Aconteceu algum error');
            $dadosLog = $this->processData($User, $ipAddress, $request->url(), json_encode($response));
            $this->log->store($dadosLog);
            return response()->json($response);
        }
        //transforma em objeto
        $github = $github->object();
        //tratamento do response
        $github = FollowersResource::collection($github);
        $github = $github->toArray(request());

        // trata e registra log
        $dadosLog = $this->processData($User, $ipAddress, $request->url(), json_encode($github));
        $this->log->store($dadosLog);


        return response()->json($github);
    }

    public function objectResponse(String $status, String $message): object
    {
        $obj = new stdClass();
        $obj->Status =  $status;
        $obj->Message = $message;
        return $obj;
    }

    public function processData($nome, $ip, $request, $githubResponse): array
    {
        return [
            'NOME' => $nome,
            'IP_REQUEST' => $ip,
            'REQUEST' => $request,
            'RESPONSE' => $githubResponse,
        ];
    }
}
