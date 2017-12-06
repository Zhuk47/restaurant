<?php

namespace App\Http\Controllers;

use App\User;


class AdminController extends Controller
{
    protected function delete($id)
    {

    }

    public function show($id)
    {
        return view('adminViews\employeeinfo', ['id' => $id]);
    }

    public function deleteEmployee($id)
    {
        \DB::delete('delete from users where id = ?', [$id]);
        return view('adminViews\employeebase');
    }
}
