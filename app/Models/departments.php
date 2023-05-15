<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class departments extends Model
{
    protected $fillable = ['department_name','department_create_time','department_update_time'];
    protected $table = 'tbl_departments';
    protected $primaryKey = 'department_id';
    public $timestamps = false;
    use HasFactory;
    
    // public function designations()
    // {
    //     return $this->hasMany(designation::class);
    // }
    
}
