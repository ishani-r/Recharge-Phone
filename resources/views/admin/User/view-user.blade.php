@extends('layouts.master')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">{{ trans('Show User')}}</h4>
                    </div>
                    <div class="card-body">
                    <table class="table table-dark table-striped">
                        <tr>
                            <td>Name</td>
                            <td>{{$data->name}}</td>
                        </tr>
                        <tr>
                            <td>Mobile</td>
                            <td>{{$data->mobile}}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{$data->email}}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>{{$data->status}}</td>
                        </tr>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header card-header-primary">
                        <a href="{{ route('admin.list_user')}}"><h4 class="card-title"><i class="fa fa-hand-o-left" aria-hidden="true"></i> {{ trans('Back')}}</h4></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection