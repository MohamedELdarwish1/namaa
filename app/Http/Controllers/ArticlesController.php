<?php

namespace App\Http\Controllers;

use App\Events\ReviewArticles;
use App\Models\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // you can use cache if you want

      /*  if (Cache::has('article_list')) {
            $articles = Cache::get('article_list');
        } else {
            $articles = Articles::orderBy('id','desc')->paginate(10);
            Cache::put('article_list', $articles, now()->addSecond(5));
        }   */

        $i = 0;
        $articles = Articles::orderBy('id','desc')->paginate(10);
        return view('Articles.index', compact('articles','i'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

      $atricle =  Articles::create([
            'title' => $request->title,
            'description' =>$request->description,
            'user_id'   => Auth::id(),

        ]);

        // uncomment this event if u want to use it     *note* make sure you have setup mailpit in your local env
        
        // event(new ReviewArticles($atricle));

        return redirect()->route('articles.index')->with('success','Article has been created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Articles $article)
    {

        return view('Articles.show',['article'=>$article]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Articles $article)
    {
        return view('Articles.edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Articles $article)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',

        ]);

        $article->update($request->all());

        return redirect()->route('articles.index')->with('success','Article updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Articles $article)
    {
        $article->delete();

        return redirect()->route('articles.index')->with('success','Article deleted successfully');

    }


    public function Approve(Request $request)
    {
        $article = Articles::find($request->article_id);

        $article->update(['approved' => true]);
        return redirect()->back()->with('success','Article approved successfully');
    }




    public function Article()
    {
       $article = Articles::with('comments','comments.users')->get();
       return response()->json([
        'success' => true,
        'message' => '',
        'data' => [
            'articles'  =>$article
        ],
    ]);
    }
}
