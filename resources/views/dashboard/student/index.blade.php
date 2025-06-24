@extends('dashboard.master')
@section('title')
    مدرسة ليرن | صفحة الرئيسية للمعلمين
@stop
@section('content')
    <main class="page-content">

        <div class="modal fade" id="import-modal" tabindex="-1" aria-labelledby="stagesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="stagesModalLabel">اضافة مادة جديدة</h5>
                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <form method="post" action="{{ route('dash.student.import') }}" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="container">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="mb-4 form-group">
                                    <label> ملف الاكسل </label>
                                    <input name="excel" type="file" class="form-control">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer mb-3">
                            <button class="btn btn-outline-success col-12" type="submit">اضافة</button>
                            <button type="button" class="btn btn-outline-secondary col-12 mb-3"
                                data-bs-dismiss="modal">إغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- add modal --}}
        <div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="stagesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="stagesModalLabel">اضافة طالب جديد</h5>
                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('dash.student.add') }}" enctype="multipart/form-data"
                            id="add-form" class="add-form">
                            <div class="container">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="mb-4 form-group">
                                    <label>اسم الطالب الاول</label>
                                    <input name="first_name" class="form-control" placeholder="اسم الطالب الاول">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-4 form-group">
                                    <label>اسم الطالب الاخير</label>
                                    <input name="last_name" class="form-control" placeholder="اسم الطالب الاخير">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-4 form-group">
                                    <label>البريد الالكتروني</label>
                                    <input name="email" class="form-control" placeholder=" البريد الالكتروني">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-4 form-group">
                                    <label>تاريخ الميلاد</label>
                                    <input name="date_of_birth" type="date" class="form-control">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-4 form-group">
                                    <label>الجنس</label>
                                    <select name="gender" class="form-control">
                                        <option selected disabled> اختر الجنس</option>
                                        <option value="m">ذكر</option>
                                        <option value="fm">أنثى</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-4 form-group">
                                    <label>اسم ولي الامر </label>
                                    <input name="parent_name" class="form-control" placeholder="اسم  ولي الامر">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-4 form-group">
                                    <label>رقم جوال ولي الامر </label>
                                    <input name="parent_phone" class="form-control" placeholder="رقم جوال ولي الامر ">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-4 form-group">
                                    <label>المرحلة الدراسية</label>
                                    <select name="grade" class="form-control">
                                        <option selected disabled> اختر المرحلة الدراسية</option>
                                        @foreach ($grades as $g)
                                            <option value="{{ $g->tag }}">{{ $g->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>


                                <div class="mb-4 form-group">
                                    <label>الشعبة الدراسية</label>
                                    <select name="section" class="form-control">
                                        <option selected disabled> اختر الشعبة الدراسية</option>
                                        @foreach ($sections as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }} الشعبة</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer mb-3">
                        <button class="btn btn-outline-success col-12" type="submit">اضافة</button>
                        <button type="button" class="btn btn-outline-secondary col-12 mb-3"
                            data-bs-dismiss="modal">إغلاق</button>
                    </div>
                    </form>
                </div>


            </div>
        </div>
        {{-- ///////////////////////////////////////// --}}


        {{-- update modal --}}
        <div class="modal fade" id="update-modal" tabindex="-1" aria-labelledby="stagesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="stagesModalLabel">تعديل الطالب </h5>
                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"
                            aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('dash.student.update') }}" id="update-form"
                            class="update-form">
                            <div class="container">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" id="id">
                                <div class="mb-4 form-group">
                                    <label>اسم الطالب الاول </label>
                                    <input name="first_name" id="first_name" class="form-control"
                                        placeholder="اسم الطالب الاول ">
                                </div>
                                <div class="mb-4 form-group">
                                    <label> اسم الطالب الاخير</label>
                                    <input name="last_name" id="last_name" class="form-control"
                                        placeholder=" اسم الطالب الاخير">
                                    <div class="invalid-feedback"></div>

                                </div>
                                <div class="mb-4 form-group">
                                    <label> البريد الالكتروني</label>
                                    <input name="email" id="email" type="email" class="form-control"
                                        placeholder=" البريد الالكتروني">
                                    <div class="invalid-feedback"></div>

                                </div>
                                <div class="mb-4 form-group">
                                    <label>تاريخ الميلاد</label>
                                    <input name="date_of_birth" id="date_of_birth" type="date" class="form-control">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-4 form-group">
                                    <label>الجنس</label>
                                    <select name="gender" class="form-control" id="gender">
                                        <option selected disabled> اختر الجنس</option>
                                        <option value="m">ذكر</option>
                                        <option value="fm">أنثى</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>


                                <div class="mb-4 form-group">
                                    <label>اسم ولي الامر </label>
                                    <input name="parent_name" id="parent_name" class="form-control"
                                        placeholder="اسم  ولي الامر">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-4 form-group">
                                    <label>رقم جوال ولي الامر </label>
                                    <input name="parent_phone" id="parent_phone" class="form-control"
                                        placeholder="رقم جوال ولي الامر ">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-4 form-group">
                                    <label>المرحلة الدراسية</label>
                                    <select name="grade" id="grade" class="form-control">
                                        <option selected disabled> اختر المرحلة الدراسية</option>
                                        @foreach ($grades as $g)
                                            <option value="{{ $g->tag }}">{{ $g->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>



                                <div class="mb-4 form-group">
                                    <label>الشعبة الدراسية</label>
                                    <select name="section" id="section" class="form-control">
                                        <option selected disabled> اختر الشعبة الدراسية</option>
                                        @foreach ($sections as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }} الشعبة</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>

                            </div>

                    </div>
                <div class="modal-footer mb-3">
                    <button class="btn btn-outline-info col-12" type="submit">تعديل</button>
                    <button type="button" class="btn btn-outline-secondary col-12 mb-3"
                        data-bs-dismiss="modal">إغلاق</button>
                </div>
              </form>
                </div>


            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header bg-transparent">
                        <div class="row g-3 align-items-center">
                            <div class="col">
                                <h5 class="mb-0">جميع المواد الدراسية</h5>
                            </div>
                            <div class="col">
                                <div class="d-flex align-items-center justify-content-end gap-3 cursor-pointer">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-primary col-12 btn-add mb-2" data-bs-toggle="modal"
                            data-bs-target="#add-modal">
                            اضافة طالب جديد
                        </button>

                        <button class="btn btn-primary col-12 btn-add mb-2" data-bs-toggle="modal"
                            data-bs-target="#import-modal">
                            اضافة عبر الاكسل
                        </button>

                        <a href="{{ route('dash.student.export') }}" class="btn btn-primary col-12 mb-2">
                            تصدير اكسل
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header bg-transparent">
                        <div class="row g-3 align-items-center">
                            <div class="col">
                                <h5 class="mb-0">جميع المواد</h5>
                            </div>
                            <div class="col">
                                <div class="d-flex align-items-center justify-content-end gap-3 cursor-pointer">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم الاول</th>
                                        <th>الاسم الاخير</th>
                                        <th>البريد الالكتروني</th>
                                        <th>الجنس</th>
                                        <th>تاريخ الميلاد</th>
                                        <th>اسم ولي الامر</th>
                                        <th>رقم جوال ولي الامر</th>
                                        <th>الصف</th>
                                        <th>الشعبة</th>
                                        <th>الحالة</th>
                                        <th>العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@stop
@section('js')
    <script>
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,

            ajax: {
                url: "{{ route('dash.student.getdata') }}"
            },

            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                },

                {
                    data: 'first_name',
                    name: 'first_name',
                    title: 'الاسم الاول',
                    orderable: true,
                    searchable: true,
                },

                {
                    data: 'last_name',
                    name: 'last_name',
                    title: 'الاسم الاخير',
                    orderable: true,
                    searchable: true,
                },
                {
                    data: 'email',
                    name: 'email',
                    title: 'البريد الاكتروني',
                    orderable: true,
                    searchable: true,
                },
                {
                    data: 'gender',
                    name: 'gender',
                    title: 'الجنس',
                    orderable: true,
                    searchable: true,
                },
                {
                    data: 'date_of_birth',
                    name: 'date_of_birth',
                    title: 'تاريخ الميلاد',
                    orderable: false,
                    searchable: false,
                },

                {
                    data: 'parent_name',
                    name: 'parent_name',
                    title: 'اسم ولي الامر',
                    orderable: false,
                    searchable: false,
                },

                {
                    data: 'parent_phone',
                    name: 'parent_phone',
                    title: 'رقم جوال ولي الامر',
                    orderable: false,
                    searchable: false,
                },

                {
                    data: 'grade',
                    name: 'grade',
                    title: 'الصف',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'section',
                    name: 'section',
                    title: 'الشعبة',
                    orderable: false,
                    searchable: false,
                },
                  {
                    data: 'status',
                    name: 'status',
                    title: 'الحالة',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'action',
                    name: 'action',
                    title: 'العمليات',
                    orderable: false,
                    searchable: false,
                },

            ],
        });




       $(document).ready(function() {
    $(document).on('click', '.update_btn', function(e) {
        e.preventDefault();

        var button = $(this);
         $('#id').val(button.data('id'));
        var first_name = button.data('first_name');
        var last_name = button.data('last_name');
        var email = button.data('email');
        var gender = button.data('gender');
        var date_of_birth = button.data('date-of-birth');
        var parent_name = button.data('parent_name');
        var parent_phone = button.data('parent_phone');
        var grade = button.data('grade');
        var section = button.data('section');
        var id = button.data('id');

        $('#first_name').val(first_name);
        $('#last_name').val(last_name);
        $('#email').val(email);
        $('#gender').val(gender);
        $('#date_of_birth').val(date_of_birth);
        $('#parent_name').val(parent_name);
        $('#parent_phone').val(parent_phone);
        $('#grade').val(grade);
        $('#section').val(section);
        $('#id').val(id);

        $('#update-modal').modal('show');
    });
});



        $(document).ready(function() {
            $(document).on('click', '.active-btn', function(e) {
                e.preventDefault();
                var button = $(this);
                var id = button.data('id');
                var url = button.data('url');
                swal({
                    title: "هل أنت متأكد من العملية ؟",
                    text: "سيتم تفعيل العنصر المعطل .",
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: "إلغاء",
                            value: null,
                            visible: true,
                            className: "custom-cancel-btn",
                            closeModal: true,
                        },
                        confirm: {
                            text: "تفعيل",
                            value: true,
                            visible: true,
                            className: "custom-confirm-btn",
                            closeModal: true,
                        },
                    },
                    dangerMode: false,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: url,
                            type: "post",
                            data: {
                                id: id,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(res) {
                                toastr.success(res.success)
                                table.draw();
                            },
                        });
                    } else {
                        toastr.error('تم الغاء عملية التفعيل')
                    }
                });
            })
        });
    </script>




@stop
