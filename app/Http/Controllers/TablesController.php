<?php

namespace App\Http\Controllers;

use App\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TablesController extends Controller
{
    public function index()
    {
        $tables = Table::orderBy('id', 'asc')->get();

        return view('tables', [
            'tables' => $tables
        ]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'serial' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect('/tables')
                ->withInput()
                ->withErrors($validator);
        }

        $table = new Table;
        $table->serial = $request->serial;
        $table->save();

        return redirect('/tables');
    }

    public function delete(Table $table)
    {
        $table->delete();

        return redirect('/tables');
    }
}
