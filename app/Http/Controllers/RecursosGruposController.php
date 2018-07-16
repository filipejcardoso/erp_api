<?php

namespace App\Http\Controllers;
//-------------------------------------------------
use Input;
use Response;
use Exception;
use App\Helpers\Rest;
use App\Helpers\Result;
use Illuminate\Http\Request;
use App\Models\RecursosGrupos;
use Illuminate\Database\Eloquent\ModelNotFoundException;
//-------------------------------------------------
class RecursosGruposController extends Controller
{
	public function index(Request $request)
	{
		$rest = new Rest();
        $rest->model = 'App\Models\RecursosGrupos';
        $rest->input = $request->toArray();

        $response = $rest->getCollection('paginate', null);
        $result = $response['result'];

        return Response::json($response, $result->code);
	}
//-------------------------------------------------
	public function show (Request $request, $id)
	{
		$rest = new Rest();
        $rest->model = 'App\Models\RecursosGrupos';
        $rest->input = $request->toArray();

        $response = $rest->getCollection('find', $id);
        $result = $response['result'];

        return Response::json($response, $result->code);
	}
//-------------------------------------------------
	public function store(Request $request)
	{
		$result = new Result();

		$response = [];

		try
		{
			$recurso = new RecursosGrupos();
		
			$newrequest = $request->toArray();

			$recurso->nome = $newrequest['nome'];
			$recurso->crud = $newrequest['crud'];
			$recurso->save();

			$result->setCode(201);
			$result->internalMessage = 'Recurso Grupo criado';

			$response['records'] = $recurso;
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
	public function update (Request $request, $id)
	{
		$result = new Result();
		
		$response = [];

		try
		{
			$recurso = RecursosGrupos::findOrFail($id);
			
			$newresource = $request->toArray();

			if(array_key_exists('nome', $newresource))
				$recurso->nome = $newresource['nome'];
			else if(array_key_exists('crud', $newresource))
				$recurso->crud = $newresource['crud'];
			else
				throw new Exception('Parametros invalidos');
			$recurso->save();

			$result->setCode(202);
			$result->internalMessage = 'Grupo de recurso atualizado';

			$response['records'] = $recurso;
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
	public function destroy($id)
	{
		$result = new Result();

		$response = [];

		try
		{
			$recurso = RecursosGrupos::findOrFail($id);
			$recurso->delete();

			$result->setCode(200);
			$result->internalMessage = 'Grupo de recursos deletado';

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

}