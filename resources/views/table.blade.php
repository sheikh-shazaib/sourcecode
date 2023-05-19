@extends('layout.main')
@section('section')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="color: #3e3e42;"> <b>Table Data</b> </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Designation</li>
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
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModalLong">
                                    Table View
                                </button>
                            </div>
                            <!-- /.card-header -->
                            <form action="" id="showform" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example2" class="table table-hover">
                                            <thead class="table-secondary">
                                                <div id="success_message"></div>
                                                <tr >

                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Password</th>
                                                    <th>Phone Number</th> 
                                                    <th>Adress</th>
                                                    <th>Status</th>
                                                    {{-- <th>Action</th> --}}
                                                </tr>
                                            </thead>
                                            {{-- @if (!empty($table_view)) --}}


                                            @foreach ($table_view as $table_view)
                                                <tbody>
                                                    <td>{{ $table_view['id'] }}</td>
                                                    <td>{{ $table_view['name'] }}</td>
                                                    <td>{{ $table_view['email'] }}</td>
                                                    <td>{{ $table_view['password'] }}</td>
                                                    <td>{{ $table_view['phone_number'] }}</td>
                                                    <td>{{ $table_view['adress'] }}</td>
                                                    <td>
                                                        @if ($table_view['status'] = 0)
                                                            Active
                                                        @else
                                                            Deactive
                                                        @endif
                                                    </td>
                                                   
                                                </tbody>
                                            @endforeach 
                                             {{-- @endif  --}}

                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Add New --}}
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addEmployee-tittle">Add Employee</h5>
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
  
        <form id="table_view" action="{{url('table_insert')}}" method="POST" class="form">
        @method('POST')
        @csrf
          {{-- <ul id="save_msgList"></ul> --}}
          <div class="modal-body">
            
            <div class="form-group">
              <label >Name</label>
              
              <input name="name" type="name" class="name form-control" required placeholder="Enter Name" >
              
            </div>
            <div class="form-group">
                <label   >Email</label>
                 
                <input name="email" type="email" class="name form-control" required placeholder="Enter Email" >
                
              </div>
              <div class="form-group">
                <label   >Password</label>
                 
                <input name="password" type="password" class="name form-control" required placeholder="Enter Password" >
                
              </div>
              <div class="form-group">
                <label   >Adress</label>
                 
                <input name="adress" type="name" class="name form-control" required placeholder="Enter Adress" >
                
              </div>
              <div class="form-group">
                <label   >Phone Number</label>
                 
                <input name="phone_number" type="name" class="name form-control" required placeholder="Enter Phone Number" >
                
              </div>
              <div class="form-group">
                <label   >Age</label>
                 
                <input name="age" type="number" class="name form-control" required placeholder="Enter Age" >
                
              </div>
              <div class="radio form-group">
                <label >Status</label>
                <input  type="radio" id="active" name="status" value="0" checked>
                <label for="Active">Active</label>
                
                <input type="radio" id="deactive" name="status" value="1">
                <label  for="deactive">Deactive</label>
                
              </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="insert_d"  class="btn btn-primary addEmployee">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  {{-- End  --}}
    {{-- End - Delete Modal --}}
@endsection

