<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = User::orderBy('id', 'desc')->paginate(10);

        return view('user.index', ['models' => $models]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $data = $request->all();

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('user.index')->with(['success' => 'User has been successfully created', 'status' => 'success']);
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
        return view('user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->all();
        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);

        return redirect()->route('user.index')->with(['success' => 'User has been successfully updated', 'status' => 'warning']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with(['success' => 'User has been successfully deleted', 'status' => 'danger']);
    }


    public function profileIndex()
    {
        $user = User::where('id', '=', Auth::user()->id)->first();
        return view('user.profile', ['user' => $user]);
    }

    public function profileUpdate(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id
        ]);
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:5',
                'c_password' => 'same:password'
            ]);
            $password = $request->password;
            $data['password'] = Hash::make($password);
        }
        $user->update($data);
        return redirect()->back();
    }
}
