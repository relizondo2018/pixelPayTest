<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

use App\Http\Requests\ProductoCreateRequest;
use App\Http\Requests\UpdateProductoRequest;

use App\Http\Resources\Producto as ProductoResource;

class ProductoController extends Controller
{
	public function index() {
		$productos = Producto::all();
		return ProductoResource::collection($productos);
	}

	public function store(ProductoCreateRequest $request) {
		$producto = new Producto;
		$producto->nombre = $request->nombre;
		$producto->precio = $request->precio;
		$producto->cantidad = $request->cantidad;
		$producto->user_id = auth()->user()->id;
		$producto->save();	
		return new ProductoResource($producto);
	}

	public function update(UpdateProductoRequest $request, $producto) {
		$producto = Producto::find($producto);
		$producto->nombre = $request->get('nombre', $producto->nombre);
		$producto->precio = $request->get('precio', $producto->precio);
		$producto->cantidad = $request->get('cantidad', $producto->cantidad);
		$producto->user_id = auth()->user()->id;
		$producto->save();
		return new ProductoResource($producto);
	}

	public function destroy($producto) {
		$producto = Producto::find($producto);
		$producto->delete();
		return response(null, 204);
	}
}
