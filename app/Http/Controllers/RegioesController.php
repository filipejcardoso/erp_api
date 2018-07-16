<?php
namespace App\Http\Controllers;
//-------------------------------------------------
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Regioes;
use App\Helpers\Rest;
use App\Helpers\Result;
use Response;
use Input;
//-------------------------------------------------
class RegioesController extends Controller
{
    public function index(Request $request){
        $rest = new Rest();
        $rest->model = 'App\Models\Regioes';
        $rest->input = $request->toArray();

        $response = $rest->getCollection('get', null);
        $result = $response['result'];

        return Response::json($response, $result->code);
    }
//-------------------------------------------------
    public function show(Request $request, $id){
        $rest = new Rest();
        $rest->model = 'App\Models\Regioes';
        $rest->input = $request->toArray();

        $response = $rest->getCollection('find', $id);
        $result = $response['result'];

        return Response::json($response, $result->code);
    }
//-------------------------------------------------
    public function store(Request $request){
        $recurso = new Regioes();
        $newresource = $request->toarray();
        
        $rest = new Rest();
        $rest->model = 'App\Models\Regioes';
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
            $recurso = Regioes::findOrFail($id);
            $newresource = $request->toarray();
            
            $rest = new Rest();
            $rest->model = 'App\Models\Regioes';
            $rest->input = $newresource;
            $rest->instance = $recurso;
            
            $response = $rest->renew();
            $result = $response['result'];

            return Response::json($response, $result->code);
        }

        catch(ModelNotFoundException $e)
        {
            $result = new Result();
            $result->setCode(404);
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
            $recurso = Regioes::findOrFail($id);
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
