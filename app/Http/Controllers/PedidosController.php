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
use App\Models\Pedidos;
use App\Helpers\Discount;
use Illuminate\Http\Request;
use App\Models\Configuracoes;
use App\Models\PedidosProdutos;
use Illuminate\Database\Eloquent\ModelNotFoundException;
//-------------------------------------------------
class PedidosController extends Controller
{
    public function index(Request $request){
        $rest = new Rest();
        $rest->model = 'App\Models\Pedidos';
        $rest->input = $request->toArray();

        $response = $rest->getCollection('paginate', null);
        $result = $response['result'];

        return Response::json($response, $result->code);
    }
//-------------------------------------------------
    public function show(Request $request, $id){
        $rest = new Rest();
        $rest->model = 'App\Models\Pedidos';
        $rest->input = $request->toArray();

        $response = $rest->getCollection('find', $id);
        $result = $response['result'];

        $pedidos_produtos = $response['records']['pedidos_produto'];
        $venda = 0;
        $compra = 0;
        foreach ($pedidos_produtos as $key => $produto) 
        {
            $venda = $venda + $produto['preco'];
            $compra = $compra + $produto['preco_compra']*$produto['quantidade'];
        }
        if($compra!=0)
        {
            $contribuicao = (($venda - $compra)/$compra)*100;
            $nfe = (($venda*0.893 - $compra)/$compra)*100;
        }
        else
        {
            $contribuicao = 0;
            $nfe = 0;
        }

        $response['records']['margem_contribuicao'] = number_format((float)$contribuicao, 2, '.', '');
        $response['records']['margem_nfe'] = number_format((float)$nfe, 2, '.', '');

        return Response::json($response, $result->code);
    }
//-------------------------------------------------
    public function store(Request $request){
        try
        {
	        $token = JWTAuth::getToken();
	        $user_id = JWTAuth::manager()->decode($token, false)->get('sub');
	        $user = User::findOrFail($user_id);
            $configuracao = Configuracoes::all();

	        $recurso = new Pedidos();
	        $recurso->status = 0;
	        $recurso->atendente = $user->id;
            $recurso->cliente = $configuracao[0]->config_pedido->associado->id;
	        $recurso->save();

	        $response = [];

            $rest = new Rest();
            $rest->model = 'App\Models\Pedidos';
            $rest->input = [];

            $responseAux = $rest->getCollection('find', $recurso->id);
            $response['records'] = $responseAux['records'];

	        $result = new Result;
	        $result->setCode(201);
	        $result->internalMessage = 'Pedido parcialmente criado';

	        $response['result'] = $result;

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
    public function update(Request $request, $id){
        $result = new Result();
        $response = [];

        try
        {
            $recurso = Pedidos::findOrFail($id);

            if($recurso->status)
            {
                $result->setCode(403);
                $result->internalMessage = "Pedido ja esta finalizado";

                $response['result'] = $result;

                return Response::json($response, $result->code);
            }

            $newresource = $request->toarray();
            
            if(array_key_exists('desconto',$newresource))
            {
                if(array_key_exists('tipo',$newresource))
                    $tipo = $newresource['tipo'];
                else
                    $tipo = 0;

                $recurso->desconto = $newresource['desconto'];
                Discount::setDescontoTotal($recurso, $tipo);
            }
            else if(array_key_exists('status',$newresource))
                $recurso->status = $newresource['status'];
            else if(array_key_exists('atendente',$newresource))
                $recurso->atendente = $newresource['atendente'];
            else if(array_key_exists('cliente',$newresource))
                $recurso->cliente = $newresource['cliente'];
            else if(array_key_exists('observacao',$newresource))
                $recurso->observacao = $newresource['observacao'];
            else
                throw new Exception("Parametros inválidos", 400);

            $recurso->save();
            $response['records'] = $recurso;

            $result->setCode(202);
            $result->internalMessage = "Orçamento alterado";

            $response['result'] = $result;

            return Response::json($response, $result->code);
        }
        catch(ModelNotFoundException $e)
        {
            $result->setCode(404);
            $result->internalMessage = $e->getMessage();

            $response['result'] = $result;

            return Response::json($response, $result->code);
        }
        catch(Exception $e)
        {
            $result->setCode(500);
            $result->internalMessage = $e->getMessage();

            $response['result'] = $result;

            return Response::json($response, $result->code);
        }
    }
//-------------------------------------------------
    public function destroy(Request $request, $id){
        $result = new Result();
        $response = [];

        $input = $request->toArray();

        try
        {
            $recurso = Pedidos::findOrFail($id);

            if($recurso->status)
            {
                $result->setCode(403);
                $result->internalMessage = "Pedido ja esta finalizado";

                $response['result'] = $result;

                return Response::json($response, $result->code);
            }
            
            if(!array_key_exists('empty',$input))
                $recurso->delete();
            else
            {
                $builder = PedidosProdutos::query();
                
                $builder->where('pedido_id',$id);

                $produtos = $builder->get();

                if($produtos->isEmpty())
                    $recurso->delete();
                else
                {
                    $result->setCode(400);
                    $result->internalMessage = 'Nao deletado, pedido possui produtos';

                    $response['result'] = $result;

                    return Response::json($response, $result->code);
                }
            }
                
            $result->setCode(200);
            $result->internalMessage = 'Record deleted successfully';

            $response['result'] = $result;

            return Response::json($response, $result->code);
        }
        catch(ModelNotFoundException $e)
        {
            $result->setCode(404);
            $result->internalMessage = $e->getMessage();

            $response['result'] = $result;


            return Response::json($response, $result->code);
        }

        catch (Exception $e)
        {
            $result->setCode(500);
            $result->internalMessage = $e->getMessage();

            $response['result'] = $result;

            return Response::json($response, $result->code);
        }
    }
//-------------------------------------------------
}
