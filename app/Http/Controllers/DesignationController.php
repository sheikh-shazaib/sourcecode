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

class DesignationController extends Controller
{
    use ErrorLogTrait;

    public function designation(Request $request)
    { 
        try{
        if(session()->get('loginUserSession')){ $name = Data::where('customer_id', Session::get('loginUserSession'))
            ->get('customer_name')->toArray();
            $name = Data::where('customer_id', Session::get('loginUserSession'))->get(['customer_id','customer_name','customer_image'])->toArray();
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
            $send_data = compact('designation_data','database_dep_get','des','name');
        
            return view('designation',$send_data,['des'=>$des,'departmentss'=>$departmentss,'designationss'=>$designationss]);
        }
        else
        {
            return view('login');
        }
            }catch(Exception $e){
                $this->logError($e, "Designation View");
                $send_data = ['error' => $e->getMessage()];
        } finally {
            return view('designation', $send_data);
        }
        
    }
    public function designationEmp($id)
    {
        // 
        try{
        $designation = designation::select('designation_id', 'designation_name')->where('department_id', $id)->get();
        // return response()->json($designation);
        $html='<option value="">Choose Designation</option>';
        foreach($designation as $designation){
            $html.='<option value="'.$designation->designation_id.'">'.$designation->designation_name.'</option>';
        }
        return $html;
        } catch(Exception $e){
                $this->logError($e, "DesignationGet ");
        }
        
    }
    public function designation_insert(Request $request)
    { 
        try{
        // dd($request->all());
        $request->validate([
           'department_id' => 'required',
            'designation_name' => 'required',
        ]);
        
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
            
            } catch(Exception $e){
                        $this->logError($e, "Designation Insert");
            }
           
           
            
    }
    public function designation_Edit(Request $request)
    { 
       

        try{
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
            }catch(Exception $e){
                $this->logError($e, "Designation Edit");
        }
              
    }
    public function designation_Delete($id)
    {
        try{
        designation::find($id)->delete();
        

        } catch(Exception $e){
            $this->logError($e, "Dsignation Delete");
        } finally {
            return redirect('designation');
        }
        
    }
}
