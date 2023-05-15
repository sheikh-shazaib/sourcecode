@extends('layout.main')
@section('section')
    
    
<div class="content-wrapper" >
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
       
        
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="updateEmployeeForm" method="POST" action="{{ url('edit') }}" enctype='multipart/form-data'>
                @csrf
      
                <div class="card-body col-md-10" >
                  {{-- <div class="form-group"> --}}
                    {{-- <label for="">Email address</label> --}}
                    
                  {{-- </div> --}}
                  @if (!empty($data))
                      
                  
                  <div class="form-group col-25 " >
                    <input id="id1" name="id"  type="hidden" class="name form-control" value="{{$data[0]['customer_id']}}"   >
                     
                    <label for="name">Employee Name</label>
                    <input name="name" type="name" class="name form-control" value="{{$data[0]['customer_name']}}" required autocomplete="off">
                    <span class="text-danger">@error('customer_name') {{$message}} @enderror </span>
                  </div>
                  <div class="form-group ">
                    <label for="Email">Employee Email</label>
                    <input name="email" type="email" class="email form-control" value="{{$data[0]['customer_email']}}"   required autocomplete="off">
                    <span class="text-danger">@error('customer_email') {{$message}} @enderror </span>
                  </div>
                  {{--  --}}
                  
                {{--  --}}
                  <div class="form-group ">
                    <label for="Name">Department Name</label>
                    <select id="id_dep"  name="department_id" class="department_id custom-select form-control-border">
                      <option value="">Choose Department</option>
                      @foreach($departmentss as $departmentss)
                          @if($data[0]['department_id'] == $departmentss->department_id)
                              <option value="{{ $departmentss->department_id}}" selected>{{$departmentss->department_name}}</option>
                          @else
                              <option value="{{ $departmentss->department_id }}">{{$departmentss->department_name}}</option>
                          @endif
                      @endforeach
                      <span class="text-danger">@error('department_id') {{$message}} @enderror </span>
                    </select>
                    
                  </div>
                 
                  <div class="form-group ">
                    <label for="Name">Designation Name</label>
                    <select id="designation_id" name="designation_id" class="designationGetEmp custom-select form-control-border">
                      <option value="" >Choose Designation </option>

                      @foreach($designationss as $designationss)
                      
                                <option value="{{ $designationss['designation_id'] }}" @if($data[0]['designation_id'] == $designationss['designation_id']) selected @endif >{{$designationss['designation_name']}}</option>
                           
                          
                        @endforeach
                        <span class="text-danger">@error('designation_id') {{$message}} @enderror </span>
                    </select>
                  </div>

                  <div class="form-group " id="country">
                    <label for="Customer Countryr">Employee Country</label>
                    <select name="country"  class=" select custom-select form-control-border" require>
                      
                      <option value="Pakistan" @if($data[0]['customer_country'] == 'Pakistan') selected  @endif>
                        Pakistan
                      </option >
                      <option value="India" @if($data[0]['customer_country'] == 'India') selected  @endif>
                        India
                      </option>
                      <option value="England" @if($data[0]['customer_country'] == 'England') selected  @endif>
                        England
                      </option>
                    </select>
                    {{-- <span class="text-danger">@error('customer_code') {{$message}} @enderror </span> --}}
                  </div>
                  
                  <div class="form-group ">   
                    <label>Employee Password</label>
                    
                    <input name="password1" type="password checkbox" id="passwordShow" class="password form-control " value="{{$data[0]['customer_password']}}" autocomplete="off"     required>
                    {{-- <input type="checkbox" id="check">  Show Password --}}
                    <span class="text-danger">@error('customer_password') {{$message}} @enderror </span>
                  </div>
                  <div class="form-group">
                    <label for="phone">Employee Phone Number</label>
                    
                    <input name="phoneNumber" type="phone" class="phone form-control" value="{{$data[0]['customer_phone']}}" autocomplete="off"   required\>
                    <span class="text-danger">@error('customer_phone') {{$message}} @enderror </span>
                  </div>
                  {{-- <div class="form-group">
                    <label>Employee Image</label>
                    <input class="dropify" name="customer_image" type="file" class="form-control" data-default-file="{{ url('file') }}/{{$data[0]['customer_id']}}" data-allowed-file-extensions="jpg jpeg png gif webp">
                    <img id="image_edit" src="{{ url('file') }}/{{$data[0]['customer_id']}}">
                  </div> --}}
                  <div class="form-group">
                    <label for="">Employee Image</label>
                    <input  name="customer_image" type="file" class="form-control" value="{{ url('file') }}/{{ $data[0]['customer_image'] }}">
                    <span class="text-danger">@error('customer_image') {{$message}} @enderror </span>
                  </div>
                  @endif
                  @if (!empty($edit_leave))
                      
                  
                  <div class="form-group">
                    <label for="leave">Annual Leave</label>
                    <input  name="idLeave"  type="hidden" class="name form-control" value="{{$edit_leave[0]['leave_id']}}">
                    {{-- print_r({{$edit_leave[0]['leave_customer_id']}}) --}}
                    <input name="annual_leave" type="number" max="50" value="{{$edit_leave[0]['annual_leave']}}" class=" form-control" autocomplete="off">
                    <span class="text-danger">@error('annual_leave') {{$message}} @enderror </span>
                    
                  </div>
                  <div class="form-group">
                    <label for="leave">Casual Leave</label>
                    <input name="casual_leave" type="number"  max="50" value="{{$edit_leave[0]['casual_leave']}}"  class="form-control"  autocomplete="off">
                    <span class="text-danger">@error('casual_leave') {{$message}} @enderror </span>
                  </div>
                  <div class="form-group">
                    <label for="leave">Sick Leave</label>
                    <input name="sick_leave" type="number"  max="50" value="{{$edit_leave[0]['sick_leave']}}"  class="form-control" autocomplete="off" >
                    <span class="text-danger">@error('sick_leave') {{$message}} @enderror </span>
                  </div>
                  @endif
                  @if (!empty($data))
                      
                  
                  <div class="radio form-group">
                    <label for="Customer_status">Employee status</label>
                    <input  class="radios" type="radio" id="activeUpdate" name="status" value="0" @if($data[0]['customer_status'] == '0') checked  @endif>
                    <label for="Active">Active</label>
                    
                    <input class="radios" type="radio" id="activeUpdate2" name="status" value="1" @if($data[0]['customer_status'] == '1') checked  @endif>
                    <label for="deactive">Deactive</label>
                  </div>
                  @endif
                <!-- /.card-body -->
                

                <div class="modal-footer" >
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" id="Btn22">Update Employee</button>
                  {{-- <button type="submit" id="Btn2"  class="btn btn-primary "></button> --}}
                  
                </div>
                </div>
              </form>
            </div>
          </div>
      </div>
  </div>
</section>
</div>
@endsection
{{-- End - Delete Modal --}}
@push('js_link')

    <script>
     

    // $(document).ready(function() {
    //     $('.dropify').dropify();
    // });

$('#updateEmployeeForm').submit(function(e){
        //e.preventDefault();
        $.ajax({
          url: '{{ url('view_employee') }}/',
          type: 'POST',
          data: new FormData('#updateEmployeeForm'),
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            contentType: false,
            cache: false,
            processData: false,
          success: function(response){
              if(response.status == 'TRUE')
              {
               
                 // $('#exampleModalLong').modal('hide');
                 $('#Btn22').prop('disabled',true);
                $(document).Toasts('create', {
                title: 'Employee',
                body: 'Edit Employee Success....',
                timer: 3000,
                class: 'bg-success', // default success style
                autohide: true,
                delay: 3000, // hide after 3 seconds
                // timer: 3000,
              })
                setTimeout(() => {
                  location.replace('view_employee');
                }, 3000);
            }else{
             
              $(document).Toasts('create', {
                title: 'Employee',
                body: 'Error Employee Edit....',
                timer: 3000,
              })
                setTimeout(() => {
                }, 3000);
              }
            }             
        })
      });

      $('#id_dep').change(function(){;
        
  var dpt_id = $(this).find(':selected').val();
  // alert(dpt_id);
               $.ajax({
                   type: 'get',
                   url: '{{ url('designationGet') }}/'+dpt_id,
                   headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
           
                   success: function(result) {
                       $('#designation_id').html(result)
                       
                  }
               });
           
});        


////////////////////////
</script>
 @endpush