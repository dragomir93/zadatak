<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Resources\Article as ArticleResource;
use App\Http\Resources\ArticleCollection;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return new ArticleCollection(Article::all());
    }

    public function show($id)
    {
        return new  ArticleResource(Article::findOrFail($id));
    }
    
    public function store(Request $request) {

        $articles = Article::create([
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $request->image,
            'price'       => $request->price,
        ]);

        $resource = new ArticleResource($articles);
        return $resource->response()->setStatusCode(200);
    }

    public function update(Request $request,$id)
    {

        $articles = Article::where('id',$id)->first();

        $articles->update([
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $request->image,
            'price'       => $request->price,
        ]);

        return response()->json(new ArticleResource($articles), 200);
    }

    public function delete($id) {

        $articles = Article::where('id',$id);

        $articles = $articles->delete();

        return response()->json();

    }

    public function searchByName($title){
        return new ArticleCollection(Article::where('title','like',"%{$title}%")->get());
    }
}

