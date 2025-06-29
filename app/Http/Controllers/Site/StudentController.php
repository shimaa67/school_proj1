<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    function index(){
        $user=Auth::user();
        $subjects= $user->student->grade->subject;
        return view('studets.index', compact('user', 'subjects'));
    }

    function subject($id){
        $subjects=Subject::query()->findOrFail($id);
        return view('studets.subject' , compact('subjects'));
    }
}
