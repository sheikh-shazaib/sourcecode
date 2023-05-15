@extends('layout.main')
@section('section')
    
    
<div class="content-wrapper" >
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 style="color: #3e3e42;"> <b>Designation</b> </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
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
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                Add New Designation
              </button>
            </div>
            <!-- /.card-header -->
            <form action="" id="showform" enctype="multipart/form-data">
            <div class="card-body">
              <div class="table-responsive">
              <table id="example2" class="table table-hover">
                <thead class="table-secondary">
                  <div id="success_message"></div>
                <tr>
                  
                  <th>Designation ID</th>
                  <th>Designation Name</th>
                  <th>Department Name</th>
                  <th>Designation Create Time</th>
                  <th>Designation Update Time</th>
                  <th>Action</th>
                </tr>
                </thead>
                @if (!empty($designation_data))
                    
                               
                  @foreach ($designation_data as $designation_data)

                  <tbody>
                    <td>{{$designation_data['designation_id']}}</td>
                    <td>{{$designation_data['designation_name']}}</td>
                    <td>{{$designation_data['department_name']}}</td>
                    <td>{{$designation_data['designation_create_time']}}</td>
                    <td>{{$designation_data['designation_update_time']}}</td>
                    <td> 
                      
                      <button id="edit_designation" onclick="designation_Edit('{{ $designation_data['designation_id'] }}','{{ $designation_data['designation_name'] }}','{{ $designation_data['department_id'] }}')"  type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-edit"></i>
                      </button>
                      <br>
                      {{-- <a href="{{ url('delete') }}/{{ $x['customer_id'] }}" class="btn btn-danger"><i class="fa fa-trash-o" style="font-size:20px"></i></a> --}}
                        <button onclick="myFunction('{{ $designation_data['designation_id'] }}','{{ $designation_data['designation_name'] }}')" type="button" class="btn btn-danger" data-toggle="modal" data-target="#DeleteModal"><i class="fa fa-trash-o" style="font-size:20px"></i></button>
                        
                      </td>
                    </tbody>
                   @endforeach
                   @endif 
                
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
        <h5 class="modal-title" id="addEmployee-tittle">Add Designation</h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form id="designation_modal" action="{{url('designation_insert')}}" method="POST" class="form">
        @csrf
        @method('POST')
        <ul id="save_msgList"></ul>
        <div class="modal-body">
          
         
          <div class="form-group">
            <label for="Name">Department Name</label>
            <select id="id_dep"  name="department_id" class="department_id custom-select form-control-border">
              <option value="">Choose Department</option>
              {{-- <option>Waleed Bhai</option>
              <option>shahzaib</option> --}}
              @if (!empty($des))
                  
              @foreach($des as $item)
      <option value="{{ $item['department_id'] }}">
        {{ $item['department_name'] }}</option>
               @endforeach
               @endif

            </select>
            <span class="text-danger">@error('department_name') {{$message}} @enderror </span>
          </div>
          <div class="input_fields">
          <div class="form-group ">
            <label for="designation_name">Designation Name</label>
            <input style="margin-top: auto" name="designation_name[]" type="name" id="value_get"  class="name form-control" placeholder="Enter Department name" autocomplete="off" >
            <button style="margin-left: 92%; margin-top: -14%;" id="add_more" class="btn btn-primary btn-sm">
              {{-- <button class="btn"><i class="fa"></i></button> --}}
              <i class="fa fa-plus-circle" style="font-size:20px;"></i>
            </button>
            {{-- <button id="remove_more22" type="button" class="btn btn-danger btn-sm remove_more22">Remove</button> --}}
            <span class="text-danger">@error('designation_name') {{$message}} @enderror </span>
          </div>
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


{{-- End  --}}
{{-- Edit Deapartment --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit	Designation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="designation_edit_modal" class="form">
          <div class="form-group">
            <input name="designation_id" type="hidden" value="" class="name form-control" >

            <label for="department_name">Department Name</label>
            <select id="id_depVal"  name="department_id" class="department_id custom-select form-control-border">
              <option value="">Choose Department</option>
              @if (!empty($departmentss))
                  
              

              @foreach($departmentss as $departmentss)
                  @if($des[0]['department_id'] == $departmentss->department_id)
                      <option value="{{ $departmentss->department_id}}" selected>{{$departmentss->department_name}}</option>
                  @else
                      <option value="{{ $departmentss->department_id }}">{{$departmentss->department_name}}</option>
                  @endif
              @endforeach
              @endif
              
            </select>
            <span class="text-danger">@error('department_name') {{$message}} @enderror </span>
            {{-- <input name="department_id" type="text" value="" class="name form-control" required placeholder="Enter Department name" > --}}
            
          </div>
          <div class="form-group ">
            <label for="designation_name">Designation Name</label>
            <input name="designation_name" type="text" value="" class="name form-control input-fields" required placeholder="Enter Department name"  >
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="edit_des" class="btn btn-primary">Update</button>
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
              <h5 class="modal-title" id="DeleteModal">Delete </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
          </div>
          <div class="modal-body">
              <h4>Confirm to Delete ?</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input  name="id"  type="text" class=" form-control" id="getId" value="">
              <a href="javascript:void(0);" class="btn btn-danger " id="delete_btn">Delete</a> 
          </div>
      </div>
  </div>
</div>
{{-- End - Delete Modal --}}

@endsection
@push('js_link')
<script>

  var i ;
$(function(){
  ++i;
    var more_fields = `
    <tr>
    <td>
      <div class="form-group" style="margin-top:-18%">
        <label  for="designation_name">Designation Name</label>
            <input style="width: 228%;"  name="designation_name[]" type="name" required id="value_get" class="name form-control" placeholder="Enter Department name" >
           
            <button style="margin-left:210%; margin-top:-31%;" id="remove_input" type="button" class="btn btn-danger btn-sm remove_input"><i class="fa fa-trash-o" style="font-size:20px"></i></button>
            <span class="text-danger">@error('designation_name') {{$message}} @enderror </span>
          </div>
    </td>
               </tr> `;
               $('#add_more').click(function(e){
                e.preventDefault();
                $('.input_fields').append(more_fields);
               });
               
              $('.input_fields').on('click','.remove_input',function(e){
                e.preventDefault();
                $(this).parent().remove();
              });

              });
  // var element;
  // element = document.getElementsByClassName('value_get').getAttribute();
  // console.log(element);
// var i = 0;
// $('#add_more').click(function(){
//   ++i;
//   $('#designation_modal').append(
//     `<tr>
//       <input name="input[`+i+`][designation_name]" type="name" required class="name form-control" placeholder="Enter Department name" >
//       <a id="remove_more" class="btn btn-danger btn-sm remove_more"></a>
//       </tr>`
//   );
// });

  ////////////////////////////
   $('#designation_modal').submit(function(e){
        e.preventDefault();
        // var abc = $('#value_get').val();
        // alert(abc);
       $('#Btn1').prop('disabled',true);
          $.ajax({
          url: '{{url ('designation_insert')}}',
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
                title: 'Designation',
                body: 'Add New Designation Success.....',
                timer: 3000,
              })
                
                $("#designation_modal").modal('hide');
                
                setTimeout(() => {
                  location.reload();
                }, 3000);
              }else{
                
                $(document).Toasts('create', {
                title: 'Designation',
                body: 'Already Exits Designation.........'
              })
              $('#Btn1').prop('disabled',false);
                $('#exampleModalLong').modal('show');
              }
            }             
        });

      });
  function designation_Edit(designation_id,designation_name,department_id){
    // alert('department_Edit');
    $('input[name=designation_id]').val(designation_id);
    $('input[name=designation_name]').val(designation_name);
    $('#id_depVal').val(department_id);
    // alert(department_id);
    // $('input[name=department_id]').val(department_id);
  }

function myFunction(id) {
                        // alert(id);
                        document.getElementById('getId').value= id;
                        document.getElementById('delete_btn').href= "{{ url('/designation_Delete') }}/"+id;
                        document.getElementById("delete_btn").disabled = true;
                                // x.delete()
                                // document.write("shahzaib");
                              }      
// $('#id_depVal').change(function(){
//   var id_depChange = $('#id_depVal').find(':selected').val();
//                $.ajax({
//                    type: 'get',
//                    url: '{{ url('designationGet') }}/'+id_depChange,
//                    headers: {
//               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
//             },
//                    success: function(result) {
//                        $('#designation_id').html(result)   
//                   }
//                }); 
// });    
$('#designation_edit_modal').submit(function(e){
        e.preventDefault();
        $('#edit_des').prop('disabled',true);
          $.ajax({
          url: '{{url ('designation_Edit')}}',
          type: 'POST',
          data:  new FormData(this),
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            contentType: false,
            cache: false,
            processData: false,
            success: function(response)   {
              console.log(response);
              if(response.status == 'FALSE')
              {
                $(document).Toasts('create', {
                title: 'Designation',
                body: 'Does Not Update Designation....'
              })
                $('#edit_des').prop('disabled',false);
                $("#exampleModal").modal('show');
                ///////////////
                
              }else{
                $(document).Toasts('create', {
                title: 'Designation',
                body: 'Edit Designation Name....'
              })
              
              $("#exampleModal").modal('hide');
                location.reload();
              }
             }             
        });
      });
</script>
@endpush