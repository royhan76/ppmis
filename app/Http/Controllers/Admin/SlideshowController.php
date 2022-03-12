<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slideshow;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SlideshowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slideshows = Slideshow::orderBy('order')->get();

        return view('admin.pages.slideshow.index', ['slideshows' => $slideshows]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.slideshow.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->file('image');
        $validated = $request->validate([
            'image' => 'required|image|max:1024',
            'order' => 'required|numeric|unique:App\Models\Slideshow,order',
        ]);

        $filename = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $filename = random_int(1000, 9999) . '-' . time() . '.' . $file->getClientOriginalExtension();

            Storage::disk('s3')->put('ppmis/images/slideshow/' . $filename, file_get_contents($file));
        }


        $slideshow = Slideshow::create([
            'image' => $filename,
            'order' => $request->order,
        ]);

        return redirect('admin/slideshow')->with('status', 'Slideshow Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slideshow = Slideshow::find($id);
        //return $slideshow;
        return view(
            'admin.pages.slideshow.edit',
            [
                'slideshow' => $slideshow
            ],
        );
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
        // return $request->file('image');
        $validated = $request->validate([
            'image' => 'image|max:1024',
            'order' => ['required', 'numeric', Rule::unique('slideshows')->ignore($id)],
        ]);

        $filename = '';

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $filename = random_int(1000, 9999) . '-' . time() . '.' . $file->getClientOriginalExtension();

            Storage::disk('s3')->put('ppmis/images/slideshow/' . $filename, file_get_contents($file));

            Storage::disk('s3')->delete('ppmis/images/slideshow/' . $request->oldimage);
        }

        $slideshow = Slideshow::find($id);
        if ($filename != '') $slideshow->image = $filename;
        $slideshow->order = $request->order;
        $slideshow->save();




        return redirect('admin/slideshow')->with('status', 'Slideshow Berhasil Ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slideshow = Slideshow::find($id);

        Storage::disk('s3')->delete('ppmis/images/slideshow/' . $slideshow->image);
        $slideshow->delete();
        return redirect('admin/slideshow')->with('status', 'Slideshow Berhasil Dihapus!');
    }
}
