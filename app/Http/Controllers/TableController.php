<?php

namespace App\Http\Controllers;
use App\Models\Table_1;
use App\Models\Table_2;
use App\Models\Table_3;
use \Exception;
use DB;
use App\Traits\ErrorLogTrait;
use Illuminate\Http\Request;

class TableController extends Controller
{
    use ErrorLogTrait;

    public function table(){

        $table_view = Table_1::Join('tables_2', 'tables_2.id' ,'=', 'tables_1.id' )
        ->Join('tables_3', 'tables_3.id', '=', 'tables_1.id')->get()->toArray();

        
        
        // dd($table_view);

        $send_data = compact('table_view');
        // dd($send_data);
        return view('table',$send_data);
    }

    public function table_insert(Request $request){
        try{
            DB::commit();
            $table_1_insert = new Table_1;
            // dd($table_1_insert);
            $table_1_insert->name = $request->input('name');
            $table_1_insert->email = $request->input('email');

            // dd($table_1_insert);
            $table_1_insert->save();
            
            // $table_1_insert->table_2_id = $request->Table_1;
            // $table_1_insert->table_3_id = $request->Table_1;
            // $table_1_insert->save();

            $table_2_insert = new Table_2;

            $table_2_insert->id = $table_1_insert->id;
            
            $table_2_insert->password = $request->input('password');
            $table_2_insert->age = $request->input('age');
            $table_2_insert->status = $request->status;
            $table_2_insert->save();

            $table_3_insert = new Table_3;

            $table_3_insert->id = $table_1_insert->id;
            $table_3_insert->phone_number = $request->input('phone_number');
            $table_3_insert->adress = $request->input('adress');
            $table_3_insert->save();

            DB::commit();
            return redirect('table');

        }catch(Exception $e){
            DB::rollback();
            $this->logError($e, "Employee Insert");
        } finally {
            $table_view = Table_1::join('tables_2', 'tables_2.id' ,'=', 'tables_1.id' )
        ->join('tables_3', 'tables_3.id', '=', 'tables_1.id')->get()->toArray();

        
        
        // dd($table_view);

        $send_data = compact('table_view');
        // dd($send_data);
        return view('table',$send_data);
            // return view('table');
        }
    }
}
