@extends('dashboard.master')

@section('title')
مدرسة ليرن | الصفحة الرئيسية للمستويات
@stop

@section('content')
<main class="page-content">

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="stagesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="stagesModalLabel">المراحل الدراسية</h5>
                    <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>

                <form method="post" id="add-form" class="add-form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-body">
                        <div class="container">
                            <div class="mb-4">
                                <input class="form-control" name="count_section" placeholder="ادخل عدد الشعب المرغوب بها:">
                            </div>
                            <div>
                                <button class="btn btn-outline-success col-12" type="submit">
                                    اضافة
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary col-12" data-bs-dismiss="modal">إغلاق</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- عرض الجدول الرئيسي -->
    <div class="row">
        <div class="col-12 col-lg-12 col-xl-12 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header bg-transparent">
                    <div class="row g-3 align-items-center">
                        <div class="col">
                            <h5 class="mb-0">جميع الشعب</h5>
                        </div>
                        <div class="col">
                            <div class="d-flex align-items-center justify-content-end gap-3 cursor-pointer">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <button class="btn btn-primary col-12" data-bs-toggle="modal" data-bs-target="#addModal">
                        اضافة الشعب
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>الحالة</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
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


 var table= $(document).ready(function () {
  table = $('#datatable').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: {
      url: '{{ route("dash.section.getdata") }}'
    },
    columns: [
      {
        data: 'DT_RowIndex',
        name: 'DT_RowIndex',
        orderable: false,
        searchable: false
      },
      {
        data: 'name',
        name: 'name'
      },
      {
        data: 'status',
        name: 'status'
      },
      {
        data: 'action',
        name: 'action',
        orderable: false,
        searchable: false
      }
    ],
    language: {
      url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/ar.json'
    }
  });


$('.add-form').on('submit',function(e){
    e.preventDefault();
    var data = new FormData(this);
    $.ajax({
      url: "{{ route('dash.section.add') }}",
      type: "POST",
      processData: false,
      contentType: false,
      data: data,
      success: function(res) {
        $('#addModal').modal('hide');
        $('#add-form').trigger('reset');
        toastr.success(res.success)
        table.draw();
      },
    });
});

$(document).on('change', '.active-section-sw', function(e){
    var id = $(this).data('id');
    var status = $(this).data('status');
    e.preventDefault();

    $.ajax({
      url: "{{ route('dash.section.changestatus') }}",
      type: "POST",
      data: {
        'id': id,
        'status': status,
        '_token': "{{ csrf_token() }}"
      },
      success: function(res) {
        toastr.success(res.success)
        table.draw();
      },
    });
});
});
</script>
@stop
