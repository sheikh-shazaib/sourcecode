<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
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
use \Exception;
use App\Models\TryCatchDb;
use App\Traits\ErrorLogTrait;
class FileController extends Controller
{
    // public function file_view(){
    //     return view('view_employee',['customer_image'=> Data::get()]);
    // }
    use ErrorLogTrait;
    
    public function File(Request $request,$id)
    {
        try{
        $path = storage_path($request->path);  
        $image_get = Data::where('customer_id',$id)->get(['customer_image'])->toArray();
        $image_get[0]['customer_image'];
        $path = storage_path('app/dist/profile_image/'.$image_get[0]['customer_image']);  


        // dd($new);
            if (!File::exists($path)) {
              
                return view('errors.404');
            }else{
                
                $file = File::get($path);
                $type = File::mimeType($path);
                $response = response()->make($file, 200);
                $response->header("Content-Type", $type);
                return $response;
            }
        }catch(Exception $e){
            $this->logError($e, "File");
         }
    }
}
