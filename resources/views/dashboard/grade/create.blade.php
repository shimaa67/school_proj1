@extends('dashboard.master')
@section('title')
مدرسة ليرن الصفحة الرئيسية للمستويات
@stop
@section('content')

<main class="page-content">
<div class="row">
    <div class="col-12 col-lg-12 col-xl-12 d-flex">
      <div class="card radius-10 w-100">
        <div class="card-header bg-transparent">
          <div class="row g-3 align-items-center">
            <div class="col">
              <h5 class="mb-0">اضافة المستوى الجديد</h5>
            </div>
            <div class="col">
              <div class="d-flex align-items-center justify-content-end gap-3 cursor-pointer">
              </div>
            </div>
           </div>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert border-0 bg-light-danger alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                  <div class="fs-3 text-danger"><i class="bi bi-x-circle-fill"></i>
                  </div>
                  <div class="ms-3">
                    <ul>
                        @foreach ( $errors->all() as $e )
                        <li> {{$e}}</li>
                        @endforeach
                    </ul>
                  </div>
                </div>
            @endif
          <form id="formcreate" method="post" action="{{ route('dash.grade.add') }}">
             @csrf
            <label  class="mb-2"> اسم المستوى</label>
            <input id="name" class="form-control mb-3" type="text" name="name" placeholder="اسم المستوى">
            <label class="mb-2"> المرحلة</label>
           <select id="stage" class="form-control mb-3" name="stage">
            <option selected disabled >اختر المرحلة</option>
            @foreach ($stages as $stage )
            <option value="{{$stage->id }}">{{$stage->name}}</option>
            @endforeach
           </select>
           <button type="submit" class="btn btn-outline-success col-12"> اضافة</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  @stop

 @section('js')
 <script>
    $('#formcreate').submit(function(e){
        e.preventDefault();
        var name = $('#name').val();
        var stage = $('#stage').val();
        $.ajax({
          url:"{{ route('dash.grade.add') }}",
          type:'post'
          data:{
            "_token":"{{ csrf_token() }}",
            "name":name,
            "stage":stage
          }
          success:function(res){
             alert(res);
             $('#formcreate').trigger();
        }
          error:function(e){
           console.log(e);

          }
        })

    })

 </script>
 @stop
