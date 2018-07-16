<?php
namespace App\Http\Controllers;
//-------------------------------------------------
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Associados;
use App\Models\Contatos;
use App\Helpers\Rest;
use App\Helpers\Result;
use Response;
use Input;
//-------------------------------------------------
class ContatosController extends Controller
{
    public function index(Request $request, $associado){
        try
        {
            Associados::findOrFail($associado);

            $rest = new Rest();
            $rest->model = 'App\Models\Contatos';
            $rest->input = $request->toArray();

            $builder = $rest->getBuilder();
            $builder->where('associado_id', $associado);

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

            return Response::json($response, $response['result']->code);
        }
    }
//-------------------------------------------------
    public function show(Request $request, $associado, $id){
        try
        {
            Associados::findOrFail($associado);

            $rest = new Rest();
            $rest->model = 'App\Models\Contatos';
            $rest->input = $request->toArray();

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
    public function store(Request $request, $associado){
        try
        {
            Associados::findOrFail($associado);
            
            $recurso = new Contatos();
            $newresource = $request->toarray();
            
            $rest = new Rest();
            $rest->model = 'App\Models\Contatos';
            $rest->input = $newresource;
            $rest->instance = $recurso;
            $rest->instance['associado_id'] = $associado;

            $response = $rest->insert();
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
    public function update(Request $request, $associado, $id){
        $result = new Result();

        try
        {
            Associados::findOrFail($associado);

            try
            {
                $recurso = Contatos::findOrFail($id);

                if($recurso->associado_id == $associado)
                {
                    $newresource = $request->toarray();
                    
                    $rest = new Rest();
                    $rest->model = 'App\Models\Contatos';
                    $rest->input = $newresource;
                    $rest->instance = $recurso;
                    
                    $response = $rest->renew();
                    $result = $response['result'];

                    return Response::json($response, $result->code);
                }

                else
                {
                    throw new ModelNotFoundException('Contato does not belongs to Associados');
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
    public function destroy($associado, $id){
        $result = new Result();
        $response = [];

        try
        {
            Associados::findOrFail($associado);

            try
            {
                $recurso = Contatos::findOrFail($id);
                
                if($recurso->associado_id == $associado)
                {
                    $recurso->delete();
                        
                    $result->setCode(200);
                    $result->internalMessage = 'Record deleted successfully';

                    $response['result'] = $result;

                    return Response::json($response, $result->code);
                }

                else
                {
                    throw new ModelNotFoundException('Contato does not belongs to Associados');
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
