@extends('dashboard.master')
@section('title')
    مدرسة ليرن | صفحة الرئيسية للمعلمين
@stop
@section('content')
    <main class="page-content">

        {{-- add modal --}}
        <div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="stagesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="stagesModalLabel">اضافة مادة جديدة</h5>
                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <form method="post" action="{{ route('dash.subject.add') }}" enctype="multipart/form-data"
                        id="add-form" class="add-form">
                        <div class="modal-body">

                            <div class="container">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="mb-4 form-group">
                                    <label>عنوان المادة</label>
                                    <input name="title" class="form-control" placeholder="عنوان المادة">
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
                                    <label>معلم المادة</label>
                                    <select name="teacher" class="form-control">
                                        <option selected disabled> اختر معلم المادة</option>
                                        @foreach ($teachers as $t)
                                            <option value="{{ $t->id }}">{{ $t->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-4 form-group">
                                    <label>كتاب المادة</label>
                                    <input name="book" type="file" class="form-control">
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
                        <h5 class="modal-title" id="stagesModalLabel">تعديل المادة الدراسية </h5>
                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <form method="post" action="{{ route('dash.subject.update') }}" id="update-form" class="update-form">
                        <div class="modal-body">

                            <div class="container">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" id="id">
                                <div class="mb-4 form-group">
                                    <label>عنوان المادة</label>
                                    <input name="title" id="title" class="form-control" placeholder="عنوان المادة">
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
                                    <label>معلم المادة</label>
                                    <select name="teacher" class="form-control" id="teacher">
                                        <option selected disabled> اختر معلم المادة</option>
                                        @foreach ($teachers as $t)
                                            <option value="{{ $t->id }}">{{ $t->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>


                                <div class="mb-4 form-group">
                                    <label>كتاب المادة</label>
                                    <input name="book" type="file" class="form-control" id="book">
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
                        <button class="btn btn-primary col-12 btn-add" data-bs-toggle="modal"
                            data-bs-target="#add-modal">
                            اضافة مادة دراسية
                        </button>
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
                                        <th>عنوان المادة</th>
                                        <th>المرحلة الدراسية</th>
                                        <th>معلم المادة</th>
                                        <th>كتاب المادة</th>
                                        <th>محاضرات المادة</th>
                                        <th>الحالة </th>
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
                url: "{{ route('dash.subject.getdata') }}"
            },

            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                },

                {
                    data: 'title',
                    name: 'title',
                    title: 'عنوان المادة',
                    orderable: true,
                    searchable: true,
                },

                {
                    data: 'grade',
                    name: 'grade',
                    title: 'المرحلة الدراسية',
                    orderable: true,
                    searchable: true,
                },
                {
                    data: 'teacher',
                    name: 'teacher',
                    title: ' معلم المادة',
                    orderable: true,
                    searchable: true,
                },
                {
                    data: 'book',
                    name: 'book',
                    title: 'كتاب المادة',
                    orderable: true,
                    searchable: true,
                },
                 {
                    data: 'lectures',
                    name: 'lectures',
                    title: 'محاضرات المادة',
                    orderable: false,
                    searchable: false,
                },

                 {
                    data: 'status',
                    name: 'status',
                    title: ' الحالة',
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

           language: {

                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/ar.json',
            }
        });





 $(document).ready(function() {
    $(document).on('click', '.update_btn', function(e) {
        e.preventDefault();

        var button = $(this);
        var title = button.data('title');
        var grade = button.data('grade');
        var teacher = button.data('teacher');
        var id = button.data('id');

        $('#title').val(title);
        $('#grade').val(grade);
        $('#teacher').val(teacher);
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


