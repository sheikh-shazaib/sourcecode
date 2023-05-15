@extends('layout.main')
@section('section')

    
<div class="content-wrapper" >
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 style="color: #3e3e42;" > <b>Department</b> </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Department</li>
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
            @if(session()->has('Delete'))
            <div class="alert alert-warning">
                {{ session()->get('Delete') }}
            </div>
            @endif
            
            @if(session()->has('Delete_success'))

            <div class="alert alert-success">
                {{ session()->get('Delete_success') }}
            </div>
            @endif
            <div id="success_message"></div>
            <div class="card-header">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                Add New Department
              </button>
            </div>
            <!-- /.card-header -->
            <form action="" id="showform">
            <div class="card-body">
              <div class="table-responsive">
                <table id="example2" class="table table-hover">
                  <thead class="table-secondary">
                  <div id="success_message"></div>
                <tr>
                  <th>Department ID</th>
                  <th>Department Name</th>
                  <th>Department Create Time</th>
                  <th>Department Update Time</th>
                  <th>Designations Count</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @if (!empty($count))
                      
                  
                @foreach ($count as $count)
               <tr>
                <td>{{$count['department_id']}}</td>
                <td>{{$count['department_name']}}</td>
                <td>{{$count['department_create_time']}}</td>
                <td>{{$count['department_update_time']}}</td>
                <td>{{$count['designations_count']}}</td>
                <td> 
                  <button id="edit_department" onclick="department_Edit('{{ $count['department_id'] }}','{{ $count['department_name'] }}')"  type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-edit"></i>
                  </button>
                  <br>
                  <button onclick="myFunction('{{ $count['department_id'] }}','{{ $count['department_name'] }}')" type="button" class="btn btn-danger" data-toggle="modal" data-target="#DeleteModal"><i class="fa fa-trash-o" style="font-size:20px"></i></button>
                  </td>
              </tr>
                @endforeach
                @endif
              </tbody>
              </table>
              </div>
            </div>
          </form>
          </div>
        </div></div></div>
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

      <form id="department_modal" class="form">
      
        <ul id="save_msgList"></ul>
        <div class="modal-body">
          
          <div class="form-group">
            <label for="department_name">Department Name</label>
            {{-- <input name="department_id" type="hidden" class="name form-control" required > --}}
            <input name="department_name" type="name" class="name form-control" required placeholder="Enter Department name" >
            
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
{{-- Edit Deapartment --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit	Department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="department_edit_modal" class="form">
          <div class="form-group">
            <label for="department_name">Department Name</label>
            <input name="department_id" type="hidden" value="" class="name form-control" required >
            <input name="department_name" type="name" value="" class="name form-control" required placeholder="Enter Department name" >
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="Updated" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
{{-- End  --}}
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
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input  name="id"  type="hidden" class=" form-control" id="getId" value="">
              {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
              <a href="javascript:void(0);" class="btn btn-danger " id="delete_btn">Delete</a> 
              <script>
                
              </script>
              {{-- <button type="button" class="btn btn-primary delete_student">Yes Delete</button> --}}
          </div>
      </div>
  </div>
</div>
{{-- End - Delete Modal --}}

@endsection
@push('js_link')
<script>
   $('#department_modal').submit(function(e){
        e.preventDefault();
       
          $.ajax({
          url: '{{url ('department_insert')}}',
          type: 'POST',
          data:  new FormData(this),
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
              console.log(response);
              if(response.status == 'FALSE')
              {
                $('#insert_d').prop('disabled',false);
                $(document).Toasts('create', {
                title: 'Department',
                body: 'Error Department Add.....'
              })
              $('#insert_d').prop('disabled',false);
                $('#exampleModalLong').modal('show');
              
              }else{
                $('#insert_d').prop('disabled',true);
                $(document).Toasts('create', {
                title: 'Designation',
                body: 'Add Department Success.....',
                timer: 3000,
              })
                
                $("#department_modal").modal('hide');
                
                setTimeout(() => {
                  location.reload();
                }, 3000);

              //    $(document).Toasts('create', {
              //   title: 'Department',
              //   body: 'Add Department Success.....'
              // })
                
              //   $("#department_modal").modal('hide');
              //   location.reload();
              }
            }             
        });

      });
  function department_Edit(department_id,department_name){
    $('input[name=department_id]').val(department_id);
    $('input[name=department_name]').val(department_name);
  }
function myFunction(id) {
                        // alert(id);
                        document.getElementById('getId').value= id;
                        document.getElementById('delete_btn').href= "{{ url('/department_Delete') }}/"+id;
                        
                        $('#delete_btn').prop('disabled',true);
                        document.getElementById("delete_btn").disabled = true;
                              }

      $('#department_edit_modal').submit(function(e){
        e.preventDefault();
       $('#Updated').prop('disabled',true);
          $.ajax({
          url: '{{url ('department_Edit')}}',
          type: 'POST',
          data:  new FormData(this),
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
              console.log(response);
              if(response.status == 'TRUE')
              {
                $(document).Toasts('create', {
                title: 'Department',
                body: 'Edit Department Success.....'
              })
                location.reload();
              }else{
                $(document).Toasts('create', {
                title: 'Department',
                body: 'Error Update.....'
              })
                $('#Updated').prop('disabled',false);
                $("#exampleModal").modal('show');
              }
            }             
        });

      });
      
      
</script>
@endpush