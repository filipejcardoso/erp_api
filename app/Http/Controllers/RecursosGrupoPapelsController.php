<?php

namespace App\Http\Controllers;
//-------------------------------------------------
use Input;
use Response;
use Exception;
use App\Helpers\Rest;
use App\Helpers\Result;
use App\Models\RecursosGrupoPapels;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
//-------------------------------------------------
class RecursosGrupoPapelsController extends Controller
{
	/*public function index(Request $request)
	{
		$rest = new Rest();
        $rest->model = 'App\Models\RecursosGrupoPapels';
        $rest->input = $request->toArray();

        $response = $rest->getCollection('paginate', null);
        $result = $response['result'];

        return Response::json($response, $result->code);
	}
//-------------------------------------------------
	public function show (Request $request, $id)
	{
		$rest = new Rest();
        $rest->model = 'App\Models\RecursosGrupoPapels';
        $rest->input = $request->toArray();

        $response = $rest->getCollection('find', $id);
        $result = $response['result'];

        return Response::json($response, $result->code);
	}*/
//-------------------------------------------------
	public function store(Request $request)
	{
		$result = new Result();

		$response = [];

		try
		{
			$recurso = new RecursosGrupoPapels();
		
			$newrequest = $request->toArray();

			$recurso->papels_id = $newrequest['papels_id'];
			$recurso->recursos_grupo_id = $newrequest['recursos_grupo_id'];
			$recurso->save();

			$result->setCode(201);
			$result->internalMessage = 'Recurso criado';

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
			$recurso = RecursosGrupoPapels::findOrFail($id);
			
			$newresource = $request->toArray();

			if(array_key_exists('papels_id', $newresource))
				$recurso->papels_id = $newresource['papels_id'];
			if(array_key_exists('recursos_grupo_id', $newresource))
				$recurso->recursos_grupo_id = $newresource['recursos_grupo_id'];
			else
				throw new Exception('Parametros invalidos');
			$recurso->save();

			$result->setCode(202);
			$result->internalMessage = 'Recurso atualizado';

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
			$recurso = RecursosGrupoPapels::findOrFail($id);
			$recurso->delete();

			$result->setCode(200);
			$result->internalMessage = 'Recurso deletado';

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