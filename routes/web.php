<?php

use App\Http\Controllers\Grade\GradeController;
use App\Http\Controllers\Section\SectionController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Lecture\LectureController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Subject\SubjectController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('dashboard.index');
});
//url : learnschool/dashboard/grades
// name : dash.grade.index
Route::prefix('learnschool/')->group(function(){
Route::prefix('dashboard/')->name('dash.')->group(function(){


    Route::prefix('grades/')->controller(GradeController::class)->name('grade.')->group(function(){
        Route::get('/' , 'index')->name('index');
        Route::get('/getdata' , 'getdata')->name('getdata');
        Route::get('/getactive' , 'getactive')->name('getactive');
        Route::get('/getactivesection' , 'getactivesection')->name('getactive.section');
        Route::get('/getactivestage' , 'getactivestage')->name('getactive.stage');
        Route::post('/add' , 'add')->name('add');
        Route::post('/changemaster' , 'changemaster')->name('changemaster');
        Route::post('/addsection' , 'addsection')->name('addsection');
        Route::get('/create','create')->name('create');

    });

      Route::prefix('teachers/')->controller(TeacherController::class)->name('teacher.')->group(function(){
        Route::get('/' , 'index')->name('index');
        Route::get('/getdata' , 'getdata')->name('getdata');
        Route::post('/update' , 'update')->name('update');
        Route::post('/delete' , 'delete')->name('delete');
        Route::post('/active' , 'active')->name('active');
        Route::post('/add' , 'add')->name('add');


    });

      Route::prefix('lectures/')->controller(LectureController::class)->name('lecture.')->group(function(){
        Route::get('/' , 'index')->name('index');
        Route::get('/getdata' , 'getdata')->name('getdata');
        Route::post('/update' , 'update')->name('update');
        Route::post('/delete' , 'delete')->name('delete');
        Route::post('/active' , 'active')->name('active');
        Route::post('/add' , 'add')->name('add');


    });

    Route::prefix('sections/')->controller(SectionController::class)->name('section.')->group(function(){
        Route::get('/' , 'index')->name('index');
        Route::get('/getdata' , 'getdata')->name('getdata');
        Route::post('/add' , 'add')->name('add');
        Route::post('/changestatus' , 'changestatus')->name('changestatus');

    });

     Route::prefix('students/')->controller(StudentController::class)->name('student.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/getdata', 'getdata')->name('getdata');
                Route::get('/getdata/lectures', 'getdataLectures')->name('getdata.lectures');
                Route::get('/lectures/{id}', 'lectures')->name('lectures');
                Route::get('/download/{filename}', 'download')->name('download');
                Route::get('/export', 'export')->name('export');
                Route::post('/import', 'import')->name('import');
                Route::post('/add', 'add')->name('add');
                Route::post('/update', 'update')->name('update');
                Route::post('/delete', 'delete')->name('delete');
                Route::post('/active', 'active')->name('active');
            });

   Route::prefix('subjects/')->controller(SubjectController::class)->name('subject.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/getdata', 'getdata')->name('getdata');
                Route::get('/getdata/lectures', 'getdataLectures')->name('getdata.lectures');
                Route::get('/lectures/{id}', 'lectures')->name('lectures');
                Route::get('/download/{filename}', 'download')->name('download');
                Route::post('/add', 'add')->name('add');
                Route::post('/update', 'update')->name('update');
                Route::post('/delete', 'delete')->name('delete');
                Route::post('/active', 'active')->name('active');
            });


    });
});




