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
use App\Models\Vendas;
use App\Models\Caixas;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
//-------------------------------------------------
class VendasController extends Controller
{
    public function index(Request $request){
        $rest = new Rest();
        $rest->model = 'App\Models\Vendas';
        $rest->input = $request->toArray();

        $response = $rest->getCollection('paginate', null);
        $result = $response['result'];

        return Response::json($response, $result->code);
    }
//-------------------------------------------------
    public function show(Request $request, $id){
        $rest = new Rest();
        $rest->model = 'App\Models\Vendas';
        $rest->input = $request->toArray();

        $response = $rest->getCollection('find', $id);
        $result = $response['result'];

        return Response::json($response, $result->code);
    }
//-------------------------------------------------
    public function indexCaixa(Request $request, $caixa){
        try
        {
            Caixas::findOrFail($caixa);

            $rest = new Rest();
            $rest->model = 'App\Models\Vendas';
            $rest->input = $request->toArray();
            $rest->relation = false;

            $builder = $rest->getBuilder();
            $builder->where('caixa_id', $caixa);

            $response = $rest->getCollection('paginate', null);
            
            $result = $response['result'];

            return Response::json($response, $result->code);
        }

        catch(ModelNotFoundException $e)
        {
            $response = [];

            $result = new Result();
            $result->setCode(404);
            $result->internalMessage = $e->getMessage();

            $response['result'] = $result;

            return Response::json($response, $result->code);
        }
    }
//-------------------------------------------------
    public function showCaixa(Request $request, $caixa, $id){
        try
        {
            Caixas::findOrFail($caixa);

            $rest = new Rest();
            $rest->model = 'App\Models\Vendas';
            $rest->input = $request->toArray();
            $rest->relation = false;

            $response = $rest->getCollection('find', $id);
            $result = $response['result'];

            return Response::json($response, $result->code);
        }

        catch(ModelNotFoundException $e)
        {
            $response = [];

            $result = new Result();
            $result->setCode(404);
            $result->internalMessage = $e->getMessage();

            $response['result'] = $result;

            return Response::json($response, $result->code);
        }
    }
//-------------------------------------------------
}
