<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $articles = null;
        if (Auth::user()->role == 'ADMIN') $articles = Article::all();
        else $articles = Article::where('user_id', Auth::user()->id)->get();

        
        return view('admin.pages.article.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.pages.article.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $validated = $request->validate([
            'image' => 'required|image|max:1024',
            'title' => 'required',
            'category' => 'required',
            'caption' => 'required',
            'content' => 'required'
        ]);

        $filename = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $filename = random_int(1000, 9999) . '-' . time() . '.' . $file->getClientOriginalExtension();

            Storage::disk('s3')->put('ppmis/images/article/' . $filename, file_get_contents($file));
        }

        $slideshow = Article::create([
            'image' => $filename,
            'title' => $request->title,
            'category_id' => $request->category,
            'caption' => $request->caption,
            'content' => $request->content,
            'user_id' => Auth::user()->id
        ]);

        return redirect('admin/article')->with('status', 'Article berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        return view('admin.pages.article.detail', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        $categories = Category::all();

        return view('admin.pages.article.edit', ['article' => $article, 'categories' => $categories]);
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
            'image' => 'image|max:1024',
            'title' => 'required',
            'category' => 'required',
            'caption' => 'required',
            'content' => 'required'
        ]);

        $filename = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $filename = random_int(1000, 9999) . '-' . time() . '.' . $file->getClientOriginalExtension();

            Storage::disk('s3')->put('ppmis/images/article/' . $filename, file_get_contents($file));

            Storage::disk('s3')->delete('ppmis/images/article/' . $request->oldimage);
        }

        $article =  Article::find($id);
        if ($filename != '') $article->image = $filename;
        $article->title = $request->title;
        $article->category_id = $request->category;
        $article->caption = $request->caption;
        $article->content = $request->content;
        $article->save();
        return redirect('admin/article')->with('status', 'Article berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        Storage::disk('s3')->delete('ppmis/images/article/' . $article->image);
        return redirect('admin/article')->with('status', 'Article berhasil dihapus');
    }
}
