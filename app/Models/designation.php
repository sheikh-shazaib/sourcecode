<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class designation extends Model
{
    protected $fillable = ['designation_name','department_id','designation_create_time','designation_update_time'];
    protected $table = 'tbl_designations';
    protected $primaryKey = 'designation_id';
    public $timestamps = false;
    use HasFactory;
}
