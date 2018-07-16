<?php
namespace App\Http\Controllers;
//-------------------------------------------------
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Empresas;
use App\Models\Enderecos;
use App\Helpers\Rest;
use App\Helpers\Result;
use App\Helpers\MaskBits;
use Response;
use Input;
use Exception;
//-------------------------------------------------
class EmpresasController extends Controller
{
    public function show(Request $request){
        $rest = new Rest();
        $rest->model = 'App\Models\Empresas';
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
            $empresa = Empresas::findOrFail($id);
            $endereco = Enderecos::findOrFail($empresa->endereco->id);
            $empresaArray = $request->toarray();

            $enderecoArray['records']  = [];
            array_push($enderecoArray['records'], $empresaArray['records'][0]['endereco']);

            $rest = new Rest();
            $rest->model = 'App\Models\Enderecos';
            $rest->input = $enderecoArray;
            $rest->instance = $endereco;
            $rest->renew();
            
            $empresa = Empresas::findOrFail($id);

            $rest = new Rest();
            $rest->model = 'App\Models\Empresas';
            $rest->input = $empresaArray;
            $rest->instance = $empresa;
            
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
