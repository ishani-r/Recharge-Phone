<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
               <div>
                  <a href="{{ route('admin.role.create') }}" class="btn btn-success">{{ trans('Add Role')}}</a>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <input type="hidden" value="{{$no=1}}">
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                              <th>{{ trans('No.')}}</th>
                              <th>{{ trans('Name')}}</th>
                              <th>{{ trans('Permission')}}</th>
                              <th>{{ trans('Action')}}</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($role as $roles)
                           <tr>
                              <td>{{$no++}}</td>
                              <td>{{$roles->name}}</td>
                              <td>
                                 <?php
                                 $p_id = App\Models\RoleHasPermission::where('role_id', '=', $roles->id)->select('permission_id')->get();
                                 ?>
                                 @foreach($p_id as $a)
                                 <?php
                                 $name = App\Models\Permission::where('id', '=', $a->permission_id)->select('name')->get();
                                 ?>
                                 @foreach($name as $names)
                                 {{$names->name}}<br>
                                 @endforeach
                                 @endforeach
                              </td>
                              <td>
                                 <a href="{{ route('admin.role.edit',$roles->id)}}"><button class="btn-sm btn-outline-info" style="border-radius: 2.1875rem;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                 <!-- <a href="{{ route('admin.role.destroy',$roles->id)}}"><button class="btn-sm btn-outline-danger" style="border-radius: 2.1875rem;"><i class="fa fa-trash" aria-hidden="true"></i></button></a> -->
                                 <button type="submit" data-id="{{$roles->id}}" class="btn-sm btn-outline-danger delete" style="border-radius: 2.1875rem;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <!-- <div class="card">
               <div class="card-header card-header-primary">
                  <a href="{{ route('admin.role.index')}}">
                     <h4 class="card-title"><i class="fa fa-hand-o-left" aria-hidden="true"></i> {{ trans('Back')}}</h4>
                  </a>
               </div>
            </div> -->
         </div>
      </div>
   </div>
</div>
@endsection
@push('js')
<script>
   // ---------------------------------------Delete-----------------------------
   $(document).on('click', '.delete', function() {
      swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
         })
         .then((willDelete) => {
            if (willDelete) {
               var id = $(this).data('id');
               var url = '{{route("admin.role.destroy", ":queryId")}}';
               url = url.replace(':queryId', id);
               var number = $(this).attr('id', 'asd');
               $.ajax({
                  url: url,
                  type: "DELETE",
                  data: {
                     id: id,
                     _token: '{{ csrf_token() }}'
                  },
                  dataType: "json",
                  success: function(data) {
                     window.location.reload();
                  }
               });
               swal("Poof! Your imaginary file has been deleted!", {
                  icon: "success",
               });
            } else {
               swal("Your imaginary file is safe!");
            }
         });
   });
</script>
@endpush