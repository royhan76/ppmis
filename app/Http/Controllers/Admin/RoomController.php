<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Dormitory;
use Exception;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::all();
        return view('admin.pages.room.index', ['rooms' => $rooms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dormitories = Dormitory::all();

        return view('admin.pages.room.create', ['dormitories' => $dormitories]);
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
            'name' => 'required|unique:App\Models\Room,name',
            'dormitory' => 'required',
        ]);

        $room = Room::create([
            'name' => $request->name,
            'dormitory_id' => $request->dormitory
        ]);

        return redirect('admin/room')->with('status', 'Room Berhasil Ditambahkan!');
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
        $room = Room::find($id);
        $dormitories = Dormitory::all();

        return view('admin.pages.room.edit', ['room' => $room, 'dormitories' => $dormitories]);
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
            'dormitory_id' => 'required',
        ]);
        $room = Room::find($id);
        $room->name = $request->name;
        $room->dormitory_id = $request->dormitory_id;
        $room->save();

        return redirect('admin/room')->with('status', 'Room Berhasil Ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = Room::find($id);
        try{
            $room->delete();

            return redirect('admin/room')->with('status', 'Category Berhasil Dihapus!');
        }catch(Exception $e){
            return redirect('admin/room')->with('status', 'Category Gagal Dihapus!');
        }
    }
}
