<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perimeter extends Model
{
   protected $connection = "mysql_communities";
   protected $table = "perimeters";
   public $timestamps = false;
   // protected $connection = "mysql_becas";
   // protected $table = "db_becas.estados";
}
