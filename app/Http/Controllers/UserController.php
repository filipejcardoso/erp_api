<?php
namespace App\Http\Controllers;
//-------------------------------------------------
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;
use App\Helpers\Rest;
use App\Helpers\Result;
use Response;
use Input;
use Exception;
//-------------------------------------------------
class UserController extends Controller
{
    public function index(Request $request){
        $rest = new Rest();
        $rest->model = 'App\Models\User';
        $rest->input = $request->toArray();

        $response = $rest->getCollection('paginate', null);
        $result = $response['result'];

        return Response::json($response, $result->code);
    }
//-------------------------------------------------
    public function show(Request $request, $id){
        $rest = new Rest();
        $rest->model = 'App\Models\User';
        $rest->input = $request->toArray();

        $response = $rest->getCollection('find', $id);
        $result = $response['result'];

        return Response::json($response, $result->code);
    }
//-------------------------------------------------
    public function store(Request $request){
        $user = new User();

        foreach($request['records'] as $usuarios)
        {         
            $user->nome = $usuarios['nome'];
            $user->username = $usuarios['username'];
            $user->email = $usuarios['email'];
            $user->password = bcrypt($usuarios['password']);
            $user->papel_id = $usuarios['papel_id'];
            $user->save();
        }

        $result = new Result();
        $result->setCode(201);
        $result->internalMessage = 'Usuario criado';

        $response = [];
        $response['records'] = $user;
        $response['result'] = $result;

        return Response::json($response, $result->code);
    }
//-------------------------------------------------
    public function update(Request $request, $id){
        $response = [];
        $bool;

        $result = new Result();

        try
        {
            $recurso = User::findOrFail($id);
            $newresource = $request->toarray();
            
            foreach($newresource['records'] as $newuser)
            {
                if(array_key_exists('nome', $newuser))
                {
                    $recurso->nome = $newuser['nome'];
                    $bool = true;    
                }
                if(array_key_exists('username', $newuser))
                {
                    $recurso->username = $newuser['username'];
                    $bool = true;    
                }
                if(array_key_exists('email', $newuser))
                {
                    $recurso->email = $newuser['email'];
                    $bool = true;    
                }
                if(array_key_exists('password', $newuser))
                {
                    $recurso->password = bcrypt($newuser['password']);
                    $bool = true;    
                }
                if(array_key_exists('papel_id', $newuser))
                {
                    $recurso->papel_id = $newuser['papel_id'];
                    $bool = true;    
                }
                else if(!$bool) 
                    throw new Exception('Parâmetros inválidos');
            }
            $recurso->save();

            $result->setCode(202);
            $result->internalMessage = 'Usuário atualizado';

            $response['records'] = $recurso;
            $response['result'] = $result; 
            /*$rest = new Rest();
            $rest->model = 'App\Models\User';
            $rest->input = $newresource;
            $rest->instance = $recurso;
            
            $response = $rest->renew();
            $result = $response['result'];*/

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
            $result->setCode(400);
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
            $recurso = User::findOrFail($id);
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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nome' => 'required|string|max:255',
            'username' => 'required|string|email|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required',
            'papel_id' => 'required',
        ]);
    }
}