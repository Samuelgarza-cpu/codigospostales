<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodigoPostal extends Model
{
    protected $connection = "mysql_communities";
    protected $table = 'vista_cp';
    public $timestamps = false;
    // protected $connection = "mysql_becas";
    // protected $table = 'db_becas.vista_cp';
}
