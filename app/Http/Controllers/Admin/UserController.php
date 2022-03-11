<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view(
            'admin.pages.user.index',
            [
                'users' => $users
            ],
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.pages.user.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|min:6|max:50',
            'username' => 'required|unique:App\Models\User,username|alpha_dash|min:6|max:50',
            'password' => 'required|min:6',
            'repassword' => 'required|same:password'
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'USER'
        ]);

        return redirect('admin/user')->with('status', 'User Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view(
            'admin.pages.user.edit',
            [
                'user' => $user
            ],
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view(
            'admin.pages.user.edit',
            [
                'user' => $user
            ],
        );
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
        $validated = $request->validate([
            'name' => 'required|min:6|max:50',
            'username' => ['required', 'alpha_dash', 'min:6', 'max:50', Rule::unique('users')->ignore($id)],
        ]);

        $user = User::find(1);
        $user->username =  $request->username;
        $user->name = $request->name;
        $user->password = ($request->password != null) ? Hash::make($request->password) : $request->old_password;
        $user->save();

        return redirect('admin/user')->with('status', 'User Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $user = User::find($id);
            $user->delete();
            return redirect('admin/user')->with('status', 'User Berhasil Dihapus!');
        } catch (Exception $e) {
            return redirect('admin/user')->with('status', "User Gagal Dihapus");
        }
    }
}
