<?php
namespace App\Http\Controllers;
//-------------------------------------------------
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Categorias;
use App\Models\Subcategorias;
use App\Helpers\Rest;
use App\Helpers\Result;
use Response;
use Input;
//-------------------------------------------------
class SubcategoriasController extends Controller
{
    public function index(Request $request, $categoria){
        try
        {
            Categorias::findOrFail($categoria);

            $rest = new Rest();
            $rest->model = 'App\Models\Subcategorias';
            $rest->input = $request->toArray();
            $rest->relation = false;

            $builder = $rest->getBuilder();
            $builder = $builder->whereHas('categoria', function ($query) use ($categoria){            
                $query->where('id', $categoria);
            });

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
    public function show(Request $request, $categoria, $id){
        try
        {
            Categorias::findOrFail($categoria);

            $rest = new Rest();
            $rest->model = 'App\Models\Subcategorias';
            $rest->input = $request->toArray();

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
    public function store(Request $request, $categoria){
        try
        {
            Categorias::findOrFail($categoria);

            $recurso = new Subcategorias();
            $newresource = $request->toarray();
            
            $rest = new Rest();
            $rest->model = 'App\Models\Subcategorias';
            $rest->input = $newresource;
            $rest->instance = $recurso;
            $rest->instance['categoria_id'] = $categoria;

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

            return Response::json($response, $response['result']->code);
        }
    }
//-------------------------------------------------
    public function update(Request $request, $categoria, $id){
        $result = new Result();

        try
        {
            Categorias::findOrFail($categoria);

            try
            {
                $recurso = Subcategorias::findOrFail($id);
                $newresource = $request->toarray();
                
                $rest = new Rest();
                $rest->model = 'App\Models\Subcategorias';
                $rest->input = $newresource;
                $rest->instance = $recurso;
                
                $response = $rest->renew();
                $result = $response['result'];

                return Response::json($response, $result->code);
            }

            catch(ModelNotFoundException $e)
            {
                $response = [];

                $result->setCode(404);
                $result->internalMessage = $e->getMessage();

                $response['result'] = $result;

                return Response::json($response, $response['result']->code);
            }
        }

        catch(ModelNotFoundException $e)
        {
            $response = [];

            $result->setCode(404);
            $result->internalMessage = $e->getMessage();

            $response['result'] = $result;

            return Response::json($response, $response['result']->code);
        }
    }
//-------------------------------------------------
    public function destroy($categoria, $id){
        $result = new Result();
        $response = [];

        try
        {
            Categorias::findOrFail($categoria);
            
            try
            {
                $recurso = Subcategorias::findOrFail($id);
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

        catch(ModelNotFoundException $e)
        {
            $result->setCode(404);
            $result->internalMessage = $e->getMessage();

            $response['result'] = $result;

            return Response::json($response, $response['result']->code);
        }
    }
//-------------------------------------------------
}