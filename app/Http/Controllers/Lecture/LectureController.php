<?php

namespace App\Http\Controllers\Lecture;

use App\Http\Controllers\Controller;
use App\Models\Lucture;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class LectureController extends Controller
{
    function index()
    {
        $subjects = Subject::all();
        $teachers = Teacher::all();
        return view('dashboard.lecture.index', compact('subjects', 'teachers'));
    }

    function getdata(Request $request)
    {

        $grades = Lucture::query();

        return DataTables::of($grades)
            ->filter(function ($qur) use ($request) {
                if ($request->get('title')) {
                    // like %...% , %.. , ..%
                    $qur->where('title', 'like', '%' .  $request->get('title') . '%');
                }
            })
            ->addIndexColumn()
            ->addColumn('subject', function ($qur) {
                return $qur->subject->title;
            })
            ->addColumn('teacher', function ($qur) {
                return $qur->teacher->name;
            })
            ->addColumn('link', function ($qur) {
                return '<a class="btn btn-info btn-sm" target="_blank" href="' . $qur->link . '">رابط المحاضرة</a>';

            })->addColumn('status', function ($qur) {
                if ($qur->status == 'active') {
                    return '<span class="badge bg-success text-white">مفعل</span>
';
                }
                return '<span class="badge bg-secondary text-white">معطل</span>
';
            })
            ->addColumn('action', function ($qur) {
                $data_attr = ' ';
                $data_attr .= 'data-id="' . $qur->id . '" ';
                $data_attr .= 'data-title="' . $qur->title . '" ';
                $data_attr .= 'data-desc="' . $qur->desc . '" ';
                $data_attr .= 'data-teacher="' . $qur->teacher->id . '" ';
                $data_attr .= 'data-subject="' . $qur->subject->id . '" ';
                $data_attr .= 'data-link="' . $qur->link . '" ';

                $action = '';
                $action .= '<div class="d-flex align-items-center gap-3 fs-6">';

                $action .= '<a ' . $data_attr . ' data-bs-toggle="modal" data-bs-target="#update-modal" class="text-warning update_btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-pencil-fill "></i></a>';
                if ($qur->status == 'active') {
                    $action .= '     <a data-id="' . $qur->id . '"  data-url="' . route('dash.lecture.delete') . '" class="text-danger delete-btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>';
                } else {
                    $action .= '     <a data-id="' . $qur->id . '"  data-url="' . route('dash.lecture.active') . '" class="text-success active-btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="fadeIn animated bx bx-check-square"></i></a>';
                }

                $action .= '</div>';

                return $action;
            })
            ->rawColumns(['teacher', 'subject', 'link', 'action','status'])
            ->make(true);
    }

    function add(Request $request)
    {
        $request->validate([
            'title'   => ['required', 'string', 'max:255'],
            'desc'  => ['required', 'string', 'min:20'],
            'subject'  => ['required', 'exists:subjects,id'],
            'teacher'   => ['required', 'exists:teachers,id'],
            'link'   => ['required', 'url'],
        ]);

        Lucture::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'subject_id' => $request->subject,
            'teacher_id' => $request->teacher,
            'link' => $request->link,
        ]);

        return response()->json([
            'success' => 'تمت العملية بنجاح'
        ]);
    }


    
    function update(Request $request)
    {
    $lecture = Lucture::findOrFail($request->id);

        $request->validate([
            'title'   => ['required', 'string', 'max:255'],
            'desc'  => ['required',],
            'teacher'   => ['required'],
            'subject'   => ['required',],
            'link'   => ['required',],

        ],);





        $lecture->update([
            'title' => $request->title,
            'desc' => $request->desc,
            'teacher_id' => $request->teacher,
            'subject_id' => $request->subject,
            'link' => $request->link,

        ]);

        return response()->json([
            'success' => 'تمت العملية بنجاح'
        ]);
    }

    function delete(Request $request)
    {

        $lecture = Lucture::query()->findOrFail($request->id);
        if ($lecture) {
            $lecture->update([
                'status' => 'inactive',
            ]);
        }
        return response()->json([
            'success' => 'تمت العملية بنجاح'
        ]);
    }

    function active(Request $request)
    {
        $lecture = Lucture::query()->findOrFail($request->id);
        if ($lecture) {
            $lecture->update([
                'status' => 'active',
            ]);
        }
        return response()->json([
            'success' => 'تمت العملية بنجاح'
        ]);
    }
}
