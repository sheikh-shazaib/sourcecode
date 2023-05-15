<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $fillable = [ 'customer_code','customer_image', 'customer_name', 'customer_email','department_id','designation_id','customer_country','customer_password','customer_phone','customer_status'];
    protected $table = 'sourceemployees';
    protected $primaryKey = 'customer_id';
    public $timestamps = false;
}
