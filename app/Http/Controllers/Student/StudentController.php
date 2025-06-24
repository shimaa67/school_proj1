<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Spatie\SimpleExcel\SimpleExcelReader;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Spatie\SimpleExcel\SimpleExcelWriter;

class StudentController extends Controller
{
    function index()
    {
        $grades = Grade::all();
        $sections = Section::all();
        return view('dashboard.student.index', compact('grades', 'sections'));
    }

    function getdata(Request $request)
    {
        $grades = Student::query();

        return DataTables::of($grades)
            ->addIndexColumn()
            ->addColumn('email', function ($qur) {
                return $qur->user->email;
            })
            ->addColumn('grade', function ($qur) {
                return $qur->grade->name;
            })
            ->addColumn('section', function ($qur) {
                return $qur->section->name;
            })
            ->addColumn('gender', function ($qur) {
                if ($qur->gender == 'f') {
                    return '<span class="badge bg-info text-white">ذكر</span>
';
                }
                return '<span class="badge text-white" style="background-color:#c74375;">انثى</span>
';
            })       ->addColumn('status', function ($qur) {
                if ($qur->status == 'active') {
                    return '<span class="badge bg-success text-white">مفعل</span>
';
                }
                return '<span class="badge bg-secondary text-white">معطل</span>
';})
            ->addColumn('action', function ($qur) {
                $data_attr = ' ';
                 $data_attr .= 'data-id="' . $qur->id . '" ';
                $data_attr .= 'data-first_name="' . $qur->first_name . '" ';
                $data_attr .= 'data-last_name="' . $qur->last_name . '" ';
                $data_attr .= 'data-email="' . $qur->user->email . '" ';
                $data_attr .= 'data-gender="' . $qur->gender . '" ';
                  $data_attr .= 'data-date-of-birth="' . $qur->date_of_birth . '" ';
                   $data_attr .= 'data-parent_name="' . $qur->parent_name . '" ';
                $data_attr .= 'data-parent_phone="' . $qur->parent_phone . '" ';
                $data_attr .= 'data-grade="' . $qur->grade->tag. '" ';
                $data_attr .= 'data-section="' . $qur->section->name . '" ';


                $action = '';
                $action .= '<div class="d-flex align-items-center gap-3 fs-6">';

                $action .= '<a ' . $data_attr . ' data-bs-toggle="modal" data-bs-target="#update-modal" class="text-warning update_btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-pencil-fill "></i></a>';
                if ($qur->status == 'active') {
                    $action .= '     <a data-id="' . $qur->id . '"  data-url="' . route('dash.student.delete') . '" class="text-danger delete-btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>';
                } else {
                    $action .= '     <a data-id="' . $qur->id . '"  data-url="' . route('dash.student.active') . '" class="text-success active-btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="fadeIn animated bx bx-check-square"></i></a>';
                }
                return $action;
                 $action .= '</div>';
            })
            ->rawColumns(['action', 'gender', 'lectures','status'])
            ->make(true);
    }



    function add(Request $request)
    {

        //dd($request->all());
        $request->validate([
            'first_name'   => ['required', 'string', 'max:255'],
            'last_name'   => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email'],
            'date_of_birth'   => ['required', 'date'],
            'gender'   => ['required', 'in:m,fm'],
            'parent_name'   => ['required', 'string', 'max:255'],
            'parent_phone'  => ['required'],
            'grade'  => ['required',  'exists:grades,id'],
            'section'   => ['required', 'exists:sections,id'],
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


        $grade = Grade::query()->where('id', $request->grade)->first();
        $section = Section::query()->where('name', $request->section)->first();

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make('1234'),
        ]);

        Student::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'parent_name' => $request->parent_name,
            'parent_phone' => $request->parent_phone,
            'grade_id' => $grade->id,
            'section_id' => $section->id,
            'user_id' => $user->id,
        ]);

        return response()->json([
            'success' => 'تمت العملية بنجاح'
        ]);
    }

    function export()
    {
        $dir = public_path('exports');

        if (!File::exists('exports')) {
            File::makeDirectory($dir, 0755, true);
        }

        $path = public_path('exports\students_export_' . time() . '.csv');


        $students = Student::query()->with(['grade', 'user', 'section'])->get();

        SimpleExcelWriter::create($path)->addHeader([
            'First Name',
            'Last Name',
            'Parent Name',
            'Parent Phone',
            'Gender',
            'Email',
            'Date Of Birth',
            'Grade',
            'Section',
        ])->addRows($students->map(function ($student) {
            return [
                $student->first_name,
                $student->last_name,
                $student->parent_name,
                $student->parent_phone,
                $student->gender,
                $student->user->email,
                $student->date_of_birth,
                $student->grade->name,
                $student->section->name,
            ];
        }));
        return response()->download($path)->deleteFileAfterSend(true);
    }

    function import(Request $request)
    {
        $name = 'LearnSchool_' . time() . '_' . rand() . '.' . $request->file('excel')->getClientOriginalExtension();
        $request->file('excel')->move(public_path('uploads/files/excel'), $name);
        $path = public_path('uploads/files/excel') . DIRECTORY_SEPARATOR . $name;

        SimpleExcelReader::create($path)->getRows()->each(function (array $row) {
            $val = Validator::make($row, [
                'Email' => 'required|email',
            ]);

            if ($val->fails()) {
                Log::warning('تم تجاوز هذا السطر بسبب أخطاء في البيانات', ['row' => $row]);
                return;
            }

            $user = User::query()->where('email', $row['Email'])->first();

            if (!$user) {
                $password = Str::random(10);
                $user = User::create([
                    'email' => $row['Email'],
                    'password' => Hash::make($password),
                ]);
            }

            $grade = Grade::query()->where('name', $row['Grade'])->first();
            $section = Section::query()->where('name', $row['Section'])->first();
            if (!$grade || !$section) {
                Log::warning('تم تجاوز هذا السطر بسبب أخطاء في البيانات', ['row' => $row]);
                return;
            }
            Student::query()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'first_name' => $row['First Name'],
                    'last_name' => $row['Last Name'],
                    'parent_name' => $row['Parent Name'],
                    'parent_phone' => $row['Parent Phone'],
                    'gender' => $row['Gender'],
                    'date_of_birth' => $row['Date Of Birth'],
                    'grade_id' => $grade->id,
                    'section_id' => $section->id,
                ]
            );
        });

        return response()->json(['success' => 'تم الاستيراد بنجاح']);
    }




    function update(Request $request)
    {
    $student = Student::findOrFail($request->id);

   $grade = Grade::query()->where('id', $request->grade)->first();
        $section = Section::query()->where('name', $request->section)->first();

        $student->update([
           'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'parent_name' => $request->parent_name,
            'parent_phone' => $request->parent_phone,
            'grade_id' => $grade->id,
            'section_id' => $section->id,

        ]);

        return response()->json([
            'success' => 'تمت العملية بنجاح'
        ]);
    }

    function delete(Request $request)
    {

        $student= Student::query()->findOrFail($request->id);
        if ($student) {
            $student->update([
                'status' => 'inactive',
            ]);
        }
        return response()->json([
            'success' => 'تمت العملية بنجاح'
        ]);
    }

    function active(Request $request)
    {
        $student= Student::query()->findOrFail($request->id);
        if ($student) {
            $student->update([
                'status' => 'active',
            ]);
        }
        return response()->json([
            'success' => 'تمت العملية بنجاح'
        ]);
    }
}
