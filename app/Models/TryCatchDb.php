<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TryCatchDb extends Model
{
    protected $fillable = ['error_get_id', 'customer_id', 'error_get_message','error_get_file','error_get_line','error_get_code','error_get_time'];
    protected $table = 'try_catch_db';
    protected $primaryKey = 'error_get_id';
    public $timestamps = false;
    use HasFactory;
}
