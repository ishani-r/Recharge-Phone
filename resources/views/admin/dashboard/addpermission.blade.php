@extends('layouts.master')
@push('css')
<style>
   .error {
      color: red;
   }
</style>
@endpush
@section('content')
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-8">
            <div class="card">
               <div class="card-header card-header-primary">
                  <h4 class="card-title">{{ trans('Add Permission')}}</h4>
                  <!-- <p class="card-category">Complete your Package</p> -->
               </div>
               <div class="card-body">
                  <!-- <form> -->
                  {!! Form::open(['route'=> array('admin.permission.store'), 'id' => 'permission_form']) !!}
                  <!-- --------------------------------- Module Name ------------------------------- -->
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label class="bmd-label-floating">{{ Form::label('module_name',trans('Module Name'))}}</label>
                           {{Form::text('module_name','',['class'=>'form-control module_name'])}}
                           @error('module_name')
                           <span role="alert">
                              <strong style="color:red;">{{ tranc('$message') }}</strong>
                           </span>
                           @enderror
                           <p id="duplicat_name"></p>
                        </div>
                     </div>
                  </div>
                  <!-- --------------------------------- Guard Name ------------------------------- -->
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label class="bmd-label-floating">{{ Form::label('guard_name',trans('Guard Name'))}}</label>
                           {{Form::text('guard_name','',['class'=>'form-control'])}}
                           @error('guard_name')
                           <span role="alert">
                              <strong style="color:red;">{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                  </div>
                  {{Form::submit( trans('Add'), ['class'=>'btn btn-primary pull-right asd'])}}
                  {!!Form::close()!!}
                  <div class="clearfix"></div>
                  <!-- </form> -->
               </div>
            </div>
            <div class="card">
               <div class="card-header card-header-primary">
                  <a href="{{ route('admin.permission.index')}}">
                     <h4 class="card-title"><i class="fa fa-hand-o-left" aria-hidden="true"></i> {{ trans('Back')}}</h4>
                  </a>
                  <!-- <p class="card-category">Complete your Package</p> -->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@push('js')
<script>
   $(document).ready(function() {
      $('#permission_form').validate({
         rules: {
            module_name: {
               required: true,
            },
            guard_name: {
               required: true,
            },
         },
         errorElement: 'span',
         messages: {
            module_name: 'Please Enter Module Name!',
            guard_name: 'Please Enter Guard Name!',
         },
      });

      // =================================================================
      $('.module_name').blur(function() {
         var error_phone = '';
         var module_name = $('.module_name').val();
         var _token = $('input[name = "_token"]').val();
         var filter = /(^([a-zA-z]+)(\d+)?$)/u;
         if (!filter.test(module_name)) {
            $('#error').addClass('has-error');
            $('#duplicat_name').html('<label class = "text-danger">Invaild Module Name !!</label>');
            $('.add').attr('disabled', 'disabled');
         } else {
            $.ajax({
               url: "{{ route('admin.modulename')}}",
               method: "POST",
               data: {
                  module_name: module_name,
                  _token: _token
               },
               success: function(result) {
                  if (result != 'Name_Exists') {
                     $('#duplicat_name').html(
                        '<label class = "text-success">Now Module Name Available !!</label>'
                     );
                     $('.module_name').removeClass('has-error');
                     $('.add').attr('disabled', false);
                  } else if (result != 'Unique') {
                     $('#duplicat_name').html(
                        '<label class = "text-danger">Module Name is already exits !!</label>'
                     );
                     $('#mobile').addClass('has-error');
                     $('.add').attr('disabled', false);
                  }
               }
            })
         }
      });
      // =================================================================
   });
</script>
@endpush