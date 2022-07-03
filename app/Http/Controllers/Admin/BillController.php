<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\Role;
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
        return view('admin.pages.bill.index', ['bills' => $bills]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.pages.bill.create', ['roles' => $roles]);
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
            'arrival' => 'required',
            'year' => 'required',
            'role' => 'required',
            'nominal' => 'required'
        ]);

        $bill = Bill::create([
            'name' => $request->name,
            'arrival' => $request->arrival,
            'year' => $request->year,
            'role_id' => $request->role,
            'nominal' => $request->nominal
        ]);

        return redirect('admin/bill')->with('status', 'Tagihan Berhasil Ditambahkan!');
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
        $bill = Bill::find($id);
        $roles = Role::all();

        return view('admin.pages.article.edit', ['bill' => $bill, 'roles' => $roles]);
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
            'name' => ['required', Rule::unique('categories')->ignore($id)],
            'arrival' => 'required',
            'year' => 'required',
            'role' => 'required',
            'nominal' => 'required'
        ]);

        $bill = Bill::find($id);
        $bill->name = $request->name;

        $bill->save();

        return redirect('admin/bill')->with('status', 'Tagihan Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Bill::find($id);
        try{
            $category->delete();

            return redirect('admin/bill')->with('status', 'Tagihan Berhasil Dihapus!');
        }catch(Exception $e){
            return redirect('admin/bill')->with('status', 'Tagihan Gagal Dihapus!');
        }
    }
}
