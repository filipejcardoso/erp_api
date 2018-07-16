<?php
namespace App\Helpers;
//------------------------------
use Exception;
use App\Helpers\Result;
use App\Models\PedidosProdutos;
use App\Exceptions\EmptyException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
//------------------------------
class Discount
{
	//Calcula o preço final de cada produto listado no pedido
	static public function descontoParcial($pedido, $pedido_produto)
	{
		$f = (1-($pedido_produto->desconto)*0.01);
		$pedido_produto->preco = ($pedido_produto->preco_venda)*($pedido_produto->quantidade)*($f);
		$pedido_produto->save(); 

		if($pedido != null)
			Discount::descontoTotal($pedido);

        return $pedido_produto;
	}

	static public function setDescontoTotal($pedido, $tipo)
	{
		if($tipo == 1)
			Discount::getPercent($pedido);

		$builder = PedidosProdutos::query();
		
		$builder->where('pedido_id',$pedido->id);

		$produtos = $builder->get();

		$soma_venda = 0;
		$soma_preco = 0;

		foreach($produtos as $key=>$produto)
		{
			$produtos[$key]->desconto = $pedido->desconto;
			Discount::descontoParcial(null, $produtos[$key]);

			$soma_venda = $soma_venda + $produtos[$key]->preco_venda*$produtos[$key]->quantidade;
			$soma_preco = $soma_preco + $produtos[$key]->preco;
		}

		if($soma_venda!=0)
			$desconto = (($soma_venda - $soma_preco)/$soma_venda)*100;
		else
			$desconto = 0;

		$pedido->desconto = $desconto;
		$pedido->valor = $soma_preco;

		$pedido->save();
	}

	//Calcula o desconto total
	static public function descontoTotal($pedido)
	{
		$builder = PedidosProdutos::query();
		
		$builder->where('pedido_id',$pedido->id);

		$produtos = $builder->get();

		$soma_venda = 0;
		$soma_preco = 0;

		foreach($produtos as $produto)
		{
			$soma_venda = $soma_venda + $produto->preco_venda*$produto->quantidade;
			$soma_preco = $soma_preco + $produto->preco;
		}

		if($soma_venda!=0)
			$desconto = (($soma_venda - $soma_preco)/$soma_venda)*100;
		else
			$desconto = 0;

		$pedido->desconto = $desconto;
		$pedido->valor = $soma_preco;

		$pedido->save();
	}

	static public function getPercent($pedido)
	{
		$money = $pedido->desconto;

		$builder = PedidosProdutos::query();
		
		$builder->where('pedido_id',$pedido->id);

		$produtos = $builder->get();

		$soma_venda = 0;

		foreach($produtos as $produto)
			$soma_venda = $soma_venda + $produto->preco_venda*$produto->quantidade;

		if($soma_venda!=0)
			$desconto = ($money/$soma_venda)*100;
		else
			$desconto = 0;
	
		$pedido->desconto = $desconto;
	}
}