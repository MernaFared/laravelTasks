<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use GuzzleHttp\Client;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news =News ::get();

        return view('news',compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('add-news-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $news = new News();
        $news->Title = $request->Title;
        $news->content = $request->content;
        $news->author = $request->author;
        $published =$request->published;
        if($published){
            $news->published=true;
        }
        else{
            $news->published=false;
        }
         

        $news->save();
        return "news data added successfully";







    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $news = News::findOrFail( $id);
        return view('updateNews',compact('news'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
