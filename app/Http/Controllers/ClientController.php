<?php

namespace App\Http\Controllers;

use App\Article;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function add(Request $request)
    {
        $articles = Article::select(['title', 'text', 'updated_at'])->get();

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
        ]);

        if ($validator->fails()) {
            return redirect('/food')
                ->withInput()
                ->withErrors($validator);
        }

        $client = new Client();
        $client->name = $request->name;
        $client->surname = $request->surname;
        $client->email = $request->email;
        $client->save();

        return view('startpage')->with([
            'articles' => $articles
        ]);
    }


}
