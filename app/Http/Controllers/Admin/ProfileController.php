<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = Profile::first();
        return view('admin.pages.profile.index', ['profile' => $profile]);
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
        //
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
        $profile = Profile::first();
        return view('admin.pages.profile.edit', ['profile' => $profile]);
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
        // return $request;
        $validated = $request->validate([
            'logo' => 'image|max:1024',
            'title' => 'required',
            'image' => 'image|max:1024',
            'registration' => 'max:1024',
            'content' => 'required'
        ]);

        $filenameLogo = '';

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');

            $filenameLogo = random_int(1000, 9999) . '-' . time() . '.' . $file->getClientOriginalExtension();

            Storage::disk('s3')->put('ppmis/images/profile/' . $filenameLogo, file_get_contents($file));

            Storage::disk('s3')->delete('ppmis/images/profile/' . $request->oldlogo);
        }

        $filenameRegistration = '';

        if ($request->hasFile('registration')) {
            $file = $request->file('registration');

            $filenameRegistration = random_int(1000, 9999) . '-' . time() . '.' . $file->getClientOriginalExtension();

            Storage::disk('s3')->put('ppmis/images/profile/' . $filenameRegistration, file_get_contents($file));

            Storage::disk('s3')->delete('ppmis/images/profile/' . $request->oldregistration);
        }

        $filenameImage = '';

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $filenameImage = random_int(1000, 9999) . '-' . time() . '.' . $file->getClientOriginalExtension();

            Storage::disk('s3')->put('ppmis/images/profile/' . $filenameImage, file_get_contents($file));

            Storage::disk('s3')->delete('ppmis/images/profile/' . $request->oldimage);
        }

        $profile = Profile::find($id);
        $profile->title = $request->title;
        if ($filenameLogo != '') $profile->logo = $filenameLogo;
        if ($filenameRegistration != '') $profile->registration = $filenameRegistration;
        if ($filenameImage != '') $profile->image = $filenameImage;
        $profile->content = $request->content;
        $profile->save();

        return redirect('admin/profile')->with('status', 'Profile Berhasil Ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
