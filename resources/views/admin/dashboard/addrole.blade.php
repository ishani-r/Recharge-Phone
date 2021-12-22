@extends('layouts.master')
@push('css')
<style>
   .error {
      color: red;
   }

   .MultiCheckBox {
      border: 1px solid #e2e2e2;
      padding: 5px;
      border-radius: 4px;
      cursor: pointer;
   }

   .MultiCheckBox .k-icon {
      font-size: 15px;
      float: right;
      font-weight: bolder;
      margin-top: -7px;
      height: 10px;
      width: 14px;
      color: #787878;
   }

   .MultiCheckBoxDetail {
      display: none;
      position: absolute;
      border: 1px solid #e2e2e2;
      overflow-y: hidden;
   }

   .MultiCheckBoxDetailBody {
      overflow-y: scroll;
   }

   .MultiCheckBoxDetail .cont {
      clear: both;
      overflow: hidden;
      padding: 2px;
   }

   .MultiCheckBoxDetail .cont:hover {
      background-color: #cfcfcf;
   }

   .MultiCheckBoxDetailBody>div>div {
      float: left;
   }

   .MultiCheckBoxDetail>div>div:nth-child(1) {}

   .MultiCheckBoxDetailHeader {
      overflow: hidden;
      position: relative;
      height: 28px;
      background-color: #3d3d3d;
   }

   .MultiCheckBoxDetailHeader>input {
      position: absolute;
      top: 4px;
      left: 3px;
   }

   .MultiCheckBoxDetailHeader>div {
      position: absolute;
      top: 5px;
      left: 24px;
      color: #fff;
   }
</style>
@endpush
@section('content')
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header card-header-primary">
                  <h4 class="card-title">{{ trans('Add Role')}}</h4>
                  <!-- <p class="card-category">{{ trans('Complete your profile')}}</p> -->
               </div>
               <div class="card-body">
                  <!-- <form> -->
                  {!! Form::open(['route'=> array('admin.role.store'), 'id' => 'role_form']) !!}
                  @csrf
                  <!-- -------------------------------------- Name ------------------------------------ -->
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label class="bmd-label-floating">{{ Form::label('name',trans('Name'))}}</label>
                           {{Form::text('name','',['class'=>'form-control name'])}}
                           @error('name')
                           <span role="alert">
                              <strong style="color:red;">{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                        <p id="duplicat_name"></p>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <!-- ---------------------------- Table ----------------------------------- -->
                  </label>
                  <h3>{{ trans('Please Select Permission')}}</h3>
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th>{{ trans('Module Name')}}</th>
                              <th>{{ trans('Create')}}</th>
                              <th>{{ trans('Update')}}</th>
                              <th>{{ trans('View')}}</th>
                              <th>{{ trans('Delete')}}</th>
                           </tr>
                        </thead>
                        @php $n=1; @endphp
                        @foreach($permission as $value)
                        @if($n == 1)
                        <tr>
                           <td><b>{{$value->module_name}}</b></td>
                           @endif
                           <td>
                              <input type="checkbox" class="permision_check" name="permission[]" value="{{$value->id}}"> {{ $value->name }}
                           </td>
                           @if($n == 4)
                        </tr>
                        @php $n=0; @endphp
                        @endif
                        @php $n++; @endphp
                        @endforeach
                     </table>
                  </div>
                  <!-- ------------------------------------------------------------------ -->
                  <!-- <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <select id="test" name="test[]">
                              @foreach($per as $permission)
                              <option class="dropdown-item" value="{{ $permission->id }}">{{ $permission->name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div> -->
                  {{Form::submit('Add Role', ['class'=>'btn btn-primary pull-right add'])}}
                  {!!Form::close()!!}
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
</div>
@endsection

@push('js')
<script>
   $('#role_form').validate({
      rules: {
         name: {
            required: true,
         },
      },
      errorElement: 'span',
      messages: {
         name: 'Please Enter Role Name!',
      },
   });

   $(document).ready(function() {
      $(document).on("click", ".MultiCheckBox", function() {
         var detail = $(this).next();
         detail.show();
      });

      $(document).on("click", ".MultiCheckBoxDetailHeader input", function(e) {
         e.stopPropagation();
         var hc = $(this).prop("checked");
         $(this).closest(".MultiCheckBoxDetail").find(".MultiCheckBoxDetailBody input").prop("checked", hc);
         $(this).closest(".MultiCheckBoxDetail").next().UpdateSelect();
      });

      $(document).on("click", ".MultiCheckBoxDetailHeader", function(e) {
         var inp = $(this).find("input");
         var chk = inp.prop("checked");
         inp.prop("checked", !chk);
         $(this).closest(".MultiCheckBoxDetail").find(".MultiCheckBoxDetailBody input").prop("checked", !chk);
         $(this).closest(".MultiCheckBoxDetail").next().UpdateSelect();
      });

      $(document).on("click", ".MultiCheckBoxDetail .cont input", function(e) {
         e.stopPropagation();
         $(this).closest(".MultiCheckBoxDetail").next().UpdateSelect();

         var val = ($(".MultiCheckBoxDetailBody input:checked").length == $(".MultiCheckBoxDetailBody input").length)
         $(".MultiCheckBoxDetailHeader input").prop("checked", val);
      });

      $(document).on("click", ".MultiCheckBoxDetail .cont", function(e) {
         var inp = $(this).find("input");
         var chk = inp.prop("checked");
         inp.prop("checked", !chk);

         var multiCheckBoxDetail = $(this).closest(".MultiCheckBoxDetail");
         var multiCheckBoxDetailBody = $(this).closest(".MultiCheckBoxDetailBody");
         multiCheckBoxDetail.next().UpdateSelect();

         var val = ($(".MultiCheckBoxDetailBody input:checked").length == $(".MultiCheckBoxDetailBody input").length)
         $(".MultiCheckBoxDetailHeader input").prop("checked", val);
      });

      $(document).mouseup(function(e) {
         var container = $(".MultiCheckBoxDetail");
         if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.hide();
         }
      });
      // =================================================================
      $('.name').blur(function() {
         var error_phone = '';
         var name = $('.name').val();
         var _token = $('input[name = "_token"]').val();
         var filter = /(^([a-zA-z ]+)(\d+)?$)/u;
         if (!filter.test(name)) {
            $('#error').addClass('has-error');
            $('#duplicat_name').html('<label class = "text-danger">Invaild Role Name</label>');
            $('.add').attr('disabled', 'disabled');
         } else {
            $.ajax({
               url: "{{ route('admin.checkname')}}",
               method: "POST",
               data: {
                  name: name,
                  _token: _token
               },
               success: function(result) {
                  if (result != 'Name_Exists') {
                     $('#duplicat_name').html(
                        '<label class = "text-success">Role Name Available</label>'
                     );
                     $('.name').removeClass('has-error');
                     $('.add').attr('disabled', false);
                  } else if (result != 'Unique') {
                     $('#duplicat_name').html(
                        '<label class = "text-danger">Role Name is already exits.</label>'
                     );
                     $('#mobile').addClass('has-error');
                     $('.add').attr('disabled', false);
                  }
               }

            })
         }
      });
      // =================================================================

   });

   var defaultMultiCheckBoxOption = {
      width: '220px',
      defaultText: 'Select Below',
      height: '200px'
   };

   jQuery.fn.extend({
      CreateMultiCheckBox: function(options) {

         var localOption = {};
         localOption.width = (options != null && options.width != null && options.width != undefined) ? options.width : defaultMultiCheckBoxOption.width;
         localOption.defaultText = (options != null && options.defaultText != null && options.defaultText != undefined) ? options.defaultText : defaultMultiCheckBoxOption.defaultText;
         localOption.height = (options != null && options.height != null && options.height != undefined) ? options.height : defaultMultiCheckBoxOption.height;

         this.hide();
         this.attr("multiple", "multiple");
         var divSel = $("<div class='MultiCheckBox'>" + localOption.defaultText + "<span class='k-icon k-i-arrow-60-down'><svg aria-hidden='true' focusable='false' data-prefix='fas' data-icon='sort-down' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512' class='svg-inline--fa fa-sort-down fa-w-10 fa-2x'><path fill='currentColor' d='M41 288h238c21.4 0 32.1 25.9 17 41L177 448c-9.4 9.4-24.6 9.4-33.9 0L24 329c-15.1-15.1-4.4-41 17-41z' class=''></path></svg></span></div>").insertBefore(this);
         divSel.css({
            "width": localOption.width
         });

         var detail = $("<div class='MultiCheckBoxDetail'><div class='MultiCheckBoxDetailHeader'><input type='checkbox' class='mulinput' value='-1982' /><div>Select All</div></div><div class='MultiCheckBoxDetailBody'></div></div>").insertAfter(divSel);
         detail.css({
            "width": parseInt(options.width) + 10,
            "max-height": localOption.height
         });
         var multiCheckBoxDetailBody = detail.find(".MultiCheckBoxDetailBody");

         this.find("option").each(function() {
            var val = $(this).attr("value");

            if (val == undefined)
               val = '';

            multiCheckBoxDetailBody.append("<div class='cont'><div><input type='checkbox' class='mulinput' value='" + val + "' /></div><div>" + $(this).text() + "</div></div>");
         });

         multiCheckBoxDetailBody.css("max-height", (parseInt($(".MultiCheckBoxDetail").css("max-height")) - 28) + "px");
      },
      UpdateSelect: function() {
         var arr = [];

         this.prev().find(".mulinput:checked").each(function() {
            arr.push($(this).val());
         });

         this.val(arr);
      },
   });
</script>
@endpush