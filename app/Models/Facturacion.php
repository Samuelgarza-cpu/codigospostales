<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturacion extends Model
{
    use HasFactory;
    protected $connection = "sqlsrv_ingresos";
    protected $table = 'vwPagosFacElectronica';
    public $timestamps = false;
}
