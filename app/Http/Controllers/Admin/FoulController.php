<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Foul;
use App\Models\Student;
use Illuminate\Validation\Rule;
use Exception;

class FoulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fouls = Foul::all();
        return view('admin.pages.foul.index', ['fouls' => $fouls]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::all();
        return view('admin.pages.foul.create', ['students' => $students]);
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
            'student' => 'required',
            'date' => 'required',
        ]);

        $foul = Foul::create([
            'name' => $request->name,
            'student_id' => $request->student,
            'date' => $request->date,
        ]);

        return redirect('admin/foul')->with('status', 'Pelanggaran Berhasil Ditambahkan!');
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
        $foul = Foul::find($id);
        $students = Student::all();

        return view('admin.pages.foul.edit', ['foul' => $foul, 'students' => $students]);
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
            'student' => 'required',
            'date' => 'required',
        ]);

        $foul = Foul::find($id);
        $foul->name = $request->name;
        $foul->student_id = $request->student;
        $foul->date = $request->date;
        $foul->save();

        return redirect('admin/foul')->with('status', 'Pelanggaran Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $foul = Foul::find($id);
        try{
            $foul->delete();

            return redirect('admin/foul')->with('status', 'Pelanggaran Berhasil Dihapus!');
        }catch(Exception $e){
            return redirect('admin/foul')->with('status', 'Pelanggaran Gagal Dihapus!');
        }
    }
}
