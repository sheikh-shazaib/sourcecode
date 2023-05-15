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

class Api_DesignationController extends Controller
{
    public function designation(Request $request)
    { 
        // if(session()->get('loginUserSession')){ $name = Data::where('customer_id', Session::get('loginUserSession'))
        //     ->get('customer_name')->toArray();
        //     $name = Data::where('customer_id', Session::get('loginUserSession'))->get('customer_name')->toArray();
        // $designation_data = designation::all();
         $designation_data = designation::join('tbl_departments', 'tbl_designations.department_id', '=', 'tbl_departments.department_id')->get()->toArray();
        //  dd($designation_datas);
        $database_dep_get = departments::all()->toArray();
        $des = departments::select('department_id', 'department_name')->get()->toArray();
        // dd($des);

        // $data = Data::where('customer_id',$id)->get()->toArray();
        $departmentss = departments::all();
        $designationss = designation::where('department_id',$des[0]['department_id'])->get();
        ///////////////
            $send_data = compact('designation_data','database_dep_get','des');
        
            // return view('designation',$send_data,['des'=>$des,]);
            return response()->json([
                'status' => 'TRUE',
                'messages' => 'Success',
                'data' => $send_data,
                'des'=>$des,
                'departmentss'=>$departmentss,
                'designationss'=>$designationss
            ]);
            return response()->json([
                'status' => 'FALSE',
                'messages' => 'False Success',
            ]);
        // }
        // else
        // {
        //     return view('login');
        // }
        
    }
    public function designationEmp($id)
    {
        // 
        $designation = designation::select('designation_id', 'designation_name')->where('department_id', $id)->get();
        // return response()->json($designation);
        $html='<option value="">Choose Designation</option>';
        foreach($designation as $designation){
            $html.='<option value="'.$designation->designation_id.'">'.$designation->designation_name.'</option>';
        }
        return $html;
        
    }
    public function designation_insert(Request $request)
    { 
        // dd($request->all());
       
        $validator = Validator::make($request->all(), [ 
            'department_id' => 'required',
            'designation_name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
          }
        foreach($request->designation_name as $designation_name_insert) {
            $database_designation_name = designation::where('designation_name', $designation_name_insert)->where('department_id', $request->department_id)->get(['designation_name','department_id'])->toArray();
            // dd($database_designation_name);
            if (!empty($database_designation_name)) {
                return response()->json([
                    'status' => 'FALSE',
                    'messages_Edit' => 'Error Department....',
                ]);   
            }   
        }
            foreach($request->designation_name as $designation_name_insert) {
                $database_designation_name = designation::where('designation_name', $designation_name_insert)->where('department_id', $request->department_id)->get(['designation_name','department_id'])->toArray();
                if (empty($database_designation_name)) {
                $des_insert = new designation();
                // $des_insert = designation::all();
                $des_insert->department_id = $request->department_id;

                $des_insert->designation_name = $designation_name_insert;

                $des_insert->designation_create_time = date("d-m-Y h:i:sa");
                $des_insert->designation_update_time = date("00-00-00 00:00:00");
                $des_insert->save();
                 }
                    
            
            }
            return response()->json([
                'status' => 'TRUE',
                'messages_Edit' => 'Add New Designation Success.....',
            ]);
            
            
           
           
            
    }
    public function designation_Edit(Request $request)
    { 
       

           // dd($abcd[0]['customer_phone']);

           $database_designation_name = designation::where('designation_name', $request->designation_name)->where('department_id', $request->department_id)->get(['designation_name'])->toArray();
        //    dd($database_designation_name);
               if (empty($database_designation_name)) {
            $designation_Edit = designation::find($request->input('designation_id'));
            $designation_Edit->department_id = $request->department_id;
            $designation_Edit->designation_name = $request->designation_name;
            $designation_Edit->designation_update_time = date("d-m-Y h:i:sa");
            $designation_Edit->update();
            return response()->json([
                'status' => 'TRUE',
                'messages_Edit' => 'Edit Designation Name....',
            ]);

        }else{
            //  dd($designation_Edit);
            // return redirect('designation');
           
       
            return response()->json([
                'status' => 'FALSE',
                'messages_Edit' => 'Does Not Update Designation....',
            ]);
        }
            
              
    }
    public function designation_Delete($id)
    {
        designation::find($id)->delete();
        return redirect('designation');

        return response()->json([
            'status' => 'TRUE',
            'messages_Edit' => 'Delete Designation Success....',
        ]);
        // designation::find($id)->delete();
        // return redirect('designation');
        return response()->json([
            'status' => 'FALSE',
            'messages_Edit' => 'Does Not Delete Designation....',
        ]);
    }
}
