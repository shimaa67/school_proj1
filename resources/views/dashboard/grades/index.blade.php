@extends('dashboard.master')

@section('title')
مدرسة ليرن | الصفحة الرئيسية للمستويات
@stop

@section('content')
<main class="page-content">

     <div class="modal fade" id="sectionModal" tabindex="-1" aria-labelledby="stagesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="stagesModalLabel">الشعب</h5>
                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="container">
                                <div class="mb-4">
                                    <div class="d-flex align-items-center mb-2">
                                        <label class="form-label fw-bold mb-0" for="primary-master">
                                            فعل الشعب اللازمة :</label>
                                    </div>

                                    <input value="" type="hidden" id="gradetag" name="gradetag">
                                    <div class="d-flex flex-wrap gap-3 primary-group">
                                        <div class="form-check">
                                            <input data-section="1" class="form-check-input section-checkbox"
                                                type="checkbox" id="section1">
                                            <label class="form-check-label" for="section1">الشعبة 1</label>
                                        </div>
                                        <div class="form-check">
                                            <input data-section="2" class="form-check-input section-checkbox"
                                                type="checkbox" id="section2">
                                            <label class="form-check-label" for="section2">الشعبة 2</label>
                                        </div>
                                        <div class="form-check">
                                            <input data-section="3" class="form-check-input section-checkbox"
                                                type="checkbox" id="section3">
                                            <label class="form-check-label" for="section3">الشعبة 3</label>
                                        </div>
                                        <div class="form-check">
                                            <input data-section="4" class="form-check-input section-checkbox"
                                                type="checkbox" id="section4">
                                            <label class="form-check-label" for="section4">الشعبة 4</label>
                                        </div>
                                        <div class="form-check">
                                            <input data-section="5" class="form-check-input section-checkbox"
                                                type="checkbox" id="section5">
                                            <label class="form-check-label" for="section5">الشعبة 5</label>
                                        </div>
                                        <div class="form-check">
                                            <input data-section="6" class="form-check-input section-checkbox"
                                                type="checkbox" id="section6">
                                            <label class="form-check-label" for="section6">الشعبة 6</label>
                                        </div>
                                        <div class="form-check">
                                            <input data-section="7" class="form-check-input section-checkbox"
                                                type="checkbox" id="section7">
                                            <label class="form-check-label" for="section7">الشعبة 7</label>
                                        </div>
                                    </div>
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
 <!-- Modal المراحل الدراسية -->
        <div class="modal fade" id="stagesModal" tabindex="-1" aria-labelledby="stagesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="stagesModalLabel">المراحل الدراسية</h5>
                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="container">
                                <!-- المرحلة الابتدائية -->
                                <div class="mb-4">
                                    <div class="d-flex align-items-center mb-2">
                                        <input class="form-check-input me-2 master-checkbox" type="checkbox"
                                            id="primary-master" data-tag="p" data-target=".primary-group">
                                        <label class="form-label fw-bold mb-0" for="primary-master">المرحلة الابتدائية</label>
                                    </div>
                                    <div class="d-flex flex-wrap gap-3 primary-group">
                                        <div class="form-check">
                                            <input data-name="الصف الاول" data-stage="p" data-grade="1"
                                                class="form-check-input grade-checkbox" type="checkbox" id="primary1">
                                            <label class="form-check-label" for="primary1">الأول</label>
                                        </div>
                                        <div class="form-check">
                                            <input data-name="الصف الثاني" data-stage="p" data-grade="2"
                                                class="form-check-input grade-checkbox" type="checkbox" id="primary2">
                                            <label class="form-check-label" for="primary2">الثاني</label>
                                        </div>
                                        <div class="form-check">
                                            <input data-name="الصف الثالث" data-stage="p" data-grade="3"
                                                class="form-check-input grade-checkbox" type="checkbox" id="primary3">
                                            <label class="form-check-label" for="primary3">الثالث</label>
                                        </div>
                                        <div class="form-check">
                                            <input data-name="الصف الرابع" data-stage="p" data-grade="4"
                                                class="form-check-input grade-checkbox" type="checkbox" id="primary4">
                                            <label class="form-check-label" for="primary4">الرابع</label>
                                        </div>
                                        <div class="form-check">
                                            <input data-name="الصف الخامس" data-stage="p" data-grade="5"
                                                class="form-check-input grade-checkbox" type="checkbox" id="primary5">
                                            <label class="form-check-label" for="primary5">الخامس</label>
                                        </div>
                                        <div class="form-check">
                                            <input data-name="الصف السادس" data-stage="p" data-grade="6"
                                                class="form-check-input grade-checkbox" type="checkbox" id="primary6">
                                            <label class="form-check-label" for="primary6">السادس</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- المرحلة الإعدادية -->
                                <div class="mb-4">
                                    <div class="d-flex align-items-center mb-2">
                                        <input data-tag="m" class="form-check-input me-2 master-checkbox"
                                            type="checkbox" id="prep-master" data-target=".prep-group">
                                        <label class="form-label fw-bold mb-0" for="prep-master">المرحلة الإعدادية</label>
                                    </div>
                                    <div class="d-flex flex-wrap gap-3 prep-group">
                                        <div class="form-check">
                                            <input data-name="الصف السابع" data-stage="m" data-grade="7"
                                                class="form-check-input grade-checkbox" type="checkbox" id="prep1">
                                            <label class="form-check-label" for="prep1">السابع</label>
                                        </div>
                                        <div class="form-check">
                                            <input data-name="الصف الثامن" data-stage="m" data-grade="8"
                                                class="form-check-input grade-checkbox" type="checkbox" id="prep2">
                                            <label class="form-check-label" for="prep2">الثامن</label>
                                        </div>
                                        <div class="form-check">
                                            <input data-name="الصف التاسع" data-stage="m" data-grade="9"
                                                class="form-check-input grade-checkbox" type="checkbox" id="prep3">
                                            <label class="form-check-label" for="prep3">التاسع</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- المرحلة الثانوية -->
                                <div class="mb-4">
                                    <div class="d-flex align-items-center mb-2">
                                        <input data-tag="h" class="form-check-input me-2 master-checkbox"
                                            type="checkbox" id="sec-master" data-target=".sec-group">
                                        <label class="form-label fw-bold mb-0" for="sec-master">المرحلة الثانوية</label>
                                    </div>
                                    <div class="d-flex flex-wrap gap-3 sec-group">
                                        <div class="form-check">
                                            <input data-name="الصف العاشر" data-stage="h" data-grade="10"
                                                class="form-check-input grade-checkbox" type="checkbox" id="sec1">
                                            <label class="form-check-label" for="sec1">العاشر</label>
                                        </div>
                                        <div class="form-check">
                                            <input data-name="الصف الحادي عشر" data-stage="h" data-grade="11"
                                                class="form-check-input grade-checkbox" type="checkbox" id="sec2">
                                            <label class="form-check-label" for="sec2">الحادي عشر</label>
                                        </div>
                                        <div class="form-check">
                                            <input data-name="الصف الثاني عشر" data-stage="h" data-grade="12"
                                                class="form-check-input grade-checkbox" type="checkbox" id="sec3">
                                            <label class="form-check-label" for="sec3">الثاني عشر</label>
                                        </div>
                                    </div>
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
                                <h5 class="mb-0">جميع المستويات</h5>
                            </div>
                            <div class="col">
                                <div class="d-flex align-items-center justify-content-end gap-3 cursor-pointer">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-primary col-12" data-bs-toggle="modal" data-bs-target="#stagesModal">
                            عرض المراحل الدراسية
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
                                        <th>المرحلة</th>
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
$(document).ready(function () {
  // 1. تهيئة جدول البيانات
  var table = $('#datatable').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: {
      url: '{{ route("dash.grade.getdata") }}' // استخدام helper route بدلاً من الرابط المباشر
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
        data: 'stage',
        name: 'stage_id'
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



  // 2. تحميل البيانات الأولية عند فتح الصفحة
  function loadInitialData() {

     $('.master-checkbox').on('change', function () {
        var target = $(this).data('target');
        var checked = $(this).prop('checked');
        $(target).find('input[type=checkbox]').prop('disabled', !checked);
    });

    // جلب المراحل النشطة
    $.ajax({
      url: '{{ route("dash.grade.getactive.stage") }}',
      type: "GET",
      success: function(res) {
        var activeTags = res.tags;
        $('.master-checkbox').each(function() {
          var checkbox = $(this);
          var datastage = checkbox.data('tag');
          if (activeTags.includes(datastage)) {
            checkbox.prop('checked', true);
            checkbox.prop('disabled', false);
          }
            checkbox.prop('checked', false);
             var target = $(this).data('target');
        $(target).find('input[type=checkbox]').prop('disabled', true);


        });
      },
      error: function(xhr) {
        console.error('خطأ في جلب المراحل النشطة:', xhr.responseText);
        toastr.error('حدث خطأ أثناء جلب بيانات المراحل');
      }
    });

    // جلب الصفوف النشطة
    $.ajax({
      url: '{{ route("dash.grade.getactive") }}',
      type: "GET",
      success: function(res) {
        var activeTags = res.tags.map(Number);
        $('.grade-checkbox').not('.master-checkbox').each(function() {
          var checkbox = $(this);
          var datagrade = checkbox.data('grade');
          if (activeTags.includes(datagrade)) {
            checkbox.prop('checked', true);
            checkbox.prop('disabled', false);
          }
        });
      },
      error: function(xhr) {
        console.error('خطأ في جلب الصفوف النشطة:', xhr.responseText);
        toastr.error('حدث خطأ أثناء جلب بيانات الصفوف');
      }
    });
  }

  // استدعاء الدالة لتحميل البيانات الأولية
  loadInitialData();

  // 3. أحداث Checkbox الرئيسي (المرحلة)
  $(document).on('change', '.master-checkbox', function() {
    var checkbox = $(this);
    var status = checkbox.is(':checked') ? 1 : 0;
    var tag = checkbox.data('tag');

    $.ajax({
      url: "{{ route('dash.grade.changemaster') }}",
      type: "POST",
      data: {
        'tag': tag,
        'status': status,
        '_token': "{{ csrf_token() }}"
      },
      success: function(res) {
        toastr.success(res.success);
        table.draw();
      },
    });
  });

  // 4. أحداث Checkbox الصفوف
  $(document).on('change', '.grade-checkbox', function() {
    var checkbox = $(this);
    var status = checkbox.is(':checked') ? 1 : 0;
    var stage = checkbox.data('stage');
    var tag = checkbox.data('grade');
    var name = checkbox.data('name');

    $.ajax({
      url: "{{ route('dash.grade.add') }}",
      type: "POST",
      data: {
        stage: stage,
        tag: tag,
        name: name,
        status: status,
        '_token': "{{ csrf_token() }}"
      },
      success: function(res) {
        toastr.success(res.success);
        table.draw();
      },
      error: function(xhr) {
        toastr.error('حدث خطأ أثناء تحديث حالة الصف');
        console.error(xhr.responseText);
      }
    });
  });

  // 5. أحداث فتح المودال لإضافة الأقسام
  $(document).on('click', '.btn-add-section', function(e) {
    e.preventDefault();
    var button = $(this);
    var gradetag = button.data('grade');
    var gradeid = button.data('grade-id');

    $('#gradetag').val(gradetag);

    // جلب الأقسام النشطة للصف المحدد
    $.ajax({
      url: '{{ route("dash.grade.getactive.section") }}',
      type: "GET",
      data: {
        'gradeId': gradeid,
      },
      success: function(res) {
        var activeSection = res.sections.map(Number);
        $('.section-checkbox').each(function() {
          var checkbox = $(this);
          var datasection = checkbox.data('section');
          if (activeSection.includes(datasection)) {
            checkbox.prop('checked', true);
            checkbox.prop('disabled', false);
          } else {
            checkbox.prop('checked', false);
          }
        });
      },
      error: function(xhr) {
        toastr.error('حدث خطأ أثناء جلب الأقسام النشطة');
        console.error(xhr.responseText);
      }
    });
  });

  // 6. أحداث Checkbox الأقسام
  $(document).on('change', '.section-checkbox', function() {
    var checkbox = $(this);
    var status = checkbox.is(':checked') ? 1 : 0;
    var section = checkbox.data('section');
    var gradetag = $('#gradetag').val();

    $.ajax({
      url: "{{ route('dash.grade.addsection') }}",
      type: "POST",
      data: {
        'section': section,
        'gradetag': gradetag,
        'status': status,
        '_token': "{{ csrf_token() }}"
      },
      success: function(res) {
        toastr.success(res.success);
        table.draw();
      },
      error: function(xhr) {
        toastr.error('حدث خطأ أثناء تحديث حالة القسم');
        console.error(xhr.responseText);
      }
    });
  });
});










</script>
@stop
