<?php

namespace App\Http\Controllers;
//-------------------------------------------------
use Input;
use JWTAuth;
use Response;
use Exception;
use App\Models\User;
use App\Helpers\Rest;
use App\Helpers\Result;
use App\Models\Caixas;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
//-------------------------------------------------
class CaixasController extends Controller
{
    public function index(Request $request){
        $rest = new Rest();
        $rest->model = 'App\Models\Caixas';
        $rest->input = $request->toArray();

        $response = $rest->getCollection('paginate', null);
        $result = $response['result'];

        return Response::json($response, $result->code);
    }
//-------------------------------------------------
    public function show(Request $request, $id){
        $rest = new Rest();
        $rest->model = 'App\Models\Caixas';
        $rest->input = $request->toArray();

        $response = $rest->getCollection('find', $id);
        $result = $response['result'];

        return Response::json($response, $result->code);
    }}
