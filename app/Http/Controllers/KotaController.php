<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;
use App\Models\Kota;
use View;

class KotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    protected $rules = 
    [
        'kota' => 'required',
        'provinsi' => 'required',
        'status' => 'required'
    ];

    public function index()
    {
        $kotas = Kota::all();
        return view('kotas.kotaKabupaten',['kotas' => $kotas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
        $validator = Validator::make(Input::all(),$this->rules);
         if ($validator->fails()){
            return Response::json(array('errors' => $validator->getMessageBag()->toArray));
        } else {
            $kota=Kota::create($request->all());
            return response()->json($kota);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kota  $kota
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $kota = Kota::findOrFail($id);

        return view('kota.show'.['kota' => $kota]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function edit(Kota $kota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kota  $kota
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $kota=Kota::find($id)->update($request->all());

        return response()->json($kota);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kota  $kota
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {
        $kota = Kota::findOrFail($id);
        $kota->delete();

        return response()->json($kota);
    }
}
