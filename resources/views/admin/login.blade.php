<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login Form</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<style>
    body{
        background-image: url("{{asset('admin/assets/images/phone12.jpg')}}");
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-position: center;
        background-size: 100%;
    }
    .form-control{
        padding: 21px;
        border: #000000 1px solid;
        border-radius: 15px;
        width: 465px;
    }
    .container {
        border: 1px solid #000000;
        margin: 10px auto;
        padding: 43px;
        width: 546px;
        border-radius: 18px;
        background:black;
        vertical-align: center;
        margin-top:140px;
        margin-left: 489px;
        margin-right: 400px;
        padding-top: 24px;
        background: rgba(129,111,111,.5);
        box-shadow: 0 20px 20px rgba(0,0,0,.5);
    }
    .btn{
        font-family: cursive;
        background-color: #5c1313;
        font-size: 25px;
    }
    .invalid-feedback {
        color: red;
    }
    .errorMsg {
        border: 1px solid red;
    }
    .is-invalid {
        border: red 3px solid !important;
    }
    h1{
        font-family: cursive;
    }
</style>
<body>
<div class="container">
    <h1 class="text-center"><font color="000000"><b>....Login form....</b></font></h1>
    <div class="row">
        <div class="col-md-6">
            <form method="post" action="{{ route('admin.login') }}">
                @csrf
                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" placeholder="Enter Password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="text-left">
                    <button class="btn btn-danger" type="submit">Login In</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>