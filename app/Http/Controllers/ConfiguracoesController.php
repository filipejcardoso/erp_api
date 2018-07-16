<?php
namespace App\Http\Controllers;
//-------------------------------------------------
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Configuracoes;
use App\Models\ConfigPedidos;
use App\Helpers\Rest;
use App\Helpers\Result;
use App\Helpers\MaskBits;
use Response;
use Input;
use Exception;
//-------------------------------------------------
class ConfiguracoesController extends Controller
{
    public function show(Request $request){
        $rest = new Rest();
        $rest->model = 'App\Models\Configuracoes';
        $rest->input = $request->toArray();

        $builder = $rest->getBuilder();
        $response = $rest->getCollection('get', null);
        $result = $response['result'];

        return Response::json($response, $result->code);
    }
//-------------------------------------------------
    public function update(Request $request, $id){
        try
        {
            $configuracao = Configuracoes::findOrFail($id);
            $config_pedido = ConfigPedidos::findOrFail($configuracao->config_pedido->id);
            $configuracaoArray = $request->toarray();

            $config_pedidoArray['records']  = [];
            array_push($config_pedidoArray['records'], $configuracaoArray['records'][0]['config_pedido']);

            $rest = new Rest();
            $rest->model = 'App\Models\ConfigPedidos';
            $rest->input = $config_pedidoArray;
            $rest->instance = $config_pedido;
            $response = $rest->renew();

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

            return Response::json($response, $response['result']->code);
        }
        catch(Exception $e)
        {
            $response = [];

            $result = new Result();
            $result->setCode(500);
            $result->internalMessage = $e->getMessage();

            $response['result'] = $result;

            return Response::json($response, $response['result']->code);
        }
    }
//-------------------------------------------------
}
