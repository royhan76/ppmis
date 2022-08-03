<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Season;
use App\Models\Grade;
use App\Models\LessonValue;
use App\Models\Student;
use App\Models\Teacher;
use Exception;

class LessonValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lesson_values = LessonValue::all();
        return view('admin.pages.lesson_value.index', ['lesson_values' => $lesson_values]);
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
        $lessons = Lesson::all();
        $students = Student::all();
        $teachers = Teacher::all();

        return view('admin.pages.lesson_value.create', [
            'seasons' => $seasons,
            'grades' => $grades,
            'lessons' => $lessons,
            'students' => $students,
            'teachers' => $teachers
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
            'student' => 'required',
            'year' => 'required',
            'grade' => 'required',
            'lesson' => 'required',
            'teacher' => 'required',
            'value' => 'required'
        ]);

        $lesson_value = LessonValue::create([
            'student_id' => $request->student,
            'year' => $request->year,
            'grade_id' => $request->grade,
            'lesson_id' => $request->lesson,
            'teacher_id' => $request->teacher,
            'value' => $request->value
        ]);

        return redirect('admin/lesson-value')->with('status', 'Nilai Pelajaran berhasil ditambahkan');
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
        $lessons = Lesson::all();
        $students = Student::all();
        $teachers = Teacher::all();
        $lesson_value = LessonValue::find($id);

        return view('admin.pages.lesson_value.edit', [
            'seasons' => $seasons,
            'grades' => $grades,
            'lessons' => $lessons,
            'students' => $students,
            'teachers' => $teachers,
            'lesson_value' => $lesson_value
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
            'student' => 'required',
            'year' => 'required',
            'grade' => 'required',
            'lesson' => 'required',
            'teacher' => 'required',
            'value' => 'required'
        ]);

        $lesson_value =  LessonValue::find($id);
        $lesson_value->student_id = $request->student;
        $lesson_value->year = $request->year;
        $lesson_value->grade_id = $request->grade;
        $lesson_value->lesson_id = $request->lesson;
        $lesson_value->teacher_id = $request->teacher;
        $lesson_value->value = $request->value;
        $lesson_value->save();

        return redirect('admin/lesson-value')->with('status', 'Nilai Pelajaran berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson_value = LessonValue::find($id);
        try {
            $lesson_value->delete();

            return redirect('admin/lesson-value')->with('status', 'Nilai Pelajaran Berhasil Dihapus!');
        } catch (Exception $e) {
            return redirect('admin/lesson-value')->with('status', 'Nilai Pelajaran Gagal Dihapus!');
        }
    }
}
