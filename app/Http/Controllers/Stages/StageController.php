<?php

namespace App\Http\Controllers\Stages;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Http\Request;
use App\Models\Stage;


class StageController extends Controller
{
    // function index(){
    //     return view('dashboard.grade.index');
    // }
    // function create(){
    //     $stages=Stage::all();
    //     return view('dashboard.grade.create',compact('stages'));
    // }
    // function add(Request $request){
    //    $request->validate([
    //     'name' => 'required|unique:grades,name',
    //     'stage'=>'required'
    //    ]);

    //    Grade::create([
    //     'name'=>$request->name,
    //     'stage_id'=>$request->stage
    //    ]);
    //    return'تمت الاضافة بنجاح';

    // }

}
