@extends('layouts.master')
@section('content')
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-8">
            <div class="card">
               <div class="card-header card-header-primary">
                  <h4 class="card-title">Update Permission</h4>
                  <p class="card-category">Complete your Permission</p>
               </div>
               <div class="card-body">
                  <!-- <form> -->
                  {!! Form::open(['route'=> array('admin.permission.update',$data->id), 'id' => 'permission_form']) !!}
                  @csrf
                  @method('put')
                  <!-- -------------------------------------- Name ------------------------------------ -->
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="bmd-label-floating">{{ Form::label('name','Name')}}</label>
                           {{Form::text('name',$data['name'],['class'=>'form-control'])}}
                           @error('name')
                           <span role="alert">
                              <strong style="color:red;">{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                  </div>
                  {{Form::submit('Update Permission', ['class'=>'btn btn-primary pull-right'])}}
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
            name: {
               required: true,
            },
         },
         errorElement: 'span',
         messages: {
            name: 'Please Enter Permission Name !',
         }
      });
   });
</script>
@endpush
