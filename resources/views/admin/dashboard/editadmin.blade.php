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
                  <h4 class="card-title">{{ trans('Edit')}}</h4>
                  <p class="card-category">{{ trans('You Can Edit Your Question-Answer')}}</p>
               </div>
               <div class="card-body">
                  <!-- <form> -->
                  {!! Form::model($data,['route'=> array('admin.adminuser.update',$data->id), 'enctype' => 'multipart/form-data', 'id' => 'admin_form']) !!}
                  @csrf
                  @method('put')
                  <!-- -------------------------------------- Name ------------------------------------ -->
                  <input type="hidden" name="id" value="{{$data->id}}">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label class="bmd-label-floating">{{ Form::label('name', trans('Name'))}}</label>
                           {{Form::text('name',null,['class'=>'form-control'])}}
                           @error('name')
                           <span role="alert">
                              <strong style="color:red;">{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group">
                           <label class="bmd-label-floating">{{ Form::label('email', trans('Email'))}}</label>
                           {{Form::text('email',null,['class'=>'form-control'])}}
                           @error('email')
                           <span role="alert">
                              <strong style="color:red;">{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                  </div>
                  <!-- ------------------------------------- Image --------------------------------------- -->
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="bmd-label-floating">{{ Form::label('image', trans('Select Profile'))}}</label>
                        </div>
                        {{Form::file('image')}}<br>
                        @error('image')
                        <span role="alert">
                           <strong style="color:red;">{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <h3>Assign Role</h3>
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th>Roles Name</th>
                           </tr>
                        </thead>
                        <tr>
                           @foreach($role as $value)
                           <td>
                              <input type="checkbox" class="permision_check" name="permission[]" value="{{$value->id}}" {{$value->id == $roles->id ? 'checked' : ''}}>{{ $value->name }}
                           </td>
                           @endforeach
                        </tr>
                     </table>
                  </div>
                  {{Form::submit( trans('Update'), ['class'=>'btn btn-primary pull-right'])}}
                  {!!Form::close()!!}
                  <div class="clearfix"></div>
                  <!-- </form> -->
               </div>
               <div class="card">
                  <div class="card-header card-header-primary">
                     <a href="{{ route('admin.adminuser.index')}}">
                        <h4 class="card-title"><i class="fa fa-hand-o-left" aria-hidden="true"></i> {{ trans('Back')}}</h4>
                     </a>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="card card-profile">
               <div class="card-avatar">
                  <a href="#pablo">
                     <img class="img" src="{{asset('storage/admin/'.$data->image)}}" />
                  </a>
               </div>
               <div class="card-body">
                  <h6 class="card-category">CEO / Co-Founder</h6>
                  <h4 class="card-title">{{$data->name}}</h4>
                  <!-- <p class="card-description">
              Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
            </p> -->
                  <!-- <a href="#pablo" class="btn btn-primary btn-round">Follow</a> -->
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
      $('#admin_form').validate({
         rules: {
            name: {
               required: true,
            },
            email: {
               required: true,
            },
         },
         errorElement: 'span',
         messages: {
            name: 'Please Enter Your Name !',
            email: 'Please Enter Your Email Address',
         }
      });
   });
</script>
@endpush