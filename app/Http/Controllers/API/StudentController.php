<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\StudentBill;
use App\Models\Foul;
use App\Models\Student;

class StudentController extends Controller
{
    protected $user;
 
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index()
    {
        $user = $this->user;
        $user->students = $this->students();
        return response()->json([
            'success' => true,
            'data' => $user
        ], Response::HTTP_OK);
    }

    public function getStudent($id){
        $student = Student::find($id);
        return response()->json([
            'success' => true,
            'data' => $student
        ], Response::HTTP_OK);
    }

    public function getStudentBill($id)
    {
        $student_bills = StudentBill::where('student_id', $id)->get();
        return response()->json([
            'success' => true,
            'data' => $student_bills
        ], Response::HTTP_OK);
    }

    public function getStudentFoul($id){
        $student_fouls = Foul::where('student_id', $id)->get();
        return response()->json([
            'success' => true,
            'data' => $student_fouls
        ], Response::HTTP_OK);
    }

    
}
