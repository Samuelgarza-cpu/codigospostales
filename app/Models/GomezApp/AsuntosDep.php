<?php

namespace App\Models\GomezApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsuntosDep extends Model
{
    protected $connection = 'mysql_gomezapp';
    protected $table = 'gomezapp.asuntos_dep';
}
