@extends('layout.main')
@section('section')
    

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addEmployee-tittle">Add Employee</h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form id="addEmployeeForm" action="POST" class="form">
        @csrf
        @method('POST')
        <ul id="save_msgList"></ul>
        <div class="modal-body">
          {{-- <div class="form-group">
            <label for="name">Employee Code</label>
            <input name="code" type="number" class="name form-control" required placeholder="Enter Employee Code" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="name">Employee Name</label>
            <input name="name" type="name" class="name form-control" required placeholder="Enter Employee name" autocomplete="off">
          </div> --}}
          <div class="form-group">
            <input id="id1" name="id"  type="hidden" class="name form-control" value="{{$data[0]['customer_id']}}"   >

            <label for="name">Employee Name</label>
            <input name="name" type="name" class="name form-control" required placeholder="Enter Employee name" autocomplete="off">
          </div>
          <div class="form-group">
              <label for="Email">Employee Email</label>
              <input name="email" type="email" class="email form-control" required  placeholder="Enter Employee email" autocomplete="off">
            </div>
            
            <div class="form-group">
              <label for="Name">Department Name</label>
              <select id="id_dep"  name="department_id" class="department_id custom-select form-control-border" required >
                <option value="">Choose Department</option>
                
                @if (!empty($dep))

                @foreach($dep as $item)
                <option value="{{ $item['department_id'] }}">
                  {{ $item['department_name'] }}</option>
              @endforeach
              
                @endif

                
              </select>
              
            </div>

            <div class="form-group">
              <label for="Name">Designation Name</label>
              <select id="designation_id" name="designation_id" class="custom-select form-control-border" required >
                <option value="">Choose Designation </option>
              </select>
            </div>
            
            
            <div class="form-group">
              <label for="Customer Countryr">Employee Country</label>
              <select name="country" class="country custom-select form-control-border" required >
                <option>Pakistan</option>
                <option>India</option>
                <option>England</option>
              </select>
              
            </div>
            <div class="form-group">   
              <label>Employee Password</label>
              <input name="password" type="password" class="password form-control" required placeholder="Enter Employee Password" autocomplete="off">
              
            </div>
            <div class="form-group">
              <label for="phone">Employee Phone Number</label>
              <input name="phone" type="phone" class="phone form-control" required  placeholder="Enter Employee Phone" autocomplete="off">
              
            </div>
            <div class="form-group">
              <label>Employee Image</label>
              @if (!empty($data))
              <input class="dropify" name="customer_image" type="file" class="form-control"    data-default-file="{{ url('file') }}/{{$data[0]['customer_id']}}" data-allowed-file-extensions="jpg jpeg png gif webp"> 
              @endif
              {{-- <img id="image_edit" src="{{ url('file') }}/{{$data[0]['customer_id']}}"> --}}
            </div>
        
            <div class="form-group">
              <label for="leave">Annual Leave</label>
              <input name="annual_leave" type="number" max="50" class=" form-control" autocomplete="off">
              
            </div>
            <div class="form-group">
              <label for="leave">Casual Leave</label>
              <input name="casual_leave" type="number"  max="50"  class="form-control" required autocomplete="off">
              
            </div>
            <div class="form-group">
              <label for="leave">Sick Leave</label>
              <input name="sick_leave" type="number"  max="50"  class="form-control" required autocomplete="off">
            </div>
            
            <div class="radio form-group">
              <label for="Customer_status">Employee status</label>
              <input  type="radio" id="active" name="drone" value="0" checked>
              <label for="Active">Active</label>
              
              <input type="radio" id="deactive" name="drone" value="1">
              <label  for="deactive">Deactive</label>
              
            </div>

            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="Btn1"  class="btn btn-primary addEmployee">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>


{{-- End Add employee  --}}

{{--  --}}

<div class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 style="color: #3e3e42; "> <b>Employee Data</b>  </h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Employee Data</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
        
    <section class="content">
      
        <div class="container-fluid">
          <div class="row">
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-12">
              <div class="card">
                <div id="success_message"></div>
                <div class="card-header">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                    Add New Employee
                   
                  </button>
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#import_data_modal_id">
                    Import Employee Data
                  </button>

                  <a href="{{url('download_pdf')}}"><button class="btn float-right"><i class="fa fa-download"></i> Download Pdf File</button></a>
                  {{--  --}}
                  <a href="{{url('download_excel')}}"><button class="btn float-right"><i class="fa fa-download"></i> Download Ecxel File</button></a>
                  {{-- <a href="" class="btn btn-info">Download</a> --}}
                  {{-- <a href="{{url('import_data_excel')}}" class="btn btn-success">Import Data</a> --}}
                </div>
                
                <!-- /.card-header -->
                <form action="" id="showform" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="table-responsive">
                  <table id="example2" class="table table-hover">
                    <thead class="table-secondary">
                      
                    <tr >
                      
                      <th>Employee ID</th>
                      <th>Employee Code</th>
                      <th>Employee Image</th>
                      <th>Employee Name</th>
                      <th>Employee Email</th>
                      <th>Department Name</th>
                      <th>Designation Name</th>
                      <th>Employee Country</th>
                      <th>Employee Password</th>
                      <th>Employee Phone</th>
                      {{-- <th>Leave ID</th> --}}
                      <th>Annual Leave</th>
                      <th>Casual Leave</th>
                      <th>Sick Leave</th>
                      <th>Employee status</th>

                      <th>Action</th>

                    </tr>
                    </thead>
                    @if (!empty($data))
                      @foreach ($data as $x)

                      <tbody>
                        <tr>
                        <td >{{$x['customer_id']}}</td>
                        <td >{{$x['customer_code']}}</td>
                        {{-- <td >{{$x['customer_image']}}</td> --}}
                        <td>
                          <img src="{{ url('file') }}/{{ $x['customer_id'] }}" style="width:60%;">
                          {{-- <img src="{{ asset('dist/profile_image/'.$x['customer_image'])}}" style="width:60%;"> --}}
                        </td>
                        <td >{{$x['customer_name']}}</td>
                        <td>{{$x['customer_email']}}</td>
                        <td>{{$x['department_name']}}</td>
                        <td>{{$x['designation_name']}}</td>
                        <td>{{$x['customer_country']}}</td>
                        <td>{{$x['customer_password']}}</td>
                        <td>{{$x['customer_phone']}}</td>
                        {{-- <td>{{$x['leave_id']}}</td> --}}
                        <td>{{$x['annual_leave']}}</td>
                        <td>{{$x['casual_leave']}}</td>
                        <td>{{$x['sick_leave']}}</td>
                        <td>
                        @if ($x['customer_status'] == 0)
                            Active
                        @else
                            Decative
                        @endif
                            
                        
                        </td>

                        <td> 
                          
                          <a href="{{ url('edit_employee') }}/{{ $x['customer_id'] }}" class="btn btn-info"><i class="fa fa-edit"></i></a>

                          <br>
                          {{-- <a href="{{ url('delete') }}/{{ $x['customer_id'] }}" class="btn btn-danger"><i class="fa fa-trash-o" style="font-size:20px"></i></a> --}}
                            <button onclick="myFunction('{{ $x['customer_id'] }}','{{ $x['leave_id'] }}','{{ $x['customer_name'] }}')" type="button" class="btn btn-danger" data-toggle="modal" data-target="#DeleteModal"><i class="fa fa-trash-o" style="font-size:20px"></i></button>
                            
                          </td>
                        </tr>
                        </tbody>
                       @endforeach
                    @endif
                    
                  </table>
                </div>
                </div>
              </form>
              </div>
            </div></div></div>
          </section>
  
    </div>
</div>

{{-- Delete Modal --}}

<div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="DeleteModal" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="DeleteModal">Delete Employee Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
          </div>
          <div class="modal-body">
              <h4>Confirm to Delete Data ?</h4>
              {{-- <input type="hidden" id="DeleteModal"> --}}
              {{-- <input name="id"  type="hidden" class="name form-control" value="{{$x[0]['customer_id']}}"> --}}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input  name="id"  type="hidden" class=" form-control" id="getId" value="">
              {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
              <a href="javascript:void(0);" class="btn btn-danger " id="delete_btn">Delete</a> 
              {{-- <button type="button" class="btn btn-primary delete_student">Yes Delete</button> --}}
          </div>
      </div>
  </div>
</div>


<!--Import Data -->
<div class="modal fade" id="import_data_modal_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Excel File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form method="POST" id="import_form_id" enctype="multipart/form-data" class="form">
        @csrf
        @method('POST')
           
          
        <div class="modal-body">
          <div class="form-group">
            <input name="import_data"  type="file" class="form-control">
            
          </div>
        </div>
      
      
      
    
    <div class="modal-footer">

      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <input type="submit" id="submit" value="Submit" class="btn btn-primary">
    </div>
  </form>
    </div>
  </div>
</div>
@endsection
@push('js_link')
    <script>
    
       $(document).ready(function() {
        $('.dropify').dropify();
    });


    $('#import_form_id').submit(function(e){
        e.preventDefault();
        $('#submit').prop('disabled',false);
          $.ajax({
          url: '{{url('ecxel_import')}}',
          type: 'POST',
          data:  new FormData(this),
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
              
              // console.log(response);
              if(response.status == 'TRUE')
              {
                $('#submit').prop('disabled',true);
                $(document).Toasts('create', {
                title: 'Excel Import',
                body: 'Add New Excel Import Data Success.....',
                // class: 'bg-success my-toast', // default success style
                // autohide: true,
                // delay: 3000, // hide after 3 seconds
                // timer: 10000,
              })
                
                $("#import_data").modal('hide');
                
                setTimeout(() => {
                  location.reload();
                }, 3000);
                // 
               
              
              }else
              {
                $(document).Toasts('create', {
                title: 'Excel Import',
                body: 'Email Or Phone Number Are Same .....'
              })
              $('#import_data').prop('disabled',false);
                $('#import_data_modal_id').modal('show');
              }
            }             
        });

      });
    //   function editEmp(customer_id,customer_name,customer_email,customer_country,customer_password,customer_phone,customer_status ){
    //     $('input[name=id]').val(customer_id);
    //     $('input[name=name]').val(customer_name);
    //     $('input[name=email]').val(customer_email);
    //     $('input[name=password1]').val(customer_password);
    //     $('#check').change(function(){
    //       if($(this).prop("checked") == true)
    //       {
    //         $('#passwordShow').attr("type","text");
    //       }else{
    //         $('#passwordShow').attr("type","password");
    //       }
    //     });
    //     $('input[name=phone]').val(customer_phone);
    //      $('select[name=country] option[value='+customer_country+']').attr('selected','selected');

    //     if(customer_status == 0){
    //       $("#activeUpdate").prop("checked", true);
    //     } else{
    //       $("#activeUpdate2").prop("checked", true);
    //     }

    // } 
      $('#addEmployeeForm').submit(function(e){
        e.preventDefault();
       
          $.ajax({
          url: 'insert_employee',
          type: 'POST',
          data:  new FormData(this),
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
              if(response.status == 'FALSE')
              {
                
                $('#Btn1').prop('disabled',false);
                $(document).Toasts('create', {
                title: 'Add Employee',
                body: 'Email Or Phone Number Are Same .....'
              })
              $('#addEmployeeForm').prop('disabled',false);
                $('#exampleModalLong').modal('show');
              
              }else
              {
                $('#Btn1').prop('disabled',true);
                $(document).Toasts('create', {
                title: 'Designation',
                body: 'Add New Employee Success.....',
                // class: 'bg-success my-toast', // default success style
                // autohide: true,
                // delay: 3000, // hide after 3 seconds
                // timer: 10000,
              })
                
                $("#addEmployeeForm").modal('hide');
                
                setTimeout(() => {
                  location.reload();
                }, 3000);
              }
            }             
        });

      });
$('#id_dep').change(function(){
  //let dpt_id = $(this).val();
  var dpt_ids = $(this).find(':selected').val();
  // alert(dpt_ids)
  //console.log(dpt_id);
          // if(dpt_id){
               $.ajax({
                   type: 'get',
                   url: '{{ url('designationGet') }}/'+dpt_ids,
                   headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
           
                   success: function(result) {
                       $('#designation_id').html(result)
                       
                  }
               });
           
});   

                              function myFunction(id , name) {
                                // alert(id);
                                document.getElementById('getId').value= id;
                                document.getElementById('delete_btn').href= "{{ url('/delete') }}/"+id;
                                document.getElementById("delete_btn").disabled = true;
                                // x.delete()
                                // document.write("shahzaib");
                              }

    </script>
 @endpush