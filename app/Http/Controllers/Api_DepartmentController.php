<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Employee_leave;
use App\Models\Data;
use App\Models\departments;
use App\Models\designation;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
// use Session;
use Illuminate\Support\Facades\Crypt;

class Api_DepartmentController extends Controller
{
    public function department()
    { 
        
        // if(session()->get('loginUserSession')){  //     $name = Data::where('customer_id', Session::get('loginUserSession'))->get('customer_name')->toArray();
            $department_data = departments::all()->toArray();
            $count = departments::selectraw("tbl_departments.*, (select count(*) from tbl_designations 
            where tbl_departments.department_id = tbl_designations.department_id) as
            designations_count")->get()->toArray();
            $send_data = compact('department_data','count');
        // dd($send_data);
            // return view('department',$send_data);
            return response()->json([
                'status' => 'TRUE',
                'messages' => 'Success',
                'data' => $send_data,
            ]);
        // }else{
            return response()->json([
                'status' => 'FALSE',
                'messages' => 'False Success',
            ]);
    }
    public function department_insert(Request $request)
    { 
       
        $validator = Validator::make($request->all(), [ 
            'department_name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
          }
        $database = departments::where('department_name', $request->department_name)->get(['department_name',])->toArray();
            if (empty($database)) {
            $dep_insert = new departments;
            $dep_insert->department_name = $request->input('department_name');
            $dep_insert->department_create_time = date("d-m-Y h:i:sa");
            $dep_insert->department_update_time = date("00-00-00 00:00:00");
            
            $dep_insert->save();
            return response()->json([
                    'status' => 'TRUE',
                    'messages_Edit' => 'Add Department....',
                ]);
            }else{
                return response()->json([
                    'status' => 'FALSE',
                    'messages_Edit' => 'Error Department....',
                ]);
            }
            

            
            
    
        }
    //     public function department_edit_Id(Request $request)
    // { 

    // }
    
    public function department_Edit(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'department_name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
          }
            $database = departments::where('department_name', $request->department_name)->get(['department_name',])->toArray();

            if (empty($database)) {
            $dep_edit = departments::find($request->input('department_id'));
            $dep_edit->department_name = $request->input('department_name');
            $dep_edit->department_update_time = date("d-m-Y h:i:sa");
            $dep_edit->update();
            return response()->json([
                'status' => 'TRUE',
                'messages_Edit' => 'Edit Department Name....',
            ]);
            
        }else{
            return response()->json([
                'status' => 'FALSE',
                'messages_Edit' => 'Error Edit Department ....',
            ]);
            }
    }
    public function department_Delete($id)
    {
        $Employees_delete = Data::select('customer_id', 'customer_name')->where('department_id', $id)->get()->toArray();
        // dd($Designation_delete);
        if (empty($Employees_delete)) {
            departments::find($id)->forceDelete();
            designation::select('designation_id', 'designation_name')->where('department_id', $id)->delete();

        } else {
            return redirect('department')->with('Delete','Department Does Not Delete....');
        }
        
       
       
        return redirect('department')->with('Delete_success','Department Deleted Success....');
    }

}
