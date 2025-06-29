<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class TeacherController extends Controller
{
    function index()
    {


        return view('dashboard.teachers.index');
    }

    function getdata(Request $request)
    {
        // name , phone , email store in table teacher
        $grades = Teacher::select('teachers.*', 'users.email')->join('users', 'users.id', '=', 'teachers.user_id');

        return DataTables::of($grades)
            ->filter(function ($qur) use ($request) {
                if ($request->get('name')) {
                    // like %...% , %.. , ..%
                    $qur->where('teachers.name', 'like', '%' .  $request->get('name') . '%');
                }

                if ($request->get('phone')) {
                    $qur->where('phone', 'like', '%' .  $request->get('phone') . '%');
                }


                if ($request->get('email')) {
                    $qur->where('users.email', 'like', '%' . $request->get('email') . '%');
                }
            })
            ->addIndexColumn()
            ->addColumn('email', function ($qur) {
                return $qur->user->email;
            })
            ->addColumn('status', function ($qur) {
                if ($qur->status == 'active') {
                    return '<span class="badge bg-success text-white">مفعل</span>
';
                }
                return '<span class="badge bg-secondary text-white">معطل</span>
';
            })
            ->addColumn('qual', function ($qur) {
                return $qur->getQualByCode($qur->code);
            })
            ->addColumn('gender', function ($qur) {
                if ($qur->gender == 'm') {

                return '<span class="badge bg-info text-white">ذكر</span>
';
                }

                    return '<span class="badge text-white" style="background-color:#c74375;">انثى</span>
';
            })
            ->addColumn('action', function ($qur) {
                $data_attr = ' ';
                $data_attr .= 'data-id="' . $qur->id . '" ';
                $data_attr .= 'data-name="' . $qur->name . '" ';
                $data_attr .= 'data-email="' . $qur->user->email . '" ';
                $data_attr .= 'data-phone="' . $qur->phone . '" ';
                $data_attr .= 'data-qual="' . $qur->qual . '" ';
                $data_attr .= 'data-spec="' . $qur->spec . '" ';
                $data_attr .= 'data-gender="' . $qur->gender . '" ';
                $data_attr .= 'data-status="' . $qur->status . '" ';
                $data_attr .= 'data-hint-date="' . $qur->hint_date .  '" ';

                $action = '';
                $action .= '<div class="d-flex align-items-center gap-3 fs-6">';

                $action .= '<a ' . $data_attr . ' data-bs-toggle="modal" data-bs-target="#update-modal" class="text-warning update_btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-pencil-fill "></i></a>';
                if ($qur->status == 'active') {
                    $action .= '     <a data-id="' . $qur->id . '"  data-url="' . route('dash.teacher.delete') . '" class="text-danger delete-btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>';
                } else {
                    $action .= '     <a data-id="' . $qur->id . '"  data-url="' . route('dash.teacher.active') . '" class="text-success active-btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="fadeIn animated bx bx-check-square"></i></a>';
                }

                $action .= '</div>';

                return $action;
            })
            ->rawColumns(['status', 'action', 'gender'])
            ->make(true);
    }

    function add(Request $request)
    {
        $request->validate([
            'name'   => ['required', 'string', 'max:255'],
            'email'  => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone'  => ['required',  'unique:teachers,phone'],
            'qual'   => ['required', 'in:d,b,m,dr'],
            'spec'   => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'hint_date' => ['required', 'date',],
        ], [
            'name.required'     => 'الاسم مطلوب.',
            'name.string'       => 'الاسم يجب أن يكون نصاً.',
            'name.max'          => 'الاسم لا يجب أن يتجاوز 255 حرفاً.',

            'email.required'    => 'البريد الإلكتروني مطلوب.',
            'email.email'       => 'يرجى إدخال بريد إلكتروني صحيح.',
            'email.max'         => 'البريد الإلكتروني طويل جداً.',
            'email.unique'      => 'هذا البريد الإلكتروني مستخدم مسبقاً.',

            'phone.required'    => 'رقم الهاتف مطلوب.',
            'phone.regex'       => 'صيغة رقم الهاتف غير صحيحة.',
            'phone.unique'      => 'رقم الهاتف مستخدم مسبقاً.',

            'qual.required'     => 'المؤهل العلمي مطلوب.',
            'qual.in'       => 'القيمة المدخلة للمؤهل العلمي غير صالحة .',

            'spec.required'     => 'التخصص مطلوب.',
            'spec.string'       => 'التخصص يجب أن يكون نصاً.',

            'gender.required'   => 'الجنس مطلوب.',
            'gender.in'         => 'القيمة المدخلة للجنس غير صالحة.',

            'hint_date.required'  => 'تاريخ التعيين مطلوب.',
            'hint_date.date'      => 'صيغة تاريخ التعيين غير صحيحة.',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->phone),
        ]);

        Teacher::create([
            'email' => $request->email,
            'name' => $request->name,
            'qual' => $request->qual,
            'spec' => $request->spec,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'hint_date' => $request->hint_date,
            'user_id' =>  $user->id
        ]);
        return response()->json([
            'success' => 'تمت العملية بنجاح'
        ]);
    }

    function update(Request $request)
    {
        $teacher = Teacher::query()->findOrFail($request->id);
        $user = User::query()->findOrFail($teacher->user_id);

        $request->validate([
            'name'   => ['required', 'string', 'max:255'],
            'email'  => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone'  => ['required', Rule::unique('teachers', 'phone')->ignore($request->id)],
            'qual'   => ['required', 'in:d,b,m,dr'],
            'status'   => ['required', 'in:active,inactive'],
            'spec'   => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'hint_date' => ['required', 'date'],
        ], [
            'name.required'     => 'الاسم مطلوب.',
            'name.string'       => 'الاسم يجب أن يكون نصاً.',
            'name.max'          => 'الاسم لا يجب أن يتجاوز 255 حرفاً.',

            'email.required'    => 'البريد الإلكتروني مطلوب.',
            'email.email'       => 'يرجى إدخال بريد إلكتروني صحيح.',
            'email.max'         => 'البريد الإلكتروني طويل جداً.',
            'email.unique'      => 'هذا البريد الإلكتروني مستخدم مسبقاً.',

            'phone.required'    => 'رقم الهاتف مطلوب.',
            'phone.regex'       => 'صيغة رقم الهاتف غير صحيحة.',
            'phone.unique'      => 'رقم الهاتف مستخدم مسبقاً.',

            'qual.required'     => 'المؤهل العلمي مطلوب.',
            'qual.in'       => 'القيمة المدخلة للمؤهل العلمي غير صالحة .',

            'spec.required'     => 'التخصص مطلوب.',
            'spec.string'       => 'التخصص يجب أن يكون نصاً.',

            'gender.required'   => 'الجنس مطلوب.',
            'gender.in'         => 'القيمة المدخلة للجنس غير صالحة.',


            'hint_date.required'  => 'تاريخ التعيين مطلوب.',
        ]);

        $user->update([
            'email' => $request->email,
        ]);

        $teacher->update([
            'name' => $request->name,
            'qual' => $request->qual,
            'spec' => $request->spec,
            'gender' => $request->gender,
            'status' => $request->status,
            'phone' => $request->phone,
            'hint_date' => $request->hint_date,
            'user_id' =>  $user->id
        ]);

        return response()->json([
            'success' => 'تمت العملية بنجاح'
        ]);
    }

    function delete(Request $request)
    {

        $teacher = Teacher::query()->findOrFail($request->id);
        if ($teacher) {
            $teacher->update([
                'status' => 'inactive',
            ]);
        }
        return response()->json([
            'success' => 'تمت العملية بنجاح'
        ]);
    }

    function active(Request $request)
    {
        $teacher = Teacher::query()->findOrFail($request->id);
        if ($teacher) {
            $teacher->update([
                'status' => 'active',
            ]);
        }
        return response()->json([
            'success' => 'تمت العملية بنجاح'
        ]);
    }
}
