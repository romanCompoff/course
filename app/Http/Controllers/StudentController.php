<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function passport()
    {
        $user_id = auth()->user()->id;
        return view('study.passport', ['user_id' => $user_id]);
    }
}
