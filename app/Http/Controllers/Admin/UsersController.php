<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:super-admin');

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::roles('customer')->latest()->paginate(12);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required' ,
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);

        if($request->password)
            $request->validate(['password' => 'required|confirmed|min:8']);


        $user->fill($validated);
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->back()->withSuccess('User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // $user->subscriptions()->delete();
        // $user->delete();
        // return redirect()->route('users.index');        
    }
}
