<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\News;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redirect;

class NewsController extends Controller
{
    private $columns = ['Title','content','author','published'];
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
        // $news = new News();
        // $news->Title = $request->Title;
        // $news->content = $request->content;
        // $news->author = $request->author;
        // $published =$request->published;
        // if($published){
        //     $news->published=true;
        // }
        // else{
        //     $news->published=false;
        // }
         

        // $news->save();
        // return "news data added successfully";

        $request->validate([
            'Title'=>'required|string',
            'content'=>'required|string|max:100',
            'author'=>'required|string|max:100',

            
        ]);
       
        $data = $request->only($this->columns);
        $data['published'] = isset($data['published'])? true : false;
        News:: create($data);
        return 'done' ;

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = News ::findOrFail($id);
        return view('newsDetails',compact('news'));
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
        $data = $request->only($this->columns);
        $data['published'] = isset($data['published'])? true:false;

        News::where('id', $id)->update($data);

      
         return "Data Updated Successfully";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):RedirectResponse 
    {
        news::where('id',$id)->delete();
        return Redirect('showNews') ;
    }

    public function delete(string $id):RedirectResponse
    {
        News::where('id',$id)->forceDelete();
        News::where('id',$id)->delete();
        return redirect('showNews');
         
    }


    public function trashed( ){
        $news = News::onlyTrashed()->get();
        return view('trashedNews',compact(('news')));
    }

    public function restore(String $id):RedirectResponse
    {
        News::where('id',$id)->restore();
        return redirect('showNews');
    }
}
