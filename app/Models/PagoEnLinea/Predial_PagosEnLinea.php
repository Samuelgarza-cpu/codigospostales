<?php

namespace App\Models\PagoEnLinea;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Predial_PagosEnLinea extends Model
{
    use HasFactory;
    protected $connection = "sql_pagos_en_linea";
    protected $table = 'predial_pagosenlinea';
    public $timestamps = false;
}
