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
                  <h4 class="card-title">{{ trans('Teams Table')}}</h4>
                  <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     {!! $dataTable->table(['class' => 'table table-bordered']) !!}
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="card-header card-header-primary">
                  <a href="{{ route('admin.addteams')}}">
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
   // ---------------------------------------status-----------------------------
   $(document).on('click', '.status', function() {
      var id = $(this).data('id');
      var number = $(this).attr('id', 'asd');
      $.ajax({
         url: "{{route('admin.statussetting')}}",
         type: 'get',
         data: {
            id: id,
         },
         dataType: "json",
         success: function(data) {
            $("#asd").removeAttr("class");
            if (data.status == "Active") {
               $("#asd").addClass("badge rounded-pill bg-success status");
            } else {
               $("#asd").addClass("badge rounded-pill bg-danger status");
            }
            $("#asd").html(data.status);
            $('#settingdatatable-table').DataTable().ajax.reload();
         }
      })
   });
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
               var url = '{{route("admin.setting.destroy", ":queryId")}}';
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
                     $('#settingdatatable-table').DataTable().ajax.reload();
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
{!! $dataTable->scripts() !!}
@endpush