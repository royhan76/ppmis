<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Grade;
use App\Models\Season;
use Illuminate\Validation\Rule;
use Exception;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::all();
        return view('admin.pages.lesson.index', ['lessons' => $lessons]);
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

        return view('admin.pages.lesson.create', [
            'seasons' => $seasons,
            'grades' => $grades
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

        $lesson = Lesson::create([
            'name' => $request->name,
            'year' => $request->year,
            'grade_id' => $request->grade,
        ]);

        return redirect('lesson/student')->with('status', 'Mata Pelajaran berhasil ditambahkan');
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
        $lesson = Lesson::find($id);
        return view('admin.pages.student.edit', [
            'seasons' => $seasons,
            'grades' => $grades,
            'lesson' => $lesson
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

        $lesson =  Lesson::find($id);
        $lesson->name = $request->name;
        $lesson->year = $request->year;
        $lesson->grade_id = $request->grade;
        $lesson->save();

        return redirect('lesson/student')->with('status', 'Mata Pelajaran berhasil diupdata');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson = Lesson::find($id);
        try {
            $lesson->delete();

            return redirect('admin/lesson')->with('status', 'Mata Pelajaran Berhasil Dihapus!');
        } catch (Exception $e) {
            return redirect('admin/lesson')->with('status', 'Mata Pelajaran Gagal Dihapus!');
        }
    }
}
