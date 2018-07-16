<?php

use Illuminate\Http\Request;

Route::group(['prefix' =>'v1', 'middleware'=> 'cors:api'],function()
{
	Route::group(['prefix' =>'empresas'],function()
	{
		Route::get('', ['uses' => 'EmpresasController@show']);
		Route::patch('{id}', ['uses' => 'EmpresasController@update']);
	});
	
	Route::group(['prefix' =>'configuracoes'],function()
	{
		Route::get('', ['uses' => 'ConfiguracoesController@show']);
		Route::patch('{id}', ['uses' => 'ConfiguracoesController@update']);
	});

	Route::group(['prefix' =>'recursos_grupos'],function()
	{
		Route::get('', ['uses' => 'RecursosGruposController@index']);
		Route::get('{id}', ['uses' => 'RecursosGruposController@show']);
		Route::post('', ['uses' => 'RecursosGruposController@store']);
		Route::patch('{id}', ['uses' => 'RecursosGruposController@update']);
		Route::delete('{id}', ['uses' => 'RecursosGruposController@destroy']);

		Route::group(['prefix' =>'/{recursos_grupos}/recursos'],function()
		{
			Route::get('', ['uses' => 'RecursosController@index']);
			Route::get('{id}', ['uses' => 'RecursosController@show']);
			Route::post('', ['uses' => 'RecursosController@store']);
			Route::patch('{id}', ['uses' => 'RecursosController@update']);
			Route::delete('{id}', ['uses' => 'RecursosController@destroy']);
		});
	});

	Route::group(['prefix' =>'recursos_grupo_papels'],function()
	{
		Route::post('', ['uses' => 'RecursosGrupoPapelsController@store']);
		Route::patch('{id}', ['uses' => 'RecursosGrupoPapelsController@update']);
		Route::delete('{id}', ['uses' => 'RecursosGrupoPapelsController@destroy']);
	});



    Route::post('auth/login', 'Auth\ApiAuthController@login');

    Route::group(['middleware'=>['jwt-auth:api']], function()
   	{

		Route::group(['prefix' =>'auth'],function()
		{
	   		Route::post('logout', 'Auth\ApiAuthController@logout');
	   		Route::post('refresh', 'Auth\ApiAuthController@refresh');
		});

		Route::group(['prefix' =>'pedidos'],function()
		{
	   		Route::get('', ['uses' => 'PedidosController@index']);
			Route::get('{id}', ['uses' => 'PedidosController@show']);
			Route::post('', ['uses' => 'PedidosController@store']);
			Route::patch('{id}', ['uses' => 'PedidosController@update']);
			Route::delete('{id}', ['uses' => 'PedidosController@destroy']);

			Route::group(['prefix' =>'/{pedidos}/pedidos_produtos'],function(){
				Route::get('', ['uses' => 'PedidosProdutosController@index']);
				Route::get('{id}', ['uses' => 'PedidosProdutosController@show']);
				Route::post('', ['uses' => 'PedidosProdutosController@store']);
				Route::patch('{id}', ['uses' => 'PedidosProdutosController@update']);
				Route::delete('{id}', ['uses' => 'PedidosProdutosController@destroy']);
			});

		});	

		Route::group(['prefix' =>'vendas'],function()
		{
	   		Route::get('', ['uses' => 'VendasController@index']);
			Route::get('{id}', ['uses' => 'VendasController@show']);

			Route::group(['prefix' =>'/{vendas}/pagamentos'],function(){
				Route::get('', ['uses' => 'PagamentosController@index']);
				Route::get('{id}', ['uses' => 'PagamentosController@show']);
			});
		});	

		Route::group(['prefix' =>'caixas'],function()
		{
	   		Route::get('', ['uses' => 'CaixasController@index']);
			Route::get('{id}', ['uses' => 'CaixasController@show']);

			Route::group(['prefix' =>'/{caixas}/vendas'],function(){
				Route::get('', ['uses' => 'VendasController@indexCaixa']);
				Route::get('{id}', ['uses' => 'VendasController@showCaixa']);
			});

			Route::group(['prefix' =>'/{caixas}/movimentacaos'],function(){
				Route::get('', ['uses' => 'MovimentacaosController@indexCaixa']);
				Route::get('{id}', ['uses' => 'MovimentacaosController@showCaixa']);
			});

		});	

		Route::group(['prefix' =>'usuarios'],function()
		{
			Route::get('', ['uses' => 'UserController@index']);
			Route::get('{id}', ['uses' => 'UserController@show']);
			Route::post('', ['uses' => 'UserController@store']);
			Route::patch('{id}', ['uses' => 'UserController@update']);
			Route::delete('{id}', ['uses' => 'UserController@destroy']);
		});

		Route::group(['prefix' =>'papels'],function()
		{
			Route::get('', ['uses' => 'PapelsController@index']);
			Route::get('{id}', ['uses' => 'PapelsController@show']);
			Route::post('', ['uses' => 'PapelsController@store']);
			Route::patch('{id}', ['uses' => 'PapelsController@update']);
			Route::delete('{id}', ['uses' => 'PapelsController@destroy']);
		});

		Route::group(['prefix' =>'recursos_grupo_papels'],function()
		{
			Route::post('', ['uses' => 'RecursosGrupoPapelsController@store']);
			Route::patch('{id}', ['uses' => 'RecursosGrupoPapelsController@update']);
			Route::delete('{id}', ['uses' => 'RecursosGrupoPapelsController@destroy']);
		});	

   		Route::group(['prefix' =>'produtos'],function()
		{
			Route::get('', ['uses' => 'ProdutosController@index']);
			Route::get('{id}', ['uses' => 'ProdutosController@show']);
			Route::post('', ['uses' => 'ProdutosController@store']);
			Route::patch('{id}', ['uses' => 'ProdutosController@update']);
			Route::delete('{id}', ['uses' => 'ProdutosController@destroy']);
		});

		Route::group(['prefix' =>'categorias'],function()
		{
			Route::get('', ['uses' => 'CategoriasController@index']);
			Route::get('{id}', ['uses' => 'CategoriasController@show']);
			Route::post('', ['uses' => 'CategoriasController@store']);
			Route::patch('{id}', ['uses' => 'CategoriasController@update']);
			Route::delete('{id}', ['uses' => 'CategoriasController@destroy']);

			Route::group(['prefix' =>'/{categorias}/subcategorias'],function()
			{
				Route::get('', ['uses' => 'SubcategoriasController@index']);
				Route::get('{id}', ['uses' => 'SubcategoriasController@show']);
				Route::post('', ['uses' => 'SubcategoriasController@store']);
				Route::patch('{id}', ['uses' => 'SubcategoriasController@update']);
				Route::delete('{id}', ['uses' => 'SubcategoriasController@destroy']);
			});
		});

		Route::group(['prefix' =>'lojas'],function()
		{
			Route::get('', ['uses' => 'LojasController@index']);
			Route::get('{id}', ['uses' => 'LojasController@show']);
			Route::post('', ['uses' => 'LojasController@store']);
			Route::patch('{id}', ['uses' => 'LojasController@update']);
			Route::delete('{id}', ['uses' => 'LojasController@destroy']);
		});

		Route::group(['prefix' =>'marcas'],function()
		{
			Route::get('', ['uses' => 'MarcasController@index']);
			Route::get('{id}', ['uses' => 'MarcasController@show']);
			Route::post('', ['uses' => 'MarcasController@store']);
			Route::patch('{id}', ['uses' => 'MarcasController@update']);
			Route::delete('{id}', ['uses' => 'MarcasController@destroy']);
		});

		Route::group(['prefix' =>'unidades_medidas'],function()
		{
			Route::get('', ['uses' => 'UnidadesMedidasController@index']);
			Route::get('{id}', ['uses' => 'UnidadesMedidasController@show']);
			Route::post('', ['uses' => 'UnidadesMedidasController@store']);
			Route::patch('{id}', ['uses' => 'UnidadesMedidasController@update']);
			Route::delete('{id}', ['uses' => 'UnidadesMedidasController@destroy']);
		});

		Route::group(['prefix' =>'grupos_associados'],function()
		{
			Route::get('', ['uses' => 'GruposAssociadosController@index']);
			Route::get('{id}', ['uses' => 'GruposAssociadosController@show']);
			Route::post('', ['uses' => 'GruposAssociadosController@store']);
			Route::patch('{id}', ['uses' => 'GruposAssociadosController@update']);
			Route::delete('{id}', ['uses' => 'GruposAssociadosController@destroy']);
		});

		Route::group(['prefix' =>'clientes'],function()
		{
			Route::get('', ['uses' => 'ClientesController@index']);
			Route::get('{id}', ['uses' => 'ClientesController@show']);
			Route::post('', ['uses' => 'ClientesController@store']);
			Route::patch('{id}', ['uses' => 'ClientesController@update']);
			Route::delete('{id}', ['uses' => 'ClientesController@destroy']);

			Route::group(['prefix' =>'/{clientes}/contatos'],function()
			{
				Route::get('', ['uses' => 'ContatosController@index']);
				Route::get('{id}', ['uses' => 'ContatosController@show']);
				Route::post('', ['uses' => 'ContatosController@store']);
				Route::patch('{id}', ['uses' => 'ContatosController@update']);
				Route::delete('{id}', ['uses' => 'ContatosController@destroy']);
			});

			Route::group(['prefix' =>'/{clientes}/referencias_bancarias'],function()
			{
				Route::get('', ['uses' => 'ReferenciasBancariasController@index']);
				Route::get('{id}', ['uses' => 'ReferenciasBancariasController@show']);
				Route::post('', ['uses' => 'ReferenciasBancariasController@store']);
				Route::patch('{id}', ['uses' => 'ReferenciasBancariasController@update']);
				Route::delete('{id}', ['uses' => 'ReferenciasBancariasController@destroy']);
			});

			Route::group(['prefix' =>'/{clientes}/enderecos'],function()
			{
				Route::get('', ['uses' => 'EnderecosController@index']);
				Route::get('{id}', ['uses' => 'EnderecosController@show']);
				Route::post('', ['uses' => 'EnderecosController@store']);
				Route::patch('{id}', ['uses' => 'EnderecosController@update']);
				Route::delete('{id}', ['uses' => 'EnderecosController@destroy']);
			});

			Route::group(['prefix' =>'/{clientes}/info_financeiras'],function()
			{
				Route::get('', ['uses' => 'InfoFinanceirasController@index']);
				Route::get('{id}', ['uses' => 'InfoFinanceirasController@show']);
				Route::post('', ['uses' => 'InfoFinanceirasController@store']);
				Route::patch('{id}', ['uses' => 'InfoFinanceirasController@update']);
				Route::delete('{id}', ['uses' => 'InfoFinanceirasController@destroy']);
			});
		});
		Route::group(['prefix' =>'fornecedores'],function()
		{
			Route::get('', ['uses' => 'FornecedoresController@index']);
			Route::get('{id}', ['uses' => 'FornecedoresController@show']);
			Route::post('', ['uses' => 'FornecedoresController@store']);
			Route::patch('{id}', ['uses' => 'FornecedoresController@update']);
			Route::delete('{id}', ['uses' => 'FornecedoresController@destroy']);

			Route::group(['prefix' =>'/{fornecedores}/contatos'],function()
			{
				Route::get('', ['uses' => 'ContatosController@index']);
				Route::get('{id}', ['uses' => 'ContatosController@show']);
				Route::post('', ['uses' => 'ContatosController@store']);
				Route::patch('{id}', ['uses' => 'ContatosController@update']);
				Route::delete('{id}', ['uses' => 'ContatosController@destroy']);
			});

			Route::group(['prefix' =>'/{fornecedores}/referencias_bancarias'],function()
			{
				Route::get('', ['uses' => 'ReferenciasBancariasController@index']);
				Route::get('{id}', ['uses' => 'ReferenciasBancariasController@show']);
				Route::post('', ['uses' => 'ReferenciasBancariasController@store']);
				Route::patch('{id}', ['uses' => 'ReferenciasBancariasController@update']);
				Route::delete('{id}', ['uses' => 'ReferenciasBancariasController@destroy']);
			});

			Route::group(['prefix' =>'/{fornecedores}/enderecos'],function()
			{
				Route::get('', ['uses' => 'EnderecosController@index']);
				Route::get('{id}', ['uses' => 'EnderecosController@show']);
				Route::post('', ['uses' => 'EnderecosController@store']);
				Route::patch('{id}', ['uses' => 'EnderecosController@update']);
				Route::delete('{id}', ['uses' => 'EnderecosController@destroy']);
			});

			Route::group(['prefix' =>'/{fornecedores}/info_financeiras'],function()
			{
				Route::get('', ['uses' => 'InfoFinanceirasController@index']);
				Route::get('{id}', ['uses' => 'InfoFinanceirasController@show']);
				Route::post('', ['uses' => 'InfoFinanceirasController@store']);
				Route::patch('{id}', ['uses' => 'InfoFinanceirasController@update']);
				Route::delete('{id}', ['uses' => 'InfoFinanceirasController@destroy']);
			});
		});

		Route::group(['prefix' =>'tipos_contatos'],function()
		{
			Route::get('', ['uses' => 'TiposContatosController@index']);
			Route::get('{id}', ['uses' => 'TiposContatosController@show']);
			Route::post('', ['uses' => 'TiposContatosController@store']);
			Route::patch('{id}', ['uses' => 'TiposContatosController@update']);
			Route::delete('{id}', ['uses' => 'TiposContatosController@destroy']);
		});

		Route::group(['prefix' =>'tipos_enderecos'],function()
		{
			Route::get('', ['uses' => 'TiposEnderecosController@index']);
			Route::get('{id}', ['uses' => 'TiposEnderecosController@show']);
			Route::post('', ['uses' => 'TiposEnderecosController@store']);
			Route::patch('{id}', ['uses' => 'TiposEnderecosController@update']);
			Route::delete('{id}', ['uses' => 'TiposEnderecosController@destroy']);
		});	

		Route::group(['prefix' =>'regioes'], function()
		{
			Route::get('', ['uses' => 'RegioesController@index']);
			Route::get('{id}', ['uses' => 'RegioesController@show']);
			Route::post('', ['uses' => 'RegioesController@store']);
			Route::patch('{id}', ['uses' => 'RegioesController@update']);
			Route::delete('{id}', ['uses' => 'RegioesController@destroy']);	
		});
    });
});
