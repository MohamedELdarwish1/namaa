<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Comments;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
        ]);

        Comments::create([
            'body' => $request->body,
            'articles_id' =>$request->articles_id,
            'user_id'   => $request->user_id,

        ]);

        return redirect()->back()->with('success','comment has been created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Articles::find($id);
        $comments = Comments::where('articles_id',$id)->get();
        return view('Comments.show',['comments'=>$comments,'article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
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
