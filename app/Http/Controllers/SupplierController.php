<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\Models\Supplier;
use App\Models\Brand;
use View;

class SupplierController extends Controller
{
	//layout dengan menggunakan blade
	public $nama = 'Supplier';
	/**
	* @var array
	*/
	protected $rules =
	[
		'nama' => 'required',
		'ktkPerson' => 'required',
		'no_hp' => 'required',
		'alamat' => 'required',
		'provinsi' => 'required',
		'kabupaten' => 'required',
		'tipe' => 'required',
		'status' => 'required'
	];

	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		$suppliers = Supplier::all();
		return view('suppliers.supp', ['suppliers' => $suppliers]);
	}


	public function getAllKabupaten()
	{
		$post = Post::all();
		return view('suppliers.supp', ['post' => $post]);
	}
	/**
	* Show the form for the creating a new resource.
	*
	*@return \Illuminate\Http\Response
	*/
	public function create()
	{
		//
	}

	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $supplier = Supplier::create($request->all());
            return response()->json($supplier);           
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
		$supplier = Supplier::findOrFail($id);

		return view('supplier.show', ['supplier' => $supplier]);
	}

	/**
	*  Show the form for editing the specified resource.
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
	public function update(Request $request, $id)
	{		
		$supplier = Supplier::find($id)->update($request->all());
		return response()->json($supplier);
	}

	/**
	* Remove the specified resource from storage.
	* 
	* @param int $id
	* @return \Illuminate\Http\Response
	*/
	public function destroy($id)
	{
		$supplier = Supplier::findOrFail($id);
		$supplier->delete();

		return response()->json($supplier);
	}
}