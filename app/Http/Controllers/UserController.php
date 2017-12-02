<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use DB;


class UserController extends Controller
{

    protected $rules =
    [
        'nama' => 'required',
        'jabatan' => 'required',
        'email' => 'required|email|unique:users',
        'status_option' => 'required',
        'password' => 'required|min:8',
        'repassword' => 'required|same:password',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =  DB::table('users')->paginate(10); //User::all()->paginate(10);\
        $total = User::count();
        return view('users.index', ['users' => $users, 'total' => $total]);
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
        // dd($request->all());
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            
            $photo = $request->file('photo');
            if($photo != null){
                $file_name = $photo->getClientOriginalName();
                $request->file('photo')->move("image/", $file_name);
            }

            $user = new User();
            $user->name = $request->nama;
            $user->password = bcrypt($request->password);
            $user->email = $request->email;
            $user->jabatan = $request->jabatan;
            $user->status = $request->status_option;
            $user->foto = $file_name;
            $user->save();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json($user);
    }
}
