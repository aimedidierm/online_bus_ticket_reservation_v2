<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->where('role', 'passenger')->get();
        return view('admin.users', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "email" => "required|email",
            "password" => "required|string",
            "confirmPassword" => "required|string",
        ]);
        if ($request->password == $request->confirmPassword) {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = 'passenger';
            $user->save();
            return redirect('/');
        } else {
            return redirect('/register')->withErrors('Passwords not match');
        }
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "email" => "required|email",
            "password" => "required|string",
            "confirmPassword" => "required|string",
        ]);

        if ($request->password == $request->confirmPassword) {
            $user = User::find(Auth::id());
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->update();
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors('Passwords not match');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateSingleUser(Request $request)
    {
        $request->validate([
            "userId" => "required|integer",
            "name" => "required|string",
            "email" => "required|email|string",
            "card" => "required|string"
        ]);

        $user = User::find($request->userId);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->card = $request->card;
        $user->update();
        return redirect('/admin/users');
    }
}
