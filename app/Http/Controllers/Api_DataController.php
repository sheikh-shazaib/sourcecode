<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Employee_leave;
use App\Models\Api_Login_Employee;
use App\Models\Data;
use Illuminate\Support\Str; 
use App\Models\departments;
use App\Models\designation;
use \Exception;
use App\Traits\ErrorLogTrait;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
// use Session;
use Illuminate\Support\Facades\Crypt;

class Api_DataController extends Controller
{
    use ErrorLogTrait;

    public function indexIogin()
    {
         
        return response()->json([
            'status' => 'TRUE',
            'messages' => 'LOGIN PAGE',
        ]);
        
    }
    
    public function login(Request $request)
    {       
        $validator = Validator::make($request->all(), [ 
                    'customer_email' => 'required',
                    'customer_password' => 'required',
                ]);
                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                  }
               
                $login = Data::where('customer_email', $request->customer_email)->Where('customer_password', $request->customer_password)->get(['customer_id','customer_name','customer_email', 'customer_password'])->toArray();
                    if(!empty($login)){
                        $token = Str::random(20);
                        $token_value = date("hismd").$token;
                        // dd($token_value);
                             $add_login = new Api_Login_Employee;
                             $add_login ->customer_id = $login[0]['customer_id'];
                             $add_login ->token_id = $token_value;
                             $add_login->employee_login_time = date("d-m-Y h:i:s a");
                             $result = $add_login->save();
                             if($result)
                             {
                                 return ["result" => "Add Login Details",'Token_Id' => $token_value];
                             }else
                             {
                                 return ["result" => "Doest Not Add Login Details"];
                             }
                        //  return redirect('dashboard')->with('success','Login success');

                       
                        //  return response()->json(
                        //     [
                        //     'status' => 'TRUE',
                        //     'messages' => 'Login success',
                        //     'Id' => $result[0]['token_id']
                        //     // $request->customer_id,
                        //     // $request->customer_id, 
                        // ]);
                         //dd($login);
                    }  
                                  
                    else{
                        return response()->json([
                            'status' => 'FALSE',
                            'messages' => 'You Have Entered Wrong Credentials',
                        ]);
                        // return back()->with('fail','You Have Entered Wrong Credentials');
                        
                    }
    }
    public function dashboard()
    {
        // if(session()->get('loginUserSession')){
            
            // $name = Data::where('customer_id', Session::get('loginUserSession'))->get('customer_name')->toArray();
            $count_Employee = Data::count();
            $count_Department = departments::count();
            $count_Designation = designation::count();
            // Session::put('loginUserSession', $name['customer_id']);
            // dd($name);
            // $request->session()->put('myName','sady');
            // $login_name_send = compact(Data::where('customer_name', $request->customer_id)->get()->toArray());
            //   dd($name);
            $send_name = compact('count_Employee','count_Department','count_Designation');
            return response()->json([
                'status' => 'TRUE',
                'messages' => 'SUCCESS',
                'data' => $send_name,
            ]);
        // }
        // else
        // {
            return response()->json([
                'status' => 'FALSE',
                'messages' => 'False Success',
            ]);
            // return view('login');
        // }
         
    }
    public function index()
    {
      //  dd(session()->get('loginUserSession'));
        //  if(session()->get('loginUserSession')){
        //     $name = Data::where('customer_id', Session::get('loginUserSession'))->get('customer_name')->toArray();

            $data = Data::join('tbl_departments', 'sourceemployees.department_id', '=', 'tbl_departments.department_id')
            ->join('tbl_designations', 'tbl_designations.designation_id', '=', 'sourceemployees.designation_id')
            ->leftJoin('employee_leave', 'sourceemployees.customer_id', '=', 'employee_leave.leave_customer_id')
            ->get()->toArray();
            // dd(($data));
            $dep = departments::select('department_id', 'department_name')->get()->toArray();
            $des = designation::get()->toArray();
            // $send_leave = Employee_leave::get()->toArray();
            
            // dd($dep);
            // $send_name = compact('name');
            $send_data = compact('dep','data','des');
            // return view('view_employee', $send_data);
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
            // return view('login');
        // }
        
    }
   
    public function insert(Request $request)
    {
        try{
        // dd($request->all());
    $validator = Validator::make($request->all(), [ 
        'customer_name' => 'required',
        'customer_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'customer_email' => 'required',
        'customer_country' => 'required',
        'department_id' => 'required',
        'designation_id' => 'required',
        'customer_password' => 'required',
        'customer_phone' => 'required',
        'customer_status' => 'required',
        'annual_leave' => 'required',
        'casual_leave' => 'required',
        'sick_leave' => 'required',

    ]);
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
      }
        $database_email_phone = Data::where('customer_email', $request->email)->orWhere('customer_phone', $request->phone)->get(['customer_email', 'customer_phone'])->toArray();
        // .. dd($abc);
        // dd($abc[0]['customer_email']);
        if (empty($database_email_phone)) {
            $data = new Data;
            
            $data->customer_code = $request->input('customer_code');
            $data->customer_name = $request->input('customer_name');

            if($request->hasFile('customer_image'))
            {
                
                $file = $request->file('customer_image');
                $extension = $file->getClientOriginalName();
                $request->file('customer_image')->storeAs('dist/profile_image/',$extension);
                $data->customer_image = $extension;   
                
            }

            $data->customer_email = $request->input('customer_email');
            $data->customer_country = $request->customer_country;
            $data->department_id = $request->department_id;
            $data->designation_id = $request->designation_id;
            $data->customer_password = $request->input('customer_password');
            $data->customer_phone = $request->input('customer_phone');
            $data->customer_status = $request->customer_status;
            $data->save();

            // customer_code 00001 add
            $code_get = $data->customer_id;
            $data->customer_code = sprintf('%05d', $code_get);
            $data->save();

            $add_leave = new Employee_leave;
            $add_leave->leave_customer_id = $data->customer_id;
            $add_leave->annual_leave = $request->input('annual_leave');
            $add_leave->casual_leave = $request->input('casual_leave');
            $add_leave->sick_leave = $request->input('sick_leave');
            $add_leave->save();

            return response()->json([
                'status' => 'TRUE',
                'messages' => 'ADD Employee Success....',
            ]);
            
        } else {
            return response()->json([
                'status' => 'FALSE',
                'messages' => 'error....',
            ]);
            //dd($abc[0]['customer_email'].''.$abc[0]['customer_phone']);

        }}catch(Exception $e){
            $this->logError($e, "Employee Insert");
        
        }
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
    public function designationChange($id)
    {
        // department_Edit_id
        // if(session()->get('loginUserSession')){
            
        //     $name = Data::where('customer_id', Session::get('loginUserSession'))->get('customer_name')->toArray();
        // ------------------ 
        $data = Data::where('customer_id',$id)->get()->toArray();
        $departmentss = departments::all();
        $designationss = designation::where('department_id',$data[0]['department_id'])->get();
        $edit_leave = Employee_leave::where('leave_customer_id',$id)->get()->toArray();
        // dd($edit_leave);
        // $send_data = compact('name');
        // return view('edit_employee',$send_data,['designationss'=>$designationss,'edit_leave'=>$edit_leave]);
        return response()->json([
            'status' => 'FALSE',
            'messages' => 'False Success',
            // 'senddata =' => $send_data,
            'data'=> $data,
            'departmentss'=> $departmentss,
            'designationss'=>$designationss,
            'edit_leave'=>$edit_leave,

        ]);
        return response()->json([
            'status' => 'FALSE',
            'messages' => 'False Success',
        ]);
        // }else{
            
        //     // return view('login');
        // }
    }
    
    public function update(Request $request)
    {
        


        // dd($request->all());
        $abcd = Data::where(function ($query) use ($request) {
            $query->where('customer_email', $request->email)
                ->orWhere('customer_phone', $request->phoneNumber);
        })->where('customer_id', '!=', $request->id)->get('customer_email', 'customer_phone')->toArray();

           // dd($abcd[0]['customer_phone']);
        //    dd($abcd);
        
        if (empty($abcd)) {
            $data = Data::find($request->input('id'));
            if($request->hasFile('customer_image'))
            {
                $destination = 'dist/profile_image/'.$data->customer_image;
                if(File::exits($destination)){
                    File::delete($destination);
                }
                $file = $request->file('customer_image');
                $extension = $file->getClientOriginalName();
                $request->file('customer_image')->storeAs('dist/profile_image/',$extension);
                $data->customer_image = $extension;   
                
            }
            // dd($data);
            $data->customer_name = $request->input('customer_name');
            $data->customer_email = $request->input('customer_email');
            $data->department_id = $request->department_id;
            $data->designation_id = $request->designation_id;
            $data->customer_country = $request->customer_country;
            $data->customer_password = $request->input('customer_password');
            $data->customer_phone = $request->input('customer_phone');
            $data->customer_status = $request->customer_status;
            $data->save();
            // dd($abcd[0]['customer_phone']);
            $edit_leave = Employee_leave::find($request->input('idLeave'));
            // dd($edit_leave);
            $edit_leave->annual_leave = $request->input('annual_leave');
            $edit_leave->casual_leave = $request->input('casual_leave');
            $edit_leave->sick_leave = $request->input('sick_leave');
            $edit_leave->save();
            // dd($edit_leave[0]['annual_leave']);
            //  dd($edit_leave);
            // return redirect('view_employee');
            return response()->json([
                'status' => 'TRUE',
                'messages_Edit' => 'Update Employee Success....',
            ]);
            
            
        } else {
            // dd($abcd[0]['customer_email']);
            return response()->json([
                'status' => 'FALSE',
                'messages_Edit' => 'Error Employee....',
            ]);
            //dd($abc[0]['customer_email'].''.$abc[0]['customer_phone']);

        }
    }

    // public function destroy($id)
    // {
    //     $leave_delete = Employee_leave::where('leave_customer_id', $id)->get('leave_id')->toArray();
    //     $process = Data::find($id)->delete();
    //     if ($process == 1) {
    //         Employee_leave::find($leave_delete[0]['leave_id'])->delete();
    //         return response()->json([
    //             'status' => 'TRUE',
    //             'messages' => 'Success',
    //         ]);
    //     } else {
    //         return response()->json([
    //             'status' => 'FALSE',
    //             'messages' => 'False Success',
    //         ]);
    //     }
    // }
    public function logout(Request $request)
    {
       
        $api_employee = Api_Login_Employee::where('token_id', $request->token_id)->first();
        if ($api_employee) {
            $api_employee->api_status = $request->api_status;
            $api_employee->save();
        }

        // Api_Login_Employee::find($logout_api_employee[0]['token_id']);
        // $logout_api_employee = Api_Login_Employee::where('api_login_employee_id')->get('token_id')->toArray();
        // dd($logout_api_employee[0]['token_id']);
        // if ($logout_api_employee == 1) {
           
        // } else {
           
            return response()->json([
                'status' => 'TRUE',
                'messages' => 'Success',
            ]);
            
            return response()->json([
                'status' => 'FALSE',
                'messages' => 'Logout Error',
            ]);
            
        
        // return redirect('login');
        ;
    }

    public function leave()
    {
        if(session()->get('loginUserSession')){
            $name = Data::where('customer_id', Session::get('loginUserSession'))->get('customer_name')->toArray();

            // $employee_leave = Employee_leave::all();
            
            $employee_leave = Data::Join('employee_leave', 'employee_leave.leave_customer_id', '=', 'sourceemployees.customer_id')->get()->toArray();
            // dd($leave_name);
            $send_data = compact('employee_leave','name');

            // return view('employee_leave_request',$send_data);
            return response()->json([
                'status' => 'TRUE',
                'messages' => 'Success',
                'senddata' => $send_data,
            ]);
        }else{
            return response()->json([
                'status' => 'FALSE',
                'messages' => 'False Success',
                
            ]);
            //  return view('login');
        }
    }

   

}
