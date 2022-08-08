<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Grade;
use App\Models\Season;
use App\Models\User;
use Illuminate\Validation\Rule;
use Exception;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('admin.pages.teacher.index', ['teachers' => $teachers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $seasons = Season::all();
        $grades = Grade::all();
        $users = User::all();

        return view('admin.pages.teacher.create', [
            'seasons' => $seasons,
            'grades' => $grades,
            'users' => $users
        ]);
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
            'name' => 'required',
            'year' => 'required',
            'grade' => 'required',
        ]);

        $teacher = Teacher::create([
            'user_id' => $request->name,
            'year' => $request->year,
            'grade_id' => $request->grade,
        ]);

        return redirect('admin/teacher')->with('status', 'Wali kelas berhasil ditambahkan');
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
        $seasons = Season::all();
        $grades = Grade::all();
        $users = User::all();
        $teacher = Teacher::find($id);
        return view('admin.pages.teacher.edit', [
            'seasons' => $seasons,
            'grades' => $grades,
            'teacher' => $teacher,
            'users' => $users
        ]);
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
            'name' => 'required',
            'year' => 'required',
            'grade' => 'required',
        ]);

        $teacher =  Teacher::find($id);
        $teacher->user_id = $request->name;
        $teacher->year = $request->year;
        $teacher->grade_id = $request->grade;
        $teacher->save();

        return redirect('admin/teacher')->with('status', 'Wali Kelas berhasil diupdata');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = Teacher::find($id);
        try {
            $teacher->delete();

            return redirect('admin/teacher')->with('status', 'Wali kelas Berhasil Dihapus!');
        } catch (Exception $e) {
            return redirect('admin/teacher')->with('status', 'Wali kelas Gagal Dihapus!');
        }
    }
}
