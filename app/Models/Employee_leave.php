<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee_leave extends Model
{
    protected $fillable = ['leave_customer_id','annual_leave','casual_leave','sick_leave'];
    protected $table = 'employee_leave';
    protected $primaryKey = 'leave_id';
    public $timestamps = false;
    
    use HasFactory;
}
