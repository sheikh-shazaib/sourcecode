<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table_1 extends Model
{
    protected $fillable = [
        'name',
        'email',
        'table_2_id',
        'table_3_id'
    ];
    protected $table = 'tables_1';
    protected $primaryKey = 'id';
    use HasFactory;
}
