<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Response;
use App\Models\SalesOrder;
use View;

class SalesOrdersController extends Controller
{
    /**
    * @var array
    */
    protected $rules =
    [
        
        'salesPerson' => 'required',
        'type' => 'required',
        'customer' => 'required',
        'shippingAddress' => 'required',
        'billingAddress' => 'required',
        'total' => 'required',
        'status' => 'status'
    ];



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salesOrders = SalesOrder::all();

        return view('salesorders.salesOrder', ['salesOrders' => $salesOrders]);
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
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $salesOrder = SalesOrder::create($request->all());
            return response()->json($salesOrder);            
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $salesOrder = SalesOrder::findOrFail($id);

        return view('salesOrder.show', ['salesOrder' => $salesOrder]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $salesOrder = SalesOrder::find($id)->update($request->all());

        return response()->json($salesOrder);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $salesOrder = SalesOrder::findOrFail($id);
        $salesOrder->delete();

        return response()->json($salesOrder);
    }
}
