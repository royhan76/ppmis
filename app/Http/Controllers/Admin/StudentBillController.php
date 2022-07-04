<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Bill;
use App\Models\Season;
use App\Models\StudentBill;
use Exception;

class StudentBillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student_bills = StudentBill::all();
        return view('admin.pages.student_bill.index', ['student_bills' => $student_bills]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::all();
        $bills = Bill::all();
        return view('admin.pages.student_bill.create', [
            'students' => $students,
            'bills' => $bills
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
            'bill' => 'required',
            'status' => 'required'
        ]);

        $student_bill = StudentBill::create([
            'student_id' => $request->student,
            'bill_id' => $request->bill,
            'status' => $request->status
        ]);

        return redirect('admin/student-bill')->with('status', 'Tagihan santri Berhasil Ditambahkan!');
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
        $student_bill = StudentBill::find($id);
        $students = Student::all();
        $bills = Bill::all();

        return view('admin.pages.student_bill.edit', [
            'students' => $students,
            'bills' => $bills,
            'student_bill' => $student_bill
        ]);

        return redirect('admin/student-bill')->with('status', 'Tagihan santri Berhasil Ditambahkan!');
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
            'bill' => 'required',
            'status' => 'required'
        ]);

        $student_bill = StudentBill::find($id);
        $student_bill->student_id = $request->student;
        $student_bill->bill_id = $request->bill;
        $student_bill->status = $request->status;
        $student_bill->save();

        return redirect('admin/student-bill')->with('status', 'Tagihan santri Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student_bill = StudentBill::find($id);
        try {
            $student_bill->delete();
            return redirect('admin/student_bill')->with('status', 'Tagihan santri berhasil dihapus');
        } catch (Exception $e) {
            return redirect('admin/student_bill')->with('status', 'Tagihan santri gagal dihapus');
        }
    }
}
