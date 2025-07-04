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
                        <h5 class="modal-title" id="stagesModalLabel">اضافة محاضرة جديدة</h5>
                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('dash.teacher.lecture.add') }}" id="add-form" class="add-form">
                            <div class="container">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" value="{{ csrf_token() }}">
                                <div class="mb-4 form-group">
                                    <label> عنوان المحاضرة</label>
                                    <input name="title" class="form-control" placeholder="عنوان المحاضرة ">
                                    <div class="invalid-feedback"></div>

                                </div>
                                <div class="mb-4 form-group">
                                    <label> وصف المحاضرة</label>
                                    <input name="desc" type="text" class="form-control" placeholder=" وصف المحاضرة">
                                    <div class="invalid-feedback"></div>

                                </div>
                                <div class="mb-4 form-group">
                                    <label> المادة الدراسية</label>
                                    <select name="subject" class="form-control">
                                        <option selected disabled>اختر المادة</option>
                                        @foreach ($subjects as $m)
                                            {
                                            <option value="{{ $m->id }}">{{ $m->title }} </option>
                                            }
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>

                                </div>

                                <div class="mb-4 form-group">
                                    <label>رابط المحاضرة </label>
                                    <input name="link" type="url" class="form-control">
                                    <div class="invalid-feedback"></div>

                                </div>
                            </div>
                    </div>
                    <div class="modal-footer mb-3">
                        <button class="btn btn-outline-success col-12" type="submit">اضافة</button>
                        <button type="button" class="btn btn-outline-secondary col-12 mb-3"
                            data-bs-dismiss="modal">إغلاق</button>
                        </form>
                    </div>

                </div>


            </div>
        </div>

        {{-- update modal --}}
        <div class="modal fade" id="update-modal" tabindex="-1" aria-labelledby="stagesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="stagesModalLabel">تعديل المحاضرة </h5>
                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('dash.teacher.lecture.update') }}" id="update-form"
                            class="update-form">


                            <div class="container">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" id="id">
                                <div class="mb-4 form-group">
                                    <label> عنوان المحاضرة</label>
                                    <input name="title" class="form-control" placeholder="عنوان المحاضرة " id="title">
                                    <div class="invalid-feedback"></div>

                                </div>

                                <div class="mb-4 form-group">
                                    <label> وصف المحاضرة</label>
                                    <input name="desc" type="text" class="form-control" id="desc"
                                        placeholder=" وصف المحاضرة">
                                    <div class="invalid-feedback"></div>

                                </div>

                                <div class="mb-4 form-group">
                                    <label> المادة الدراسية</label>
                                    <select name="subject" class="form-control" id="subject">
                                        <option selected disabled>اختر المادة</option>
                                        @foreach ($subjects as $m)
                                            {
                                            <option value="{{ $m->id }}">{{ $m->title }} </option>
                                            }
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>

                                </div>


                                <div class="mb-4 form-group">
                                    <label>رابط المحاضرة </label>
                                    <input name="link" type="url" class="form-control" id="link">
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
                                <h5 class="mb-0"> التصفية</h5>
                            </div>
                            <div class="col">
                                <div class="d-flex align-items-center justify-content-end gap-3 cursor-pointer">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4 mb-3">
                                <input type="text" id="search-title" class="form-control search-input"
                                    placeholder="عنوان المحاضرة">
                            </div>

                        </div>
                        <div class="d-flex justify-content-end gap-2 mb-3">
                            <button type="submit" id="search-btn"
                                class="btn btn-outline-success col-6 search-btn">بحث</button>
                            <button type="reset" id="clear-btn"
                                class="btn btn-outline-secondary col-6 clear-btn">تنظيف</button>
                        </div>

                        <button class="btn btn-outline-primary col-12 btn-add" data-bs-toggle="modal"
                            data-bs-target="#add-modal">
                            اضافة محاضرة
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
                                <h5 class="mb-0">جميع المحاضرات</h5>
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
                                        <th>العنوان</th>
                                        <th> الوصف</th>
                                        <th>اسم المادة </th>
                                        <th> رابط المحاضرة</th>
                                        <th> الحالة </th>
                                        <th> العمليات</th>
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
                url: "{{ route('dash.teacher.lecture.getdata') }}",
                data: function(n) {
                    n.title = $('#search-title').val();
                }
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
                    title: 'العنوان',
                    orderable: true,
                    searchable: true,
                },

                {
                    data: 'desc',
                    name: 'desc',
                    title: ' الوصف',
                    orderable: true,
                    searchable: true,
                },
                {
                    data: 'subject',
                    name: 'subject',
                    title: 'اسم المادة',
                    orderable: true,
                    searchable: true,
                },

                {
                    data: 'link',
                    name: 'link',
                    title: ' الرابط',
                    orderable: true,
                    searchable: true,
                },
                  {
                    data: 'status',
                    name: 'status',
                    title: ' الحالة',
                    orderable: true,
                    searchable: true,
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



        $(document).on('click', '.update_btn', function(e) {
            e.preventDefault();
            var button = $(this);

            $('#id').val(button.data('id'));
            $('#title').val(button.data('title'));
            $('#desc').val(button.data('desc'));
            $('#subject').val(button.data('subject'));
            $('#link').val(button.data('link'));
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
