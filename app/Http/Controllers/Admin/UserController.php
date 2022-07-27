<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role != 'ADMIN') return redirect('admin');
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
        if (Auth::user()->role != 'ADMIN') return redirect('admin');
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
        if (Auth::user()->role != 'ADMIN') return redirect('admin');
        $validated = $request->validate([
            'name' => 'required|min:6|max:50',
            'username' => 'required|unique:App\Models\User,username|alpha_dash|min:6|max:50',
            'password' => 'required|min:6',
            'repassword' => 'required|same:password'
        ]);
        $filename = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $filename = random_int(1000, 9999) . '-' . time() . '.' . $file->getClientOriginalExtension();

            Storage::disk('s3')->put('ppmis/images/user/' . $filename, file_get_contents($file));
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'USER',
            'image' => $filename
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->id != $id) return redirect('admin');
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

        if (Auth::user()->id != $id) return redirect('admin');
        $validated = $request->validate([
            'name' => 'required|min:6|max:50',
            'username' => ['required', 'alpha_dash', 'min:6', 'max:50', Rule::unique('users')->ignore($id)],
        ]);

        $user = User::find($id);
        $filename = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $filename = random_int(1000, 9999) . '-' . time() . '.' . $file->getClientOriginalExtension();

            Storage::disk('s3')->put('ppmis/images/user/' . $filename, file_get_contents($file));

            if ($user->image != '') Storage::disk('s3')->delete('ppmis/images/user/' . $user->image);
        }

        $user->image =  $filename;
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
        if (Auth::user()->role != 'ADMIN') return redirect('admin');
        try {
            $user = User::find($id);
            $user->delete();
            return redirect('admin/user')->with('status', 'User Berhasil Dihapus!');
        } catch (Exception $e) {
            return redirect('admin/user')->with('status', "User Gagal Dihapus");
        }
    }
}
