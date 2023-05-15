<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Employee_leave;
use App\Models\Data;
use App\Models\Api_Login_Employee;
use App\Models\departments;
use App\Models\designation;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
// use Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str; 

class Api_Login_EmployeeController extends Controller
{
    public function login_api_employee()
    {
       
            return Api_Login_Employee::all();
    }
    public function add_login_api_employee(Request $request)
    {
        $token = Str::random(20);
       $token_value = date("hismd").$token;
    //    dd($token_value);
            $add_login = new Api_Login_Employee;
            $add_login ->customer_id =$request->customer_id;
            $add_login ->token_id == $token_value;
            $add_login->employee_login_time = date("d-m-Y h:i:s a");
            $result = $add_login->save();
            if($result)
            {
                return ["result" => "Add Login Details"];
            }else
            {
                return ["result" => "Doest Not Add Login Details"];
            }
    }
}
