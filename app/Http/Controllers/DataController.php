<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Employee_leave;
use DB;
use \Exception;
use App\Models\TryCatchDb;
// use Barryvdh\DomPDF\PDF;
use Dompdf\Dompdf;
use App\Models\Data;
use App\Models\departments;
use App\Models\designation;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Rap2hpoutre\FastExcel\FastExcel;
use App\User;
use App\Traits\ErrorLogTrait;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
// use \Barryvdh\DomPDF\PDF;
use PDF;
// use Session;
use Illuminate\Support\Facades\Crypt;
class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use ErrorLogTrait;

    
    // public function import_data_excel()
    // {
    //     $collection = (new FastExcel)->import('file.xlsx');
    //     $collection = (new FastExcel)->configureCsv(';', '#', 'gbk')->import('file.csv');
    //     $users = (new FastExcel)->import('file.xlsx', function ($line) {
    //         return Data::create([
    //             'name' => $line['Name'],
    //             'email' => $line['Email']
    //         ]);
    //     });
    // }

    public function indexIogin()
    {
         try{
         return view('login');

         }catch(Exception $e){
            $this->logError($e, "login");
         }
         
    }
    
    public function login(Request $request)
    {       try{
        $request->validate([
                    'customer_code' => 'required',
                    'customer_password' => 'required',
                ]);
                $login = Data::where('customer_code', $request->customer_code)->Where('customer_password', $request->customer_password)->get(['customer_id','customer_code','customer_name','customer_email', 'customer_password'])->toArray();
                // $a=array('customer_id'=>"customer_id");
                    
                    if(!empty($login)){
                        $request->session()->put('loginUserSession',$login[0]['customer_id'],$login[0]['customer_name']);
                        //   dd($login);
                        // $titles = $login->pluck( 'customer_name' );
                        // dd($login);
                         return redirect('dashboard')->with('success','Login success');
                         //dd($login);
                    }  
                                  
                    else{
                        return back()->with('fail','You Have Entered Wrong Credentials');
                        
                    }
                }catch(Exception $e){
                            $this->logError($e, "login Form");
                }
    }
    public function dashboard()
    {
        try{
        if(session()->get('loginUserSession')){
            
            $name = Data::where('customer_id', Session::get('loginUserSession'))->get(['customer_id','customer_name','customer_image'])->toArray();
            // dd($name);
            $count_Employee = Data::count();
            $count_Department = departments::count();
            $count_Designation = designation::count();

            $send_data = compact('name','count_Employee','count_Department','count_Designation');
            // return view('dashboard',$send_name);
            
        }
        else{
            return view('login');
        }
    }catch(Exception $e){
        $this->logError($e, "Dashboard");
        $send_data = ['error' => $e->getMessage()];
    } finally {
        return view('dashboard', $send_data);
    }
       
         
    }
    public function index(Request $request)
    {
      //  dd(session()->get('loginUserSession'));
      try{
         if(session()->get('loginUserSession')){
            $name = Data::where('customer_id', Session::get('loginUserSession'))->get(['customer_id','customer_name','customer_image'])->toArray();

            $data = Data::join('tbl_departments', 'sourceemployees.department_id', '=', 'tbl_departments.department_id')
            ->join('tbl_designations', 'tbl_designations.designation_id', '=', 'sourceemployees.designation_id')
            ->leftJoin('employee_leave', 'sourceemployees.customer_id', '=', 'employee_leave.leave_customer_id')
            ->orderBy('customer_id', 'asc')
            ->get()
            ->toArray();
            // dd(($data));
            // dd($data[0]['customer_code']);
            $dep = departments::select('department_id', 'department_name')->get()->toArray();
            $des = designation::get()->toArray();
            // $send_leave = Employee_leave::get()->toArray();
            $send_data = compact('dep','data','name','des');
            // return view('view_employee', $send_data);
            
        }
        else{
            return view('login');
        }
    } catch(Exception $e) {
        $this->logError($e, "View Employee");
        $send_data = ['error' => $e->getMessage()];
        // return view('view_employee', $send_data);

    } finally {

        return view('view_employee', $send_data);
    }
        
        
    }
   
    public function insert(Request $request)
    {
        try{
        // dd($request->all());
    //     $request->validator(
    //         [
    //         'annual_leave' => 'required|min:1|max:50',
    //         'casual_leave' => 'required|min:4|max:50',
    //         'sick_leave' => 'required|min:4|max:50',
    //     ]
    // );
    // $validator = Validator::make($request->all(), [ 
    //     'customer_name' => 'required',
    //     'customer_email' => 'required',
    //     'customer_country' => 'required',
    //     'department_id' => 'required',
    //     'designation_id' => 'required',
    //     'customer_password' => 'required',
    //     'customer_phone' => 'required',
    //     'customer_status' => 'required',
    //     'annual_leave' => 'required',
    //     'casual_leave' => 'required',
    //     'sick_leave' => 'required',

    // ]);
    // if ($validator->fails()) {
    //     return response()->json($validator->errors(), 422);
    //   }
        $database_email_phone = Data::where('customer_email', $request->email)->orWhere('customer_phone', $request->phone)->get(['customer_email', 'customer_phone'])->toArray();
        // .. dd($abc);
        // dd($abc[0]['customer_email']);
        if (empty($database_email_phone)) {
            $data = new Data;

            $data->customer_name = $request->input('name');

            if($request->hasFile('customer_image'))
            {
                $file = $request->file('customer_image');
                $extension = $file->getClientOriginalName();
                $request->file('customer_image')->move('dist/profile_image/',$extension);
                $data->customer_image = $extension; 
            }
            
            $data->customer_email = $request->input('email');
            $data->customer_country = $request->country;
            $data->department_id = $request->department_id;
            $data->designation_id = $request->designation_id;
            $data->customer_password = $request->input('password');
            $data->customer_phone = $request->input('phone');
            
            $data->customer_status = $request->drone;
            $data->save();

            // customer_code 00001 add
            $code_get = $data->customer_id;
            $data->customer_code = sprintf('%05d', $code_get);
            $data->save();
            // dd($data->customer_id);
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

        }
    }catch(Exception $e){
        $this->logError($e, "Employee Insert");
    }
    }
    public function designationEmp($id)
    {
        try{
        // 
        $designation = designation::select('designation_id', 'designation_name')->where('department_id', $id)->get();
        // return response()->json($designation);
        $html='<option value="">Choose Designation</option>';
        foreach($designation as $designation){
            $html.='<option value="'.$designation->designation_id.'">'.$designation->designation_name.'</option>';
        }
        return $html;
    }catch(Exception $e){
        $this->logError($e, "DesignationGet");
    }
        
    }
    public function designationChange($id)
    {
        try{
        // department_Edit_id
        if(session()->get('loginUserSession')){
            
        $name = Data::where('customer_id', Session::get('loginUserSession'))->get(['customer_id','customer_name','customer_image'])->toArray();
        // ------------------ 
        $data = Data::where('customer_id',$id)->get()->toArray();
        
        $departmentss = departments::all();
        $designationss = designation::where('department_id',$data[0]['department_id'])->get();
        $edit_leave = Employee_leave::where('leave_customer_id',$id)->get()->toArray();
        // dd($edit_leave);
        // dd($data[0]['customer_image']);
        $send_data = compact('name','data','departmentss','designationss','edit_leave');
        // return view('edit_employee',$send_data);
        

        }else{
            return view('login');
        }
    }catch(Exception $e){
        $this->logError($e, "Get Employee");
        $send_data = ['error' => $e->getMessage()];
    } finally {
        return view('edit_employee', $send_data);
    }
    }
    
    public function update(Request $request)
    {
        try{
        $validator = Validator::make($request->all(), [ 
            'customer_name' => 'required',
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
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        //   }
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
                $destination = storage_path('dist/profile_image/'.$data->customer_image);
                if(file_exists($destination)){
                    File::delete($destination);
                }
                $file = $request->file('customer_image');
                // dd($file);
                $extension = $file->getClientOriginalName();
                // dd($extension);
                $request->file('customer_image')->storeAs('dist/profile_image/',$extension);
                $data->customer_image = $extension; 
            }
            $data->customer_name = $request->input('name');
            $data->customer_email = $request->input('email');
            $data->department_id = $request->department_id;
            $data->designation_id = $request->designation_id;
            $data->customer_country = $request->country;
            $data->customer_password = $request->input('password1');
            $data->customer_phone = $request->input('phoneNumber');
            $data->customer_status = $request->status;
            $data->save();
            // dd($abcd[0]['customer_phone']);
            $edit_leave = Employee_leave::find($request->input('idLeave'));
            $edit_leave->annual_leave = $request->input('annual_leave');
            $edit_leave->casual_leave = $request->input('casual_leave');
            $edit_leave->sick_leave = $request->input('sick_leave');
            $edit_leave->save();
            // dd($edit_leave[0]['annual_leave']);
            //  dd($edit_leave);
            
            return redirect('view_employee');
           
            
            
        } else {
            // dd($abcd[0]['customer_email']);
            return response()->json([
                'status' => 'TRUE',
                'messages_Edit' => 'Edit Employee Success....',
            ]);
            //dd($abc[0]['customer_email'].''.$abc[0]['customer_phone']);

        }
    }catch(Exception $e){
        $this->logError($e, "Employee update");
    }
    }

    public function destroy($id)
    {
        try{
        $leave_delete = Employee_leave::where('leave_customer_id', $id)->get('leave_id')->toArray();
        $process = Data::find($id)->forceDelete();
        if ($process == 1) {
            Employee_leave::find($leave_delete[0]['leave_id'])->delete();
        } 
        }catch(Exception $e){
            $this->logError($e, "Delete");  
        }finally{
            return redirect('view_employee');
        }
    }
    
    public function logout(Request $request)
    {
        try{
        $request->session()->flush();

        // return redirect('login');
    }catch(Exception $e){
        $this->logError($e, "logout");
    } finally {
        return redirect('login');
    }
    }
    public function leave()
    {
        try{
        if(session()->get('loginUserSession')){
            $name = Data::where('customer_id', Session::get('loginUserSession'))->get(['customer_id','customer_name','customer_image'])->toArray();

            // $employee_leave = Employee_leave::all();
            
            $employee_leave = Data::Join('employee_leave', 'employee_leave.leave_customer_id', '=', 'sourceemployees.customer_id')->get()->toArray();
            // dd($leave_name);
            $send_data = compact('employee_leave','name');

            // return view('employee_leave_request',$send_data);
        }else{
             return view('login');
        }
    }catch(Exception $e){
        $this->logError($e, "leave");
        $send_data = ['error' => $e->getMessage()];
    } finally {
        return view('employee_leave_request', $send_data);
    }
    }

   
   
}
