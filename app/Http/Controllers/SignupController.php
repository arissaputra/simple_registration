<?php

namespace App\Http\Controllers;
use App\User;
use App\Rules\Mobilenumber;
use Illuminate\Http\Request;

class SignupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.app');
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
        $this->validate($request,[
            'mobile_number'  =>  ['required','unique:users', 'numeric', new Mobilenumber()],
            'first_name'     =>  ['required'],
            'last_name'      =>  ['required'],
            'email'          =>  ['required','unique:users']
        ]);
        
        $data = new User;
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->mobile_number = $request->mobile_number;
        $data->birth_date = $request->birth_date;
        $data->gender = $request->gender;
        $data->email = $request->email;
        $data->save(); 
        return $data;
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
        //
    }
}
