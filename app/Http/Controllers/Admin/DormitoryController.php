<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dormitory;
use Illuminate\Validation\Rule;
use Exception;

class DormitoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dormitories = Dormitory::all();

        return view('admin.pages.dormitory.index', ['dormitories' => $dormitories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.dormitory.create');
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
            'name' => 'required|unique:App\Models\Dormitory,name',
        ]);

        $dormitory = Dormitory::create([
            'name' => $request->name
        ]);

        return redirect('admin/dormitory')->with('status', 'Asrama Berhasil Ditambahkan!');
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
        $dormitory = Dormitory::find($id);

        return view('admin.pages.dormitory.edit', ['dormitory' => $dormitory]);
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
            'name' => ['required', Rule::unique('dormitories')->ignore($id)],
        ]);

        $dormitory = Dormitory::find($id);
        $dormitory->name = $request->name;
        $dormitory->save();

        return redirect('admin/dormitory')->with('status', 'Dormitory Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dormitory = Dormitory::find($id);
        try{
            $dormitory->delete();

            return redirect('admin/dormitory')->with('status', 'Dormitory Berhasil Dihapus!');
        }catch(Exception $e){
            return redirect('admin/dormitory')->with('status', 'Dormitory Gagal Dihapus!');
        }
    }
}
