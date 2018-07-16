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
use App\Models\Pagamentos;
use App\Models\Vendas;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
//-------------------------------------------------
class PagamentosController extends Controller
{
    public function index(Request $request, $venda){
        try
        {
            Vendas::findOrFail($venda);

            $rest = new Rest();
            $rest->model = 'App\Models\Pagamentos';
            $rest->input = $request->toArray();
            $rest->relation = false;

            $builder = $rest->getBuilder();
            $builder->where('venda_id', $venda);

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
    public function show(Request $request, $venda, $id){
        try
        {
            Vendas::findOrFail($venda);

            $rest = new Rest();
            $rest->model = 'App\Models\Pagamentos';
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
