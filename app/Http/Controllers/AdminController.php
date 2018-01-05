<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function show($id)
    {

        return view('adminViews/employeeinfo', ['id' => $id]);
    }

    public function deleteEmployee($id)
    {
        \DB::delete('DELETE FROM users WHERE id = ?', [$id]);
        return view('adminViews/employeebase');
    }

    protected function delete($id)
    {

    }
}
