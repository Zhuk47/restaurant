<?php

namespace App\Http\Controllers;

use App\Article;
use App\Guest;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Client;
use Illuminate\Support\Facades\Validator;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->latest()->paginate(5);
        return view('articles.index', compact('articles'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required',
            'text' => 'required',
        ]);
        $article = Article::create($request->all());
        foreach (Guest::all() as $guest) {
            $message = "
            Доброго времени суток, $guest->name!\r\n
            Рады сообщить Вам о новых событиях в нашем ресторане! А именно:\r\n" .
            $article->text;
            $to = $guest->email;
            $from = "restaurant@rest.ua";
            //$subject = "=?utf-8?B?" . base64_encode($subject) . "?=";
            $subject = $article->title;
            $headers = "From: $from\r\nReply-to: $from\r\nContent-type: text/plain; charset=utf-8\r\n";
            mail($to, $subject, $message, $headers);
        }
        return redirect()->route('articles.index')
            ->with('success', 'Article created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'title' => 'required',
            'text' => 'required',
        ]);
        Article::find($id)->update($request->all());
        return redirect()->route('articles.index')
            ->with('success', 'Article updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Article::find($id)->delete();
        return redirect()->route('articles.index')
            ->with('success', 'Article deleted successfully');
    }

}