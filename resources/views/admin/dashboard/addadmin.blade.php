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
         <div class="col-md-8">
            <div class="card">
               <div class="card-header card-header-primary">
                  <h4 class="card-title">{{ trans('Admin')}}</h4>
                  <!-- <p class="card-category">Complete your Package</p> -->
               </div>
               <div class="card-body">
                  <!-- <form> -->
                  {!! Form::open(['route'=> array('admin.adminuser.store'), 'id' => 'admin_form', 'enctype' => 'multipart/form-data']) !!}
                  <!-- --------------------------------- Name ------------------------------- -->
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="bmd-label-floating">{{ Form::label('name',trans('Name'))}}</label>
                           {{Form::text('name','',['class'=>'form-control'])}}
                           @error('name')
                           <span role="alert">
                              <strong style="color:red;">{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                     <!-- -------------------------------------- Mobile ----------------------------- -->
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="bmd-label-floating">{{ Form::label('email',trans('Email'))}}</label>
                           {{Form::text('email','',['class'=>'form-control'])}}
                           @error('email')
                           <span role="alert">
                              <strong style="color:red;">{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <!-- --------------------------------- Password ----------------------------- -->
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="bmd-label-floating">{{ Form::label('password', trans('Password'))}}</label>
                           <!-- {{Form::text('password','',['class'=>'form-control'])}} -->
                           {{ Form::password('password',array('class' => 'form-control')); }}
                           @error('password')
                           <span role="alert">
                              <strong style="color:red;">{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                     <!-- -------------------------- Confirem Password ------------------------------ -->
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="bmd-label-floating">{{ Form::label('confirm_password', trans('Confirm Password'))}}</label>
                           <!-- {{Form::text('confirm_password','',['class'=>'form-control'])}} -->
                           {{ Form::password('confirm_password',array('class' => 'form-control')); }}
                           @error('confirm_password')
                           <span role="alert">
                              <strong style="color:red;">{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                  </div>
                  <!-- --------------------------------- Select Profile ----------------------------- -->
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
                  <!-- ----------------------------- Assign Role ------------------------------ -->
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <select id="tests" name="tests">
                              @foreach($role as $permission)
                              <option class="dropdown-item" value="{{ $permission->id }}">{{ $permission->name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
                  {{Form::submit( trans('Add'), ['class'=>'btn btn-primary pull-right'])}}
                  {!!Form::close()!!}
                  <div class="col-md-8">
                     <a href="{{ route('admin.adminuser.index')}}" class="btn btn-primary pull-left">Cancel</a>
                  </div>
                  <div class="clearfix"></div>
                  <!-- </form> -->
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
      $('#admin_form').validate({
         rules: {
            name: {
               required: true,
            },
            email: {
               required: true,
            },
            password: {
               required: true,
               minlength: 8
            },
            confirm_password: {
               required: true,
               equalTo: "#password"
            },
            image: {
               required: true,
            }
         },
         errorElement: 'span',
         messages: {
            name: 'Please Enter Your Name',
            email: 'Please Enter Your Email Address',
            password: {
               required: 'Please Enter Your Password.',
               minlength: 'Please Enter at least 8 characters.'
            },
            confirm_password: {
               required: 'Please Enter Confirmation.',
               equalTo: 'Please Enter Confirm Password Same as a Password.'
            },
            image: 'Please Select Your Profile'
         },
      });


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