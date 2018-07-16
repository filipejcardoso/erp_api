<?php
namespace App\Http\Controllers;
//-------------------------------------------------
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Associados;
use App\Helpers\Rest;
use App\Helpers\Result;
use Response;
use Input;
//-------------------------------------------------
trait AssociadosController 
{
    public function store(Request $request){
        $recurso = new Associados();
        $newresource = $request->toarray();
        
        $rest = new Rest();
        $rest->model = 'App\Models\Associados';
        $rest->input = $newresource;
        $rest->instance = $recurso;

        $response = $rest->insert();
        $result = $response['result'];

        return Response::json($response, $result->code);
    }
//-------------------------------------------------
    public function update(Request $request, $id){
        try
        {
            $recurso = Associados::findOrFail($id);
            $newresource = $request->toarray();
            
            $rest = new Rest();
            $rest->model = 'App\Models\Associados';
            $rest->input = $newresource;
            $rest->instance = $recurso;
            
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
    }
//-------------------------------------------------
    public function destroy($id){
        $result = new Result();
        $response = [];

        try
        {
            $recurso = Associados::findOrFail($id);
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
}