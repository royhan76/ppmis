<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Season;
use Illuminate\Validation\Rule;
use Exception;

class SeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seasons = Season::all();

        return view('admin.pages.season.index', ['seasons' => $seasons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.season.create');
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
            'year' => 'required|unique:App\Models\Season,year',
        ]);

        $season = Season::create([
            'year' => $request->year
        ]);
        return redirect('admin/season')->with('status', 'Tahun Ajaran Berhasil Ditambahkan!');
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
        
        $season = Season::find($id);
        
        return view('admin.pages.season.edit', ['season' => $season]);
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
            'year' => ['required'],
        ]);
        $season = Season::find($id);
        $season->year = $request->year;
        $season->save();

        return redirect('admin/season')->with('status', 'Tahun ajaran Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $season = Season::where('year', $id)->first();
        try {
            $season->delete();

            return redirect('admin/season')->with('status', 'Tahun ajaran Berhasil Dihapus!');
        } catch (Exception $e) {
            return redirect('admin/season')->with('status', 'Tahun ajaran Gagal Dihapus!');
        }
    }
}
