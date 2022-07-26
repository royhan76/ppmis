<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
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
        return response()->json([
            'success' => true,
            'data' => $grades
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

        $data = $request->only('name', 'number');
        $validator = Validator::make($data, [
            'name' => 'required|string|unique:grades',
            'number' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 500);
        }
        $grade = Grade::create([
            'name' => $request->name,
            'number' => $request->number
        ]);
        return response()->json([
            'success' => true,
            'data' => $grade
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
        $grade = Grade::find($id);
        return response()->json([
            'success' => true,
            'data' => $grade
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
        $data = $request->only('name', 'number');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'number' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 500);
        }


        $grade = Grade::find($id);
        $grade->name = $request->name;
        $grade->number = $request->number;
        $grade->save();

        return response()->json([
            'success' => true,
            'data' => $grade
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
            $grade = Grade::find($id);
            $grade->delete();

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
