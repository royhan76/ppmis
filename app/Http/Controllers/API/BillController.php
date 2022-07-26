<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bill;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;
use Exception;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = Bill::all();
        return response()->json([
            'success' => true,
            'data' => $bills
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

        $data = $request->only('name', 'arrival', 'year', 'role', 'nominal');
        $validator = Validator::make($data, [
            'name' => 'required',
            'arrival' => 'required',
            'year' => 'required',
            'role' => 'required',
            'nominal' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 500);
        }
        $bill = Bill::create([
            'name' => $request->name,
            'arrival' => $request->arrival,
            'year' => $request->year,
            'role_id' => $request->role,
            'nominal' => $request->nominal
        ]);
        return response()->json([
            'success' => true,
            'data' => $bill
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
        $bill = Bill::find($id);
        return response()->json([
            'success' => true,
            'data' => $bill
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
        $data = $request->only('name', 'arrival', 'year', 'role', 'nominal');
        $validator = Validator::make($data, [
            'name' => ['required', Rule::unique('categories')->ignore($id)],
            'arrival' => 'required',
            'year' => 'required',
            'role' => 'required',
            'nominal' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 500);
        }


        $bill = Bill::find($id);
        $bill->name = $request->name;
        $bill->arrival = $request->arrival;
        $bill->year = $request->year;
        $bill->role_id = $request->role;
        $bill->nominal = $request->nominal;

        $bill->save();

        return response()->json([
            'success' => true,
            'data' => $bill
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
            $bill = Bill::find($id);
            $bill->delete();

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
