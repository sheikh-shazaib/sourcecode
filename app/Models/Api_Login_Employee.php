<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Api_Login_Employee extends Model
{
    protected $table = 'api_login_employees';
    protected $primaryKey = 'api_login_employee_id';
    public $timestamps = false;
    use HasFactory;}
