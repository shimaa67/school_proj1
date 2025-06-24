<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Lucture;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SubjectController extends Controller
{ function index()
    {
        $teachers = Teacher::all();
        $grades = Grade::all();
        return view('dashboard.subject.index', compact('teachers', 'grades'));
    }

    function getdata(Request $request)
    {
        $grades = Subject::query();

        return DataTables::of($grades)
            ->addIndexColumn()
            ->addColumn('teacher', function ($qur) {
                return $qur->teacher->name;
            })->addColumn('status', function ($qur) {
                if ($qur->status == 'active') {
                    return '<span class="badge bg-success text-white">مفعل</span>
';
                }
                return '<span class="badge bg-secondary text-white">معطل</span>
';
            })
            ->addColumn('grade', function ($qur) {
                return $qur->grade->name;
            })
            ->addColumn('book', function ($qur) {
                return '    <a href="'.route('dash.subject.download' , $qur->book).'" class="btn btn-primary btn-sm"
                            >
                            كتاب "' . $qur->title . '"  ' . $qur->grade->name . '
                        </a>';
            })
            ->addColumn('lectures', function ($qur) {
                return '    <a href="'.route('dash.subject.lectures' , $qur->id).'" class="btn btn-primary btn-sm"
                            >عرض جميع المحاضرات</a>';
            })
            ->addColumn('action', function ($qur) {
                $data_attr = ' ';
                 $data_attr .= 'data-id="' . $qur->id . '" ';
                $data_attr .= 'data-title="' . $qur->title . '" ';
                $data_attr .= 'data-grade="' . $qur->grade->tag . '" ';
                $data_attr .= 'data-teacher="' . $qur->teacher->id . '" ';
                 $data_attr .= 'data-book="' . $qur->book. '" ';


                      $action = '';
                $action .= '<div class="d-flex align-items-center gap-3 fs-6">';

                $action .= '<a ' . $data_attr . ' data-bs-toggle="modal" data-bs-target="#update-modal" class="text-warning update_btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-pencil-fill "></i></a>';
                if ($qur->status == 'active') {
                    $action .= '     <a data-id="' . $qur->id . '"  data-url="' . route('dash.subject.delete') . '" class="text-danger delete-btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>';
                } else {
                    $action .= '     <a data-id="' . $qur->id . '"  data-url="' . route('dash.subject.active') . '" class="text-success active-btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="fadeIn animated bx bx-check-square"></i></a>';
                }
                return $action;
                 $action .= '</div>';
            })
            ->rawColumns(['action', 'book' , 'lectures','status'])
            ->make(true);
    }

    function add(Request $request)
    {


        $request->validate([
            'title'   => ['required', 'string', 'max:255'],
            'teacher'  => ['required', 'exists:teachers,id'],
            'grade'  => ['required',  'exists:grades,id'],
            'book'   => ['required', 'mimes:pdf', 'max:5120'],
        ],  [
            'title.required' => 'عنوان المادة مطلوب.',
            'title.string' => 'عنوان المادة يجب أن يكون نصاً.',
            'teacher.required' => 'يرجى اختيار المدرس.',
            'teacher.exists' => 'المعلم المحدد غير موجود.',
            'book.required' => 'يرجى رفع كتاب المادة.',
            'book.mimes' => 'يجب أن يكون الكتاب بصيغة PDF فقط.',
            'book.max' => 'أقصى حجم للكتاب هو 5 ميجابايت.',
            'grade.required' => 'يرجى إدخال المرحلة الدراسية.',
            'grade.string' => 'المرحلة الدراسية يجب أن تكون نصاً.',
        ]);


        $name = 'LearnSchool_' . time() . '_' . rand() . '.' . $request->file('book')->getClientOriginalExtension();
        $request->file('book')->move(public_path('uploads\books'), $name);

        $grade = Grade::query()->where('tag', $request->grade)->first();

        Subject::create([
            'title' => $request->title,
            'teacher_id' => $request->teacher,
            'grade_id' => $grade->id,
            'book' => $name,
        ]);

        return response()->json([
            'success' => 'تمت العملية بنجاح'
        ]);
    }

    function download($filename) {
        $path = public_path('uploads/books/' . $filename );

        return response()->download($path);
    }

      function lectures($id) {
        $subject = Subject::query()->findOrFail($id);
        return view('dashboard.subject.lectures' , compact('subject'));
    }

     function getdataLectures(Request $request)
    {
              //dd($request->all());
        $grades = Lucture::query()->where('subject_id' , $request->id);
       //dd($grades);
        return DataTables::of($grades)
            ->filter(function ($qur) use ($request) {
                if($request->get('title')){
                    // like %...% , %.. , ..%
                 $qur->where('title' , 'like' , '%' .  $request->get('title') . '%');
                }
            })
            ->addIndexColumn()
            ->addColumn('subject', function ($qur) {
                return $qur->subject->title;
            })->addColumn('status', function ($qur) {
                if ($qur->status == 'active') {
                    return '<span class="badge bg-success text-white">مفعل</span>
';
                }
                return '<span class="badge bg-secondary text-white">معطل</span>
';
            })
            ->addColumn('teacher', function ($qur) {
                return $qur->teacher->name;
            })
            ->addColumn('link', function ($qur) {
                return '<a class="btn btn-info btn-sm" target="_blank" href="'. $qur->link .'">رابط المحاضرة</a>';
            })
            ->rawColumns(['status', 'action' ,'link' ])
            ->make(true);
    }


function update(Request $request)
{
    if (!$request->id) {
        return response()->json(['error' => 'لم يتم إرسال معرف المادة'], 400);
    }

    $subject = Subject::find($request->id);
    if (!$subject) {
        return response()->json(['error' => 'المادة غير موجودة'], 404);
    }

    $grade = Grade::where('tag', $request->grade)->first();
    if (!$grade) {
        return response()->json(['error' => 'الصف غير موجود'], 404);
    }

    if ($request->hasFile('book')) {
        $name = 'LearnSchool_' . time() . '_' . rand() . '.' . $request->file('book')->getClientOriginalExtension();
        $request->file('book')->move(public_path('uploads/books'), $name);
        $subject->book = $name;
    }

    $subject->update([
        'title' => $request->title,
        'teacher_id' => $request->teacher,
        'grade_id' => $grade->id,
    ]);

    return response()->json(['success' => 'تمت العملية بنجاح']);
}


    function delete(Request $request)
    {

        $subject = Subject::query()->findOrFail($request->id);
        if ($subject) {
            $subject->update([
                'status' => 'inactive',
            ]);
        }
        return response()->json([
            'success' => 'تمت العملية بنجاح'
        ]);
    }


    function active(Request $request) {
        $subject = Subject::query()->findOrFail($request->id);
        if ($subject) {
            $subject->update([
                'status' => 'active',
            ]);
        }
        return response()->json([
            'success' => 'تمت العملية بنجاح'
        ]);
    }
}

