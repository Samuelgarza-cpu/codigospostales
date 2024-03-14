<?php

namespace App\Models\PagoEnLinea;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impuestos extends Model
{
    use HasFactory;
    protected $connection = "sql_pagos_en_linea";
    protected $table = 'IMPUESTOS';
    public $timestamps = false;
}
