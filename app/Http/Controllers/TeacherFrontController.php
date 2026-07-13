<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherFrontController extends Controller
{
    public function index()
    {
        $teachers = Teacher::orderBy('name')->paginate(12);
        return view('guru.index', compact('teachers'));
    }
}
