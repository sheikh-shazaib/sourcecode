<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Data;
use App\Models\departments;
use App\Models\designation;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
// use Session;
use Illuminate\Support\Facades\Crypt;
use \Exception;
use App\Models\TryCatchDb;
use App\Traits\ErrorLogTrait;

class DepartmentController extends Controller
{
    use ErrorLogTrait;

    public function department()
    { 
        try{
        if(session()->get('loginUserSession')){
            
            $name = Data::where('customer_id', Session::get('loginUserSession'))->get(['customer_id','customer_name','customer_image'])->toArray();
            $department_data = departments::all()->toArray();
            $count = departments::selectraw("tbl_departments.*, (select count(*) from tbl_designations 
            where tbl_departments.department_id = tbl_designations.department_id) as
            designations_count")->get()->toArray();
            $send_data = compact('department_data','name','count');
        // dd($send_data);
            return view('department',$send_data);
        }
        else
        {
            return view('login');
        }
    }catch(Exception $e){
        $this->logError($e, "department view");
        $send_data = ['error' => $e->getMessage()];
     } finally {
        return view('department', $send_data);
    }
    }
    public function department_insert(Request $request)
    { 
        try{
        $request->validate([
            'department_name' => 'required',
        ]);
        
        $database = departments::where('department_name', $request->department_name)->get(['department_name',])->toArray();
            //  $name = 'shahzaib';
            //   echo $name;
            if (empty($database)) {
            $dep_insert = new departments;
            // $dep_insert->department_id = $request->input('department_id');
            // dd($dep_insert);
            $dep_insert->department_name = $request->input('department_name');
            $dep_insert->department_create_time = date("d-m-Y h:i:sa");
            $dep_insert->department_update_time = date("00-00-00 00:00:00");
            
            $dep_insert->save();
            
            }else{
                return response()->json([
                    'status' => 'FALSE',
                    'messages_Edit' => 'Error Department....',
                ]);
            }
            

        }catch(Exception $e){
            $this->logError($e, "department view");
         } finally {
            return redirect('department');
        }
            
    }
    public function department_Edit(Request $request)
    {
        try{
            $request->validate([
                'department_name' => 'required',
            ]);
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
        }catch(Exception $e){
            $this->logError($e, "department view");
         }
    }
    public function department_Delete($id)
    {
        try{
        $Employees_delete = Data::select('customer_id', 'customer_name')->where('department_id', $id)->get()->toArray();
        // dd($Designation_delete);
        if (empty($Employees_delete)) {
            departments::find($id)->forceDelete();
            designation::select('designation_id', 'designation_name')->where('department_id', $id)->delete();

        } else {
            return redirect('department')->with('Delete','Department Does Not Delete....');
        }
        
       
       
        return redirect('department')->with('Delete_success','Department Deleted Success....');
    }catch(Exception $e){
        $this->logError($e, "department view");
     }
     
    }

}
