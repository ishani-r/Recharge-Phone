@extends('layouts.master')
@section('content')
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header card-header-primary">
                  <h4 class="card-title">{{ trans('Role Table')}}</h4>
                  <!-- <p class="card-category"> {{ trans('Here is a List for Replay Table')}}</p> -->
               </div>
               <!-- <div>
                  <a href="{{ route('admin.role.create') }}" class="btn btn-success">{{ trans('Add Role')}}</a>
               </div> -->
               <div class="card-body">
                  <!-- <form> -->
                  {!! Form::open(['route'=> array('admin.role.update',$role->id), 'id' => 'role_form']) !!}
                  @csrf
                  @method('put')
                  <!-- ----------------------------------- Name --------------------------------- -->
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="bmd-label-floating">{{ Form::label('name','Name')}}</label>
                           {{Form::text('name',$role['name'],['class'=>'form-control'])}}
                           @error('name')
                           <span role="alert">
                              <strong style="color:red;">{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                  </div>

                  <div class="clearfix"></div>
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th>Module Name</th>
                              <th>Create</th>
                              <th>Update</th>
                              <th>View</th>
                              <th>Delete</th>
                           </tr>
                        </thead>
                        @php $n=1; @endphp
                        @foreach($permission as $value)
                        @if($n == 1)
                        <tr>
                           <td><b>{{$value->module_name}}</b></td>
                           @endif
                           @if(isset($rolePermissions))
                           <td>
                              <input type="checkbox" class="permision_check" name="permission[]" value="{{$value->id}}" {{in_array($value->id, $rolePermissions) ? 'checked' : ''}}>{{ $value->name }}
                           </td>
                           @else
                           <td>
                              <input type="checkbox" class="permision_check" name="permission[]" value="{{$value->id}}"> {{ $value->name }}
                           </td>
                           @endif
                           @if($n == 4)
                        </tr>
                        @php $n=0; @endphp
                        @endif
                        @php $n++; @endphp
                        @endforeach
                     </table>
                  </div>
                  {{Form::submit('Update Role', ['class'=>'btn btn-primary pull-right'])}}
                  {!!Form::close()!!}
               </div>
            </div>

            <div class="card">
               <div class="card-header card-header-primary">
                  <a href="{{ route('admin.role.index')}}">
                     <h4 class="card-title"><i class="fa fa-hand-o-left" aria-hidden="true"></i> {{ trans('Back')}}</h4>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection