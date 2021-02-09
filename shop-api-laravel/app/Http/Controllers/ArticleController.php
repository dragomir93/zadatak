<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Resources\Article as ArticleResource;
use App\Http\Resources\ArticleCollection;

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
    
}

