<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use Hash;
use DB;
use Yajra\Datatables\Datatables;

class UsersController extends Controller
{
    protected  $rules = array(
        'email'         => 'required|email',
        'firstname'     => 'required|min:2',
        'lastname'      =>  'required|min:2',
        'password'      => 'required|min:6',
        'repassword'    => 'required|same:password',
        'address'       => 'required|min:20',
        'phone'         => 'required||min:10'
    );
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('databases.test');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = DB::table('users')->select(['id', 'email', 'lastname', 'firstname', 'address', 'phone']);
        return Datatables::of($user)->addColumn('action', function($data) {
                                        $buttons  =  '<button type="button" name="edit" id="' . $data->id .'" class="edit btn btn-warning btn-flat" >Edit</button>';
                                        $buttons .= '<button type="button" name="delete" id="' . $data->id .'" class="delete btn btn-danger btn-flat">Delete</button>';
                                        return $buttons;
                                    })
                                    ->rawColumns(['action'])
                                    ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 
       

        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $form_data = array(
            'email'     => $request->email,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'password'  => Hash::make($request->password),
            'remember_token'=>$request->_token,
            'address'   => $request->address,
            'phone'     => $request->phone
        );
        
        User::create($form_data);

        return response()->json(['success' => 'User Added Successfully']);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return response()->json(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
        if ($request->password == '')
        {
            $this->rules = [
                'email'         => 'required|email',
                'firstname'     => 'required|min:2',
                'lastname'      =>  'required|min:2',
                'address'       => 'required|min:20',
                'phone'         => 'required|min:10'
            ];
           
            $validator = Validator::make($request->all(), $this->rules);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }
            
            $form_data = array(
                'email'     => $request->email,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'remember_token'=>$request->_token,
                'address'   => $request->address,
                'phone'     => substr($request->phone,0,3) . '.' . substr($request->phone, 3, 3) . '.' .   substr($request->phone, 6),
            );
        } else {
            $validator = Validator::make($request->all(), $this->rules);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }
    
            $form_data = array(
                'email'     => $request->email,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'password'  => Hash::make($request->password),
                'remember_token'=>$request->_token,
                'address'   => $request->address,
                'phone'     => substr($request->phone,0,3) . '.' . substr($request->phone, 3, 3) . '.' .   substr($request->phone, 6),
            );
        }
        $user->update($form_data);
        return response()->json(['success' => 'User Update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        
        $user->delete();
        return response()->json([
            'success'=> true,
            'message' => 'Xoa thanh cong',
        ],200);
    }
}
