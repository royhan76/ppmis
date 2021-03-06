<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dormitory;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
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
        return response()->json([
            'success' => true,
            'data' => $dormitories
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
        $data = $request->only('name');
        $validator = Validator::make($data, [
            'name' => 'required|string|unique:grades',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 500);
        }
        $dormitory = Dormitory::create([
            'name' => $request->name,
        ]);
        return response()->json([
            'success' => true,
            'data' => $dormitory
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
        $dormitory = Dormitory::find($id);
        return response()->json([
            'success' => true,
            'data' => $dormitory
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
        $data = $request->only('name');
        $validator = Validator::make($data, [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 500);
        }


        $dormitory = Dormitory::find($id);
        $dormitory->name = $request->name;
        $dormitory->save();

        return response()->json([
            'success' => true,
            'data' => $dormitory
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
            $dormitory = Dormitory::find($id);
            $dormitory->delete();

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
