<?php

namespace App\Http\Controllers;

use App\Article;
use App\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Client;


class GuestController extends Controller
{
    public function add(Request $request)
    {
        //$articles = Article::select(['title', 'text', 'updated_at'])->get();

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
        ]);

        if ($validator->fails()) {
            return redirect('/food')
                ->withInput()
                ->withErrors($validator);
        }

        $client = new Guest();
        $client->name = $request->name;
        $client->surname = $request->surname;
        $client->email = $request->email;
        $client->save();

        return redirect()->route('start')
            ->with('message', 'Article created successfully');
    }
}
