<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table_2 extends Model
{
    protected $fillable = [
        'password',
        'status'
    ];
    protected $table = 'tables_2';
    protected $primaryKey = 'table_2_id';
    use HasFactory;
}
