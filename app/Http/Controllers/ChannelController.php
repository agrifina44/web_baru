<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;
use App\Models\Channel;
use View;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    

    protected $rules = 
    [
        'channel' => 'required',
        'status' => 'required'
    ];


    public function index()
    {
        $channels = Channel::all();

        return view('channels.salesChannel',['channels' => $channels]);
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
        if ($validator->fails()){
            return Response::json(array('errors' => $validator->getMessageBag()->toArray));
        } else {
            $channel = Channel::create($request->all());
            return response()->json($channel);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $channel = Channel::findOrFail($id);

        return view('channel.show'.['channel' => $channel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function edit(Channel $channel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $channel=Channel::find($id)->update($request->all());

        return response()->json($channel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */

     public function destroy($id)
    {
        $channel = Channel::findOrFail($id);
        $channel->delete();

        return response()->json($channel);
    }


}
