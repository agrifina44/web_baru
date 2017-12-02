<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\Models\Product;
use View;


class ProductController extends Controller
{
	/**
	* @var array
	*/
	protected $rules = 
	[
		'sku' => 'required',
		'kategori' => 'required',
		'brand' => 'required',
		'style' => 'required',
		'gudang' => 'required',
		'size' => 'required',
		'gender' => 'required',
		'supplier' => 'required',
		'stock' => 'required'
	];

	/**
	* Display a listing of the resource.
	*
	* @return \Illumniate\Http\Response
	*/
	public function index()
	{
		$products = Product::all();
		return view('products.product', ['products' => $products]);
	}

	/**
	* Show the form the creating a new resource.
	*
	* @return \Illumniate\Http\Response
	*/
	public function create()
	{
		//
	}

	/**
	* Store a newly created resource in storage.
	*
	* @param \Illuminate\Http\Request $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request)
	{
		$validator = Validator::make(Input::all(), $this->rules);
		if ($validator->fails()) {
			return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
		} else {
			$product = Product::create($request->all());
			return response()->json($product);
		}
	}

	/**
	* Display the specifies resource.
	*
	* @param int $id
	* @return \Illuminate\Http\Response
	*/
	public function show($id)
	{
		$product = Product::findOrFail($id);
		return view('product.show', ['product' => $product]);
	}

	/**
	* Show form for editing the specified resource.
	*
	* @param int $id
	* @return \Illuminate\Http\Response
	*/
	public function edit($id)
	{
		//
	}

	/**
	* Update the specified resource in storage.
	*
	* @param \Illuminate\Http\Request $request
	* @param int $id
	* @return \Illuminate\Http\Response
	*/
	public function update (Request $request, $id)
	{
		$product = Product::find($id)->update($request->all());
		return response()->json($product);
	}

	/**
	* Remove the specified resource from storage
	*
	*@param int $id
	*@return \Illuminate\Http\Response
	*/
	public function destroy($id)
	{
		$product = Product::findOrFail($id);
		$product->delete();

		return response()->json($product);
	}

}
