<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class StartPageController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->select(['title', 'text', 'updated_at'])->get();

        return view('startpage')->with([
            'articles' => $articles
        ]);
    }
}
