
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
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                class="img-fluid" alt="Phone image">
                <h3>Fast, Efficient and Productive</h3>
                <p>At SourceCode, we have a reliable, secure and adaptable HR management built from the ground up.
                    We are determined to help our employees to give their best efforts every day to achieve the goals of their job</p>
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
              <form action="{{ url('dashboard') }}" style="background-color: #ffffff" method="POST">
                @csrf
                @if (Session::has('success'))
                <div class="alert alert-success">{{session::get('success')}}</div>
                  @endif
                  @if (Session::has('fail'))
                <div class="alert alert-danger">{{session::get('fail')}}</div>
                  @endif
                  <h4></h4>
                  <img src="{{url('dist/img/download.jpg')}}" alt="" style="width: 70%">
                {{-- <img style="width:40%;" src="data:image/jpeg;base64,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" alt="logo"> --}}
                {{-- <h1 align="center" style="color: rgb(34, 39, 170)">
                 <u><b>Login</b></u>   
                </h1> --}}
                {{-- <img src="https://www.doolinns.com/wp-content/uploads/2019/06/login-logo-png-6.png" style="width: 50%; align:center;" alt=""> --}}
                @method('POST')
                <input  name="customer_id"  type="hidden" class="name form-control" value="{{old('customer_id')}}">
                {{-- <input type="hidden" value="{{old('customer_id')}}" /> --}}
                <div class="form-outline mb-4">
                  
                  <input type="email" name="customer_email" value="{{old('customer_email')}}" style="border-bottom: 2px solid #4e4ee6; background-color: #f5f5f7;" class="form-control form-control-lg" />
                  <label class="form-label">Email address</label>
                  <span class="text-danger">@error('customer_email') {{$message}} @enderror </span>
                  {{-- <span class="text-danger">@errors('customer_email') {{$message}} @enderror </span> --}}
                </div>
                
                <div class="form-outline mb-4">
                  <input type="password" name="customer_password" value="{{old('customer_password')}}" style="border-bottom: 2px solid #4e4ee6; background-color: #f0f2f2;" class="form-control form-control-lg" />
                  <label class="form-label" >Password</label>
                  <span class="text-danger">@error('customer_password') {{$message}} @enderror </span>
                </div>
                
                <button type="submit" id="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                {{-- @stop --}}
              </form>
            </div>
          </div>
        </div>
      </section>
</body>
   

</html>