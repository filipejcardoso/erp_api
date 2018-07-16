<?php
namespace App\Http\Controllers;
//-------------------------------------------------
use Input;
use Response;
use Exception;
use App\Helpers\Rest;
use App\Models\Papels;
use App\Helpers\Result;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
//-------------------------------------------------
class PapelsController extends Controller
{
    public function index(Request $request){
        $rest = new Rest();
        $rest->model = 'App\Models\Papels';
        $rest->input = $request->toArray();

        $response = $rest->getCollection('paginate', null);
        $result = $response['result'];

        return Response::json($response, $result->code);
    }
//-------------------------------------------------
    public function show(Request $request, $id){
        $rest = new Rest();
        $rest->model = 'App\Models\Papels';
        $rest->input = $request->toArray();

        $response = $rest->getCollection('find', $id);
        $result = $response['result'];

        return Response::json($response, $result->code);
    }
//-------------------------------------------------
    public function store(Request $request){
        $response = [];

        $result = new Result();
        $recurso = new Papels();

        $newresource = $request->toarray();
        
        $recurso->nome = $newresource['nome'];
        $recurso->desconto = $newresource['desconto'];
        $recurso->save();

        $result->setCode(201);
        $result->internalMessage = 'Papel criado';

        $response['records'] = $recurso;
        $response['result'] = $result;

        return Response::json($response, $result->code);
    }
//-------------------------------------------------
    public function update(Request $request, $id){
        $response = [];

        $result = new Result();

        try
        {
            $recurso = Papels::findOrFail($id);
            $newresource = $request->toarray();
            
            if(array_key_exists('nome', $newresource))
            	$recurso->nome = $newresource['nome'];
            if(array_key_exists('desconto', $newresource))
            	$recurso->desconto = $newresource['desconto'];
            else
            	throw new Exception('Parametros invalidos');
            
            $recurso->save();

            $result->setCode(202);
            $result->internalMessage = 'Papel atualizado';

            $response['records'] = $recurso;
            $response['results'] = $result;

            return Response::json($response, $result->code);
        }

        catch(ModelNotFoundException $e)
        {
            $result->setCode(404);
            $result->internalMessage = $e->getMessage();
            return Response::json($result, $result->code);
        }

        catch(Exception $e)
        {
        	$result->setCode(500);
        	$result->internalMessage = $e->getMessage();
            return Response::json($result, $result->code);	
        }
    }
//-------------------------------------------------
    public function destroy($id){
        $result = new Result();
        $response = [];

        try
        {
            $recurso = Papels::findOrFail($id);
            $recurso->delete();
                
            $result->setCode(200);
            $result->internalMessage = 'Record deleted successfully';

            $response['result'] = $result;

            return Response::json($response, $response['result']->code);
        }

        catch(ModelNotFoundException $e)
        {
            $result->setCode(404);
            $result->internalMessage = $e->getMessage();

            $response['result'] = $result;


            return Response::json($response, $response['result']->code);
        }

        catch (Exception $e)
        {
            $result->setCode(500);
            $result->internalMessage = $e->getMessage();

            $response['result'] = $result;

            return Response::json($response, $response['result']->code);
        }
    }
//-------------------------------------------------
}