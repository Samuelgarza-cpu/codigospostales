<?php

namespace App\Models\ingresos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClavesCat extends Model
{
    protected $connection = "sqlsrv_ingresos";
    protected $table = 'PREDIAL';
    public $timestamps = false;
    // protected $primaryKey = '';
}
