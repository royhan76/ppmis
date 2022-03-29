<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Article;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $datas['article'] = DB::table('articles')->paginate('3');
        // $newData = array($data);

        $data2 = Article::paginate('3');
        $data1 = Article::paginate('1');

        $dataArray = array();
        $num = 0;

        // foreach ($data2 as $data) {
        //     $dataArray[$num]["title"] = $data->title;
        //     $dataArray[$num]["content"] = $data->content;
        //     $num++;
        // }
        // // $tdata = json_encode($dataArray, true);
        // $data3 = response()->json($dataArray);
        // print_r($data3['title']);

        // return  view('layouts.home.home', compact('tdata', json_decode($tdata), 'data1'));
        return  view('layouts.home.home', compact('data2', 'data1'));
    }
    public function articleDetail($id)
    {
        $data4 = Article::find($id);

        return view('layouts.home.detailArticle', compact('data4'));
    }
}
