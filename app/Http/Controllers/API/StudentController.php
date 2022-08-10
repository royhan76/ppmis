<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Exception;
use Illuminate\Validation\Rule;
use App\Models\Room;
use App\Models\Role;
use App\Models\Season;
use App\Models\User;
use App\Models\Grade;
use App\Models\Bill;
use App\Models\StudentBill;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return response()->json([
            'success' => true,
            'data' => $students
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('name', 'nomor_induk_santri', 'date_birth', 'address', 'arrival', 'room', 'role', 'year', 'user', 'grade', 'image');
        $validator = Validator::make($data, [
            'image' => 'required|image|max:1024',
            'name' => 'required',
            'nomor_induk_santri' => 'required',
            'date_birth' => 'required',
            'address' => 'required',
            'arrival' => 'required',
            'room' => 'required',
            'role' => 'required',
            'year' => 'required',
            'user' => 'required',
            'grade' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 500);
        }
        $filename = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $filename = random_int(1000, 9999) . '-' . time() . '.' . $file->getClientOriginalExtension();

            Storage::disk('s3')->put('ppmis/images/student/' . $filename, file_get_contents($file));
        }

        $student = Student::create([
            'image' => $filename,
            'name' => $request->name,
            'nomor_induk_santri' => $request->nomor_induk_santri,
            'date_birth' => $request->date_birth,
            'address' => $request->address,
            'arrival' => $request->arrival,
            'room_id' => $request->room,
            'role_id' => $request->role,
            'year' => $request->year,
            'user_id' => $request->user,
            'grade_id' => $request->grade,
        ]);
        $bills = Bill::where('arrival', $student->arrival)
            ->where('year', $student->year)
            ->where('role_id', $student->role_id)
            ->get();

        foreach ($bills as $item) {
            $student_bill = StudentBill::where('student_id', $student->id)
                ->where('bill_id', $item->id)
                ->first();
            if (!$student_bill) {
                $new_student_bill = StudentBill::create([
                    'student_id' => $student->id,
                    'bill_id' => $item->id
                ]);
            }
        }
        return response()->json([
            'success' => true,
            'data' => $student
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        return response()->json([
            'success' => true,
            'data' => $student
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $data = $request->only('name', 'nomor_induk_santri', 'date_birth', 'address', 'arrival', 'room', 'role', 'year', 'user', 'grade');
        $data = $request->only('name', 'number');
        $validator = Validator::make($data, [
            'name' => 'required',
            'nomor_induk_santri' => 'required',
            'date_birth' => 'required',
            'address' => 'required',
            'arrival' => 'required',
            'room' => 'required',
            'role' => 'required',
            'year' => 'required',
            'user' => 'required',
            'grade' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 500);
        }
        $student =  Student::find($id);
        $filename = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = random_int(1000, 9999) . '-' . time() . '.' . $file->getClientOriginalExtension();
            Storage::disk('s3')->put('ppmis/images/student/' . $filename, file_get_contents($file));
            if ($student->image != '') Storage::disk('s3')->delete('ppmis/images/student/' . $request->oldimage);
        }
        if ($filename != '') $student->image = $filename;
        $student->nomor_induk_santri = $request->nomor_induk_santri;
        $student->date_birth = $request->date_birth;
        $student->address = $request->address;
        $student->arrival = $request->arrival;
        $student->room_id = $request->room;
        $student->role_id = $request->role;
        $student->year = $request->year;
        $student->user_id = $request->user;
        $student->grade_id = $request->grade;
        $student->save();
        $bills = Bill::where('arrival', $student->arrival)
            ->where('year', $student->year)
            ->where('role_id', $student->role_id)
            ->get();

        foreach ($bills as $item) {
            $student_bill = StudentBill::where('student_id', $student->id)
                ->where('bill_id', $item->id)
                ->first();

            if (!$student_bill) {

                $new_student_bill = StudentBill::create([
                    'student_id' => $id,
                    'bill_id' => $item->id
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'data' => $student
        ], Response::HTTP_OK);
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
            $student = Student::find($id);
            $student->delete();

            return response()->json([
                'success' => true
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'success' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
