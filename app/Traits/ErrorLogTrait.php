<?php

namespace App\Traits;

use App\Models\TryCatchDb;

trait ErrorLogTrait{
    public function logError($e, $page_name){
        $error_get = new TryCatchDb;
        $error_get->customer_id = session()->get('loginUserSession');
        $error_get->page_name = $page_name;
        $error_get->error_get_message = $e->getMessage();
        $error_get->error_get_file = $e->getFile();
        $error_get->error_get_line = $e->getLine();
        $error_get->error_get_code = $e->getCode();
        $error_get->error_get_time = date("d-m-Y h:i:s a");
        $error_get->save();
    }
}
