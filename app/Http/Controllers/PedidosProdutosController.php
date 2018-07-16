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
use App\Models\Produtos;
use App\Helpers\Discount;
use Illuminate\Http\Request;
use App\Models\PedidosProdutos;
use Illuminate\Database\Eloquent\ModelNotFoundException;
//-------------------------------------------------
class PedidosProdutosController extends Controller
{
    public function index(Request $request, $pedido){
        try
        {
            Pedidos::findOrFail($pedido);

            $rest = new Rest();
            $rest->model = 'App\Models\PedidosProdutos';
            $rest->input = $request->toArray();
            $rest->relation = false;

            $builder = $rest->getBuilder();
            $builder->where('pedido_id', $pedido);

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
    public function show(Request $request, $pedido, $id){
        try
        {
            Pedidos::findOrFail($pedido);

            $rest = new Rest();
            $rest->model = 'App\Models\PedidosProdutos';
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
    public function store(Request $request, $pedido){
        $result = new Result();
        $response = [];
        $response['records'] = [];
        try
        {
            $pedidoModel = Pedidos::findOrFail($pedido);
            $newresource = $request->toarray();

            foreach($newresource['records'] as $pedidos)
            {
                $builder = PedidosProdutos::query();
                $builder = $builder->where('codbarras', $pedidos['codbarras']);
                $builder = $builder->where('pedido_id', $pedido);
                $recurso = $builder->get();

                if(!$recurso->isEmpty())
                {
                    if(array_key_exists('quantidade', $pedidos))
                        $recurso[0]->quantidade = $recurso[0]->quantidade + $pedidos['quantidade'];
                    else
                        $recurso[0]->quantidade++;

                    array_push($response['records'], Discount::descontoParcial($pedidoModel, $recurso[0]));
                }
                else
                {
                    $builder = Produtos::query();
                    $builder = $builder->where('codbarras', $pedidos['codbarras']);
                    $builder = $builder->with(['marca','unidades_medida','dados_fiscal']);
                    $produto = $builder->get()[0];

                    $recurso = new PedidosProdutos();

                    $recurso->pedido_id = $pedido;
                    $recurso->desconto = 0;

                    if(array_key_exists('quantidade', $pedidos))
                        $recurso->quantidade = $pedidos['quantidade'];
                    else
                        $recurso->quantidade = 1;

                    $recurso->produto_id = $produto->id;
                    $recurso->codbarras = $produto->codbarras;
                    $recurso->nome = $produto->nome;
                    $recurso->marca = $produto->marca->descricao;
                    $recurso->unidade_medida = $produto->unidades_medida->descricao;
                    $recurso->preco_compra = $produto->preco_compra;
                    $recurso->preco_venda = $produto->preco_venda;
                    $recurso->preco = $produto->preco_venda;
                    $recurso->ncm = $produto->dados_fiscal->ncm;
                    $recurso->cfop = $produto->dados_fiscal->cfop;
                    
                    array_push($response['records'], Discount::descontoParcial($pedidoModel, $recurso));
                }
            }
            $result = new Result();
            $result->setCode(200);
            $result->internalMessage ="Produto inserido com sucesso";

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
        catch(Exception $e)
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
    public function update(Request $request, $pedido, $id){
        $result = new Result();
        $response = [];

        try
        {
            $pedidoModel = Pedidos::findOrFail($pedido);
            try
            {
                $recurso = PedidosProdutos::findOrFail($id);
                if($recurso->pedido_id == $pedido)
                {
                    $newresource = $request->toarray();

                    if(array_key_exists('desconto',$newresource))
                        $recurso->desconto = $newresource['desconto'];
                    else if(array_key_exists('quantidade',$newresource))
                        $recurso->quantidade = $newresource['quantidade'];
                    else
                        throw new Exception("Parametros inválidos", 400);

                    $response['records'] = Discount::descontoParcial($pedidoModel, $recurso);

                    $result->setCode(200);
                    $result->internalMessage = "Produto alterado com sucesso";

                    $response['result'] = $result;

                    return Response::json($response, $result->code);
                }
                else
                {
                    throw new ModelNotFoundException('Item does not belongs to Pedidos');
                }
            }
            catch(ModelNotFoundException $e)
            {
                $response = [];

                $result->setCode(404);
                $result->internalMessage = $e->getMessage();

                $response['result'] = $result;

                return Response::json($response, $result->code);
            }
            catch(Exception $e)
            {
                $response = [];

                $result->setCode(500);
                $result->internalMessage = $e->getMessage();

                $response['result'] = $result;

                return Response::json($response, $result->code);
            }
        }

        catch(ModelNotFoundException $e)
        {
            $response = [];

            $result->setCode(404);
            $result->internalMessage = $e->getMessage();

            $response['result'] = $result;

            return Response::json($response, $result->code);
        }
    }
//-------------------------------------------------
    public function destroy($pedido, $id){
        $result = new Result();
        $response = [];

        try
        {
            Pedidos::findOrFail($pedido);

            try
            {
                $recurso = PedidosProdutos::findOrFail($id);
                
                if($recurso->pedido_id == $pedido)
                {
                    $recurso->delete();
                        
                    $result->setCode(200);
                    $result->internalMessage = 'Record deleted successfully';

                    $response['result'] = $result;

                    return Response::json($response, $result->code);
                }

                else
                {
                    throw new ModelNotFoundException('Item does not belongs to Pedidos');
                }
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

        catch(ModelNotFoundException $e)
        {
            $result->setCode(404);
            $result->internalMessage = $e->getMessage();

            $response['result'] = $result;

            return Response::json($response, $result->code);
        }
    }
//-------------------------------------------------
}
