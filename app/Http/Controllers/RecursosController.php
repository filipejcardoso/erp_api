<?php

namespace App\Http\Controllers;
//-------------------------------------------------
use Input;
use Response;
use Exception;
use App\Helpers\Rest;
use App\Helpers\Result;
use App\Models\Recursos;
use Illuminate\Http\Request;
use App\Models\RecursosGrupos;
use Illuminate\Database\Eloquent\ModelNotFoundException;
//-------------------------------------------------
class RecursosController extends Controller
{
	public function index(Request $request, $recursoGrupo)
	{
		try
		{
			RecursosGrupos::findOrFail($recursoGrupo);

			$rest = new Rest();
	        $rest->model = 'App\Models\Recursos';
	        $rest->input = $request->toArray();
	        $rest->relation = false;

	        $builder = $rest->getBuilder();
            $builder->where('recursos_grupo_id', $recursoGrupo);
	
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
	public function show (Request $request, $recursoGrupo, $id)
	{
		try
		{
			RecursosGrupos::findOrFail($recursoGrupo);

			$rest = new Rest();
	        $rest->model = 'App\Models\Recursos';
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
	public function store(Request $request, $recursoGrupo)
	{
		$result = new Result();

		$response = [];

		try
		{

			RecursosGrupos::findOrFail($recursoGrupo);

			$recurso = new Recursos();
		
			$newrequest = $request->toArray();

			$recurso->recurso = $newrequest['recurso'];
			$recurso->recursos_grupo_id = $recursoGrupo;
			$recurso->save();

			$result->setCode(201);
			$result->internalMessage = 'Recurso criado';

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
	public function update (Request $request, $recursoGrupo, $id)
	{
		$result = new Result();
		
		$response = [];

		try
		{
			RecursosGrupos::findOrFail($recursoGrupo);

			try
			{
				$recurso = Recursos::findOrFail($id);
				
				$newresource = $request->toArray();
	
				if(array_key_exists('recurso', $newresource))
					$recurso->recurso = $newresource['recurso'];
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

		catch(ModelNotFoundException $e)
		{
			$result->setCode(404);
			$result->internalMessage = $e->getMessage();

			$response['result'] = $result;

			return Response::json($response, $result->code);

		}
	}
//-------------------------------------------------
	public function destroy($recursoGrupo, $id)
	{
		$result = new Result();

		$response = [];

			try
			{
				RecursosGrupos::findOrFail($recursoGrupo);

				try
				{
					$recurso = Recursos::findOrFail($id);
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