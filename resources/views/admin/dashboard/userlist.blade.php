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
            <h4 class="card-title">{{ trans('Users Table')}}</h4>
            <p class="card-category"> {{ trans('Here is a data for Users')}}</p>
          </div>
          <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <label class="bmd-label-floating">{{ trans('Select File')}}</label>
            <input type="file" name="file" class="form-control">
            @error('file')
            <span role="alert">
              <strong style="color:red;">{{ $message }}</strong>
            </span>
            @enderror
            <br>
            <button class="btn btn-success">{{ trans('Import User Data')}}</button>
            <a class="btn btn-warning" href="{{ route('admin.export') }}">{{ trans('Export User Data')}}</a>
          </form>
          <div>
            <!-- <a href="{{ route('admin.dashboard.create') }}" class="btn btn-success">Add User</a> -->
          </div>
          <!-- --------------------------------------------------- -->
          <!-- --------------------------------------------------- -->
          <div class="card-body">
            <div class="table-responsive-sg">
              {!! $dataTable->table()!!}
            </div>
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
      url: "{{route('admin.changestatus')}}",
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
        $('#usersdatatable-table').DataTable().ajax.reload();
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
          var delet = $(this).data('id');
          var url = '{{route("admin.dashboard.destroy", ":queryId")}}';
          url = url.replace(':queryId', delet);
          $.ajax({
            url: url,
            type: "DELETE",
            data: {
              id: delet,
              _token: '{{ csrf_token() }}'
            },
            dataType: "json",
            success: function(data) {
              $('#usersdatatable-table').DataTable().ajax.reload();
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