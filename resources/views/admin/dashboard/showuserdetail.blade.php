@extends('layouts.master')
@section('content')
<div class="content">
   <div class="row">
      <div class="col-md-5">
         @foreach($user['user'] as $user['user'])
            <div class="card">
               <div class="card-header card-header-primary">
                  <h4 class="card-title">{{ trans('Show User Detail')}}</h4>
                  <p class="card-category">{{ trans('Complete your profile')}}</p>
               </div>
               <div class="card-body">
                  <center><img src="{{asset('storage/admin/'.$user['user']->image)}}" class="rounded-circle" width="200px"></center>
                     <table class="table table-dark table-striped">
                        <tr>
                           <td>{{ trans('Name')}}</td>
                           <td>{{$user['user']->name}}</td>
                        </tr>
                        <tr>
                           <td>{{ trans('Image')}}</td>
                           <td>{{$user['user']->image}}</td>
                        </tr>
                     </table>
                  </div>
               </div>
            </div>
         @endforeach
         <div class="col-md-6">
            <div class="card">
               <div class="card-header card-header-primary">
                  <h4 class="card-title">{{ trans('Show User Personal Detail')}}</h4>
                  <p class="card-category">{{ trans('Complete your profile')}}</p>
               </div>
               <div class="card-body">
                  <table class="table table-dark table-striped">
                     <tr>
                        <td>{{ trans('Education')}}</td>
                        <td>{{$user['data']->education}}</td>
                     </tr>
                     <tr>
                        <td>{{ trans('Work')}}</td>
                        <td>{{$user['data']->work}}</td>
                     </tr>
                     <tr>
                        <td>{{ trans('Employer')}}</td>
                        <td>{{$user['data']->employer}}</td>
                     </tr>
                     <tr>
                        <td>{{ trans('About me')}}</td>
                        <td>{{$user['data']->about_me}}</td>
                     </tr>
                     <tr>
                        <td>{{ trans('Height')}}</td>
                        <td>{{$user['data']->height}}</td>
                     </tr>
                     <tr>
                        <td>{{ trans('Speaks')}}</td>
                        <td>{{$user['data']->speaks}}</td>
                     </tr>
                     <tr>
                        <td>{{ trans('Cast')}}</td>
                        <td>{{$user['data']->cast}}</td>
                     </tr>
                     <tr>
                        <td>{{ trans('Smoking')}}</td>
                        <td>{{$user['data']->smoking}}</td>
                     </tr>
                     <tr>
                        <td>{{ trans('Drinks')}}</td>
                        <td>{{$user['data']->drinks}}</td>
                     </tr>
                     <tr>
                        <td>{{ trans('Food')}}</td>
                        <td>{{$user['data']->food}}</td>
                     </tr>
                     <tr>
                        <td>{{ trans('When to marry year')}}</td>
                        <td>{{$user['data']->marray_age}}</td>
                     </tr>
                     <tr>
                        <td>{{ trans('Dressing')}}</td>
                        <td>{{$user['data']->dressing}}</td>
                     </tr>
                  </table>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-header card-header-primary">
               <a href="{{ route('admin.details.index')}}"><h4 class="card-title"><i class="fa fa-hand-o-left" aria-hidden="true"></i> {{ trans('Back')}}</h4></a>
            </div>
         </div>
   </div>
</div>
@endsection