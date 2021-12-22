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
            <h4 class="card-title">{{ trans('Edit Profile')}}</h4>
            <p class="card-category">{{ trans('Complete your profile')}}</p>
          </div>
          <div class="card-body">
            <!-- <form> -->
              {!! Form::open(['route'=> array('admin.update_profile',Auth::guard('admin')->user()->id), 'id' => 'profile_form','files'=>'true']) !!}
              @csrf
              @method('put')
              <!-- -------------------------------------- Name ------------------------------------ -->
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">{{ Form::label('name', trans('Name'))}}</label>
                    {{Form::text('name',Auth::guard('admin')->user()->name,['class'=>'form-control','placeholder'=>'Name'])}}
                    @error('name')
                      <span role="alert">
                        <strong style="color:red;">{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">{{ Form::label('email', trans('Email'))}}</label>
                    {{Form::text('email',Auth::guard('admin')->user()->email,['class'=>'form-control','placeholder'=>'Email'])}}
                    @error('email')
                      <span role="alert">
                        <strong style="color:red;">{{ $message }}</strong>
                      </span>
                    @enderror
                    <!-- <input type="email" class="form-control" value="{{ Auth::guard('admin')->user()->email }}"> -->
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
              <!-- <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>About Me</label>
                    <div class="form-group">
                      <label class="bmd-label-floating"> Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</label>
                      <textarea class="form-control" rows="5"></textarea>
                    </div>
                  </div>
                </div>
              </div> -->
              {{Form::submit( trans('Update Profile'), ['class'=>'btn btn-primary pull-right'])}}
              {!!Form::close()!!}
              <div class="clearfix"></div>
            <!-- </form> -->
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-profile">
          <div class="card-avatar">
            <a href="#pablo">
              <img class="img" src="{{asset('storage/admin/'.Auth::guard('admin')->user()->image)}}" />
            </a>
          </div>
          <div class="card-body">
            <h6 class="card-category">CEO / Co-Founder</h6>
            <h4 class="card-title">{{Auth::guard('admin')->user()->name}}</h4>
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
  $(document).ready(function(){
    $('#profile_form').validate({
      rules: {
        name: {
          required: true,
        },
        email: {
          required: true,
        }
      },
      errorElement: 'span',
      messages: {
        name: 'Please Enter Your Name',
        email: 'Please Enter Your Email Addres'
      } 
    });
  });
</script>
@endpush