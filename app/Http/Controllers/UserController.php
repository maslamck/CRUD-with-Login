<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        return view('user.index', compact('users'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd('hi');
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return redirect()->route('users.index')
                        ->with('success','User created successfully!');
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
        // dd('eddit');
        $user = User::find($id);
        return view('user.edit', compact('user'));

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
        $user = User::find($id);

        $data = $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255|unique:users,email,' . $user->id . ',id',
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]
        );
        $data['password'] = Hash::make($data['password']);

        $user->update($data);
        // $users = User::get();

        return redirect()->route('users.index')
                        ->with('success','User updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd('destroy');
        
    }
    public function destroyUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')
        ->with('success','User deleted successfully!');
        
    }
    
}
