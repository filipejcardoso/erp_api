<?php
namespace App\Http\Controllers;
//-------------------------------------------------
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Associados;
use App\Helpers\Rest;
use App\Helpers\Result;
use App\Helpers\MaskBits;
use Response;
use Input;
use DB;
//-------------------------------------------------
class FornecedoresController extends Controller
{
	use AssociadosController;

    public function index(Request $request){
        $rest = new Rest();
        $rest->model = 'App\Models\Associados';
        $rest->input = $request->toArray();

        $builder = $rest->getBuilder();
		MaskBits::setBuilderAssociadosTags($builder, 2);    

        $response = $rest->getCollection('paginate', null);
        $result = $response['result'];

        return Response::json($response, $result->code);
    }
//-------------------------------------------------
    public function show(Request $request, $id){
        $rest = new Rest();
        $rest->model = 'App\Models\Associados';
        $rest->input = $request->toArray();

        $builder = $rest->getBuilder();
		MaskBits::setBuilderAssociadosTags($builder, 2);        
        $response = $rest->getCollection('find', $id);
        $result = $response['result'];

        return Response::json($response, $result->code);
    }
}
