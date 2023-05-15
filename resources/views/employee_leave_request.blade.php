@extends('layout.main')
@section('section')


<div class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 style="color: #3e3e42; "> <b>Employee Leave Request</b>  </h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Employee Leave</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
        
    <section class="content">
      
        <div class="container-fluid">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div class="card">
                <div id="success_message"></div>
                <div class="card-header">
                  {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                    Employee Leave
                  </button> --}}
                </div>
                <!-- /.card-header -->
                <form action="" id="showform">
                <div class="card-body">
                  <table id="example2" class="table table-hover">
                    <thead class="table-secondary">
                      <div id="success_message"></div>
                    <tr>
                      
                      <th>Leave ID</th>
                      <th>Employee ID</th>
                      <th>Leave Employee Name</th>
                      <th>Annual Leave</th>
                      <th>Casual Leave</th>
                      <th>Sick Leave</th>
                    </tr>
                    </thead>
                   
                      @foreach ($employee_leave as $x)

                      <tbody>
                        <td>{{$x['leave_id']}}</td>
                        <td>{{$x['customer_id']}}</td>
                        <td>{{$x['customer_name']}}</td>
                        <td>{{$x['annual_leave']}}</td>
                        <td>{{$x['casual_leave']}}</td>
                        <td>{{$x['sick_leave']}}</td>                   
                        </td>

                        {{-- <td> 
                          
                          <a href="{{ url('edit_employee') }}/{{ $x['customer_id'] }}" class="btn btn-info"><i class="fa fa-edit"></i></a>

                          <br>
                          {{-- <a href="{{ url('delete') }}/{{ $x['customer_id'] }}" class="btn btn-danger"><i class="fa fa-trash-o" style="font-size:20px"></i></a> --}}
                            {{-- <button onclick="myFunction('{{ $x['customer_id'] }}','{{ $x['customer_name'] }}')" type="button" class="btn btn-danger" data-toggle="modal" data-target="#DeleteModal"><i class="fa fa-trash-o" style="font-size:20px"></i></button>
                            
                          </td> --}}
                        </tbody>
                       @endforeach
                    
                    
                  </table>
                </div>
              </form>
              </div>
            </div></div></div>
          </section>
  
    </div>
</div>


@endsection
@push('js_link')
    <script>
</script>
@endpush