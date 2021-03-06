<?php

namespace App\Http\Controllers;

//-------------------------------------------------
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\GruposAssociados;
use App\Helpers\Rest;
use App\Helpers\Result;
use Response;
use Input;
//-------------------------------------------------
class GruposAssociadosController extends Controller
{
    public function index(Request $request){
        $rest = new Rest();
        $rest->model = 'App\Models\GruposAssociados';
        $rest->input = $request->toArray();

        $response = $rest->getCollection('paginate', null);
        $result = $response['result'];

        return Response::json($response, $result->code);
    }
//-------------------------------------------------
    public function show(Request $request, $id){
        $rest = new Rest();
        $rest->model = 'App\Models\GruposAssociados';
        $rest->input = $request->toArray();

        $response = $rest->getCollection('find', $id);
        $result = $response['result'];

        return Response::json($response, $result->code);
    }
//-------------------------------------------------
    public function store(Request $request){
        $recurso = new GruposAssociados();
        $newresource = $request->toarray();
        
        $rest = new Rest();
        $rest->model = 'App\Models\GruposAssociados';
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
            $recurso = GruposAssociados::findOrFail($id);
            $newresource = $request->toarray();
            
            $rest = new Rest();
            $rest->model = 'App\Models\GruposAssociados';
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
            $recurso = GruposAssociados::findOrFail($id);
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
