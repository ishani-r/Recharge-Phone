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
                  <h4 class="card-title">{{ trans('Change Password')}}</h4>
                  <p class="card-category">{{ trans('Complete your password')}}</p>
               </div>
               <div class="card-body">
               <!-- <form> -->
                  {!! Form::open(['route'=> array('admin.changepass',Auth::guard('admin')->user()->id),'files'=>'true','id' => 'pass_form']) !!}
                  @csrf
                  <!-- -------------------------------------- Password ------------------------------------ -->
                  <div class="row">
                     <div class="col-md-8">
                        <div class="form-group">
                           <label class="bmd-label-floating">{{ Form::label('current_password', trans('Current Password'))}}</label>
                           {{ Form::password('current_password',array('class' => 'form-control')); }}
                           @if ($message = Session::get('error'))
                              <strong style="color: red;">{{ $message }}</strong>
                           @endif
                           @error('current_password')
                              <span role="alert">
                              <strong style="color:red;">{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-8">
                        <div class="form-group">
                           <label class="bmd-label-floating">{{ Form::label('password', trans('Password'))}}</label>
                           <!-- {{Form::text('password','',['class'=>'form-control'])}} -->
                           {{ Form::password('password',array('class' => 'form-control')); }}
                           @error('password')
                              <span role="alert">
                              <strong style="color:red;">{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                     </div>
                  </div>
                  <!-- --------------------------------- Confirem Password ------------------------------------ -->
                  <div class="row">
                     <div class="col-md-8">
                        <div class="form-group">
                           <label class="bmd-label-floating">{{ Form::label('confirm_password', trans('Confirm Password'))}}</label>
                           <!-- {{Form::text('confirm_password','',['class'=>'form-control'])}} -->
                           {{ Form::password('confirm_password',array('class' => 'form-control')); }}
                           @error('confirm_password')
                              <span role="alert">
                              <strong style="color:red;">{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                     </div>
                  </div>
                  {{Form::submit( trans('Update Profile'), ['class'=>'btn btn-primary pull-right'])}}
                  {!!Form::close()!!}
                  <div class="clearfix"></div>
               <!-- </form> -->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@push('js')
<script>
   $(document).ready(function(){
      $('#pass_form').validate({
         rules: {
            current_password: {
               required: true,
            },
            password: {
               required: true,
            },
            confirm_password: {
              required: true,
            }
         },
         errorElement: 'span',
         messages: {
            current_password: 'Enter Your Current Password!',
            password: 'Enter Your Password!',
            confirm_password: 'Enter Your Confirm Password!',
         },
      });
   });
</script>
@endpush