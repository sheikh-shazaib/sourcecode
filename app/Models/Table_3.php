<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table_3 extends Model
{
    protected $fillable = [
        'name',
        'email'
    ];
    protected $table = 'tables_3';
    protected $primaryKey = 'table_3_id';
    use HasFactory;
}
