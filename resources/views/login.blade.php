
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- MDB -->
<script
type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"rel="stylesheet"/>
<!-- MDB -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet"/>
    <style>
        .divider:after,
.divider:before {
content: "";
flex: 1;
height: 1px;
background: #eee;
}
    </style>
</head>
<body>
    <section class="vh-100" style="background-color: #f8f8f8" >
        <div class="container py-5 h-100">
          <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-7 col-lg-6 col-xl-5">
              <img src="{{url('disk/main-login-image.png')}}"
                class="img-fluid" style="width: 65%" alt="Phone image">
                <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">The Ultimate HR Management Solution</h1>
                <div class="text-gray-600 fs-base text-center fw-semibold">
                  At SourceCode, we have a reliable, secure and adaptable HR management built from the ground up.
                  <br>
                  We are determined to help our employees to give their best efforts every day to achieve the goals of their job.
                </div>
                
            </div>
            <div  class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
              <form action="{{ url('dashboard') }}" style="background-color: #ffffff" method="POST">
                @csrf
                @if (Session::has('success'))
                <div class="alert alert-success">{{session::get('success')}}</div>
                  @endif
                  @if (Session::has('fail'))
                <div class="alert alert-danger">{{session::get('fail')}}</div>
                  @endif
                  <div class="text-center mb-11">
                    <h1 class="text-dark fw-bolder mb-3">SourceCode - HCM</h1>
                    <div class="text-gray-500 fw-semibold fs-6">Log in to start your session</div>
                  </div>
                  <div class="text-center mb-11">
                  <img src="{{url('disk/hcm-logo-login-page.png')}}" style="width:40%" alt="logo" style="width: 70%">
                </div>

                @method('POST')
                
                <div class="form-outline mb-4">
                  <input  name="customer_id"  type="hidden" class="name form-control" value="{{old('customer_id')}}">

                  <input type="number" name="customer_code" value="{{old('customer_code')}}" min="0" style="border-bottom: 2px solid #4e4ee6; background-color: #f5f5f7;" class="form-control form-control-lg" autocomplete="off" />
                  <label class="form-label">Employee Code</label>
                  <span class="text-danger">@error('customer_code') {{$message}} @enderror </span>
                  {{-- <span class="text-danger">@errors('customer_email') {{$message}} @enderror </span> --}}
                </div>
                
                <div class="form-outline mb-4">
                  <input type="password" name="customer_password" value="{{old('customer_password')}}" style="border-bottom: 2px solid #4e4ee6; background-color: #f0f2f2;" class="form-control form-control-lg" />
                  <label class="form-label" >Password</label>
                  <span class="text-danger">@error('customer_password') {{$message}} @enderror </span>
                </div>
                
                <button type="submit" id="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                {{-- @stop --}}
                <div class="d-grid mb-10">
                  <span class="text-center">© 2023 SourceCode HCM. All Rights Reserved</span>
                  <span class="text-center pt-3">Version 4.0.1</span>
                </div>
              </form>
              
            </div>
          </div>
        </div>
      </section>
</body>
   

</html>