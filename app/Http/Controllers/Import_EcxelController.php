<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Employee_leave;
use DB;
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
use Excel;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
// use \Barryvdh\DomPDF\PDF;
use PDF;
// use Session;
use Phppot\DataSource;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Illuminate\Support\Facades\Crypt;
use \Exception;
use App\Models\TryCatchDb;
use App\Traits\ErrorLogTrait;

class Import_EcxelController extends Controller
{
    use ErrorLogTrait;

    public function ecxel_import(Request $request){
       
    //new
    try{
        $validatedData = $request->validate([
            'file'=> 'required|mimes:xlsx, csv, xls'
        ]);
    $file = $request->file('import_data');
    // dd($file);
    if ($file) {
        $filePath = $file->getRealPath();
        $data = (new FastExcel)->import($filePath);

        foreach ($data as $line) {
            //check Email and Phone number 
            $database_email_phone = Data::where('customer_email', $line['customer_email'])->orWhere('customer_phone', $line['customer_phone'])->get(['customer_email', 'customer_phone'])->toArray();

            if (empty($database_email_phone)) {
                $newData = new Data;
                $newData->customer_image = $line['customer_image'];
                $newData->customer_name = $line['customer_name'];
                $newData->customer_email = $line['customer_email'];
                $newData->customer_country = $line['customer_country'];
                $newData->department_id = $line['department_id'];
                $newData->designation_id = $line['designation_id'];
                $newData->customer_password = $line['customer_password'];
                $newData->customer_phone = $line['customer_phone'];
                $newData->customer_status = $line['customer_status'];
                $newData->save();

                $add_leave = new Employee_leave;
                $add_leave->leave_customer_id = $newData->customer_id;
                $add_leave->annual_leave = $line['annual_leave'];
                $add_leave->casual_leave = $line['casual_leave'];
                $add_leave->sick_leave = $line['sick_leave'];
                $add_leave->save();

                return response()->json([
                    'status' => 'TRUE',
                    'messages' => 'Success....',
                ]);
            } else {
                return response()->json([
                    'status' => 'FALSE',
                    'messages' => 'error....',
                ]);
            }
        }
    } else {
        return response()->json([
            'status' => 'FALSE',
            'messages' => 'No file uploaded....',
        ]);
    }
        }catch(Exception $e){
            $this->logError($e, "Ecxel Import");
            
        }finally{
            response()->json([
                'status' => 'Check',
                'messages' => 'Check Error....',
            ]);
        }
 }
}

