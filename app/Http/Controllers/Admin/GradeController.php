<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;
use Illuminate\Validation\Rule;
use Exception;


class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::all();

        return view('admin.pages.grade.index', ['grades' => $grades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.grade.create');
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
            'name' => 'required|unique:App\Models\Grade,name',
            'number' => 'required'
        ]);

        $grade = Grade::create([
            'name' => $request->name,
            'number' => $request->number
        ]);

        return redirect('admin/grade')->with('status', 'Asrama Berhasil Ditambahkan!');
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
        $grade = Grade::find($id);

        return view('admin.pages.grade.edit', ['grade' => $grade]);
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
            'name' => ['required', Rule::unique('grades')->ignore($id)],
            'number' => 'required'
        ]);

        $grade = Grade::find($id);
        $grade->name = $request->name;
        $grade->number = $request->grade;
        $grade->save();

        return redirect('admin/grade')->with('status', 'Grade Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grade = Grade::find($id);
        try {
            $grade->delete();

            return redirect('admin/grade')->with('status', 'Grade Berhasil Dihapus!');
        } catch (Exception $e) {
            return redirect('admin/grade')->with('status', 'Grade Gagal Dihapus!');
        }
    }
}
