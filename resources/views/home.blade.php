@extends('layouts.app')
@section('content')

<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            @if (Session::has('success'))
            <div class="alert alert-success text-center">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
               <p>{{ Session::get('success') }}</p>
            </div>
            @endif
            @if (Session::has('error'))
            <div class="alert alert-danger text-center">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
               <p>{{ Session::get('error') }}</p>
            </div>
            @endif
            <div class="card-header">{{ __('You can create post Here') }}
               <div class="text-right">
                  <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModalCenter4">
                     Recharge History
                  </button>
               </div>
               <!-- Modal -->
               <div class="modal fade" id="exampleModalCenter4" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter4Title" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLongTitle">Recharge History</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                        <?php
                        $rech = App\Models\Recharge::where('user_id', Illuminate\Support\Facades\Auth::Guard('web')->user()->id)->get();
                        ?>
                        {{$no=1}}

                        <div class="modal-body">
                           <table class="table table-striped table-bordered text-center">
                              <tr>
                                 <td>No.</td>
                                 <td>Recharge Point</td>
                                 <td>Total Point</td>
                                 <td>Status</td>
                              </tr>
                              @foreach($rech as $name)
                              <tr>
                                 <td>{{$no++}}</td>
                                 <td>{{ $name->recharge_point }}</td>
                                 <td>{{ $name->total_point }}</td>
                                 <td>{{ $name->status }}</td>
                              </tr>
                              @endforeach

                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="card-body">

               @if (session('status'))
               <div class="alert alert-success" role="alert">
                  {{ session('status') }}
               </div>
               @endif
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                  Create Post
               </button>
               <!-- Points -->
               <div class="text-right">
                  <form method="post" action="{{ route('send_request')}}" id="recharge_form">
                     @csrf
                     <div class="form-group">
                        <label>Recharge Point</label>
                        <input type="text" id="request_point" name="request_point" class="form-control @error('request_point') is-invalid @enderror" placeholder="Enter Recharge Point">
                        @error('request_point')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                     <button type="submit" class="btn btn-success">Send Request</button>
                  </form>
                  <!-- <a href="{{ route('send_request')}}" type="submit" class="btn btn-primary">
                     Send Request
                  </a> -->

                  <h5>If you get more than 30 points,
                     </br> you will be able to send recharge Request</h5>
                  <?php
                  $total_point = App\Models\Point::where('user_id', Illuminate\Support\Facades\Auth::Guard('web')->user()->id)->get();
                  // dd($total_point);
                  ?>
                  @foreach($total_point as $a)
                  <!-- <input type="text" readable name="points" value="{{$a->total_point == NULL ? '0' : $a->total_point}}" > -->
                  <h3>Your Points = {{$a->total_point == NULL ? '0' : $a->total_point}}</h3>
                  @endforeach
               </div>

               <!-- Modal -->
               <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLongTitle">Create Post</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                        <div class="modal-body">
                           <form method="post" action="{{ route('add_post')}}" id="create_post" enctype="multipart/form-data">
                              @csrf
                              <div class="form-group">
                                 <label>Title Name</label>
                                 <input type="text" id="title_name" name="title_name" class="form-control @error('title_name') is-invalid @enderror title_name" placeholder="Enter Post Title">
                                 @error('title_name')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                                 <p id="duplicat_name"></p>
                              </div>
                              <div class="form-group">
                                 <label>Image</label>
                                 <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" placeholder="Enter Post Title">
                                 @error('image')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </div>
                              <div class="modal-footer">
                                 <button type="reset" class="btn btn-secondary asd" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Submit</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         </br>
         <div class="card">
            <?php
            $showpost = App\Models\Post::where('user_id', Illuminate\Support\Facades\Auth::Guard('web')->user()->id)->get();
            ?>
            @foreach($showpost as $name)
            <div class="card-header">{{$name->title_name}}</div>
            <div class="card-body">
               <img src="{{ asset('storage/admin/'.$name->image)}}" width="90px" alt="" class="img-responsive">
            </div>
            @endforeach
         </div>
      </div>
   </div>
</div>
@endsection
@push('js')
<script>
   $(document).ready(function() {
      $('#create_post').validate({
         rules: {
            title_name: {
               required: true,
            },
            image: {
               required: true,
					extension: "jpg|jpeg|png"
            },
         },
         messages: {
            title_name: "Please Enter Your Name",
            image: "Please Select image",
         },
         highlight: function(element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
         },
         unhighlight: function(element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
         },

      });

      $('#recharge_form').validate({
         rules: {
            request_point: {
               required: true,
            },
         },
         messages: {
            request_point: "Please enter how many points you want to recharge",

         },
         highlight: function(element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
         },
         unhighlight: function(element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
         },
      });

      $('.asd').click(function() {
         $('.error').html('');
         $('input').removeClass('is-invalid');
      });
      $('.close').click(function() {
         $('.error').html('');
         $('input').removeClass('is-invalid');

      });

      $('.title_name').blur(function() {
         var error_phone = '';
         var title_name = $('.title_name').val();
         var _token = $('input[name = "_token"]').val();
         var filter = /(^([a-zA-z]+)(\d+)?$)/u;
         if (!filter.test(title_name)) {
            $('#error').addClass('has-error');
            $('#duplicat_name').html('<label class = "text-danger error">Invaild Title Name !!</label>');
            $('.add').attr('disabled', 'disabled');
         } else {
            $.ajax({
               url: "{{ route('title_name')}}",
               method: "POST",
               data: {
                  title_name: title_name,
                  _token: _token
               },
               success: function(result) {
                  if (result != 'Name_Exists') {
                     $('#duplicat_name').html(
                        '<label class = "text-success error">Now Title Name Available !!</label>'
                     );
                     $('.title_name').removeClass('has-error');
                     $('.add').attr('disabled', false);
                  } else if (result != 'Unique') {
                     $('#duplicat_name').html(
                        '<label class = "text-danger error">Title Name is already exits !!</label>'
                     );
                     $('#mobile').addClass('has-error');
                     $('.add').attr('disabled', false);
                  }
               }
            })
         }
      });
   });
</script>
@endpush