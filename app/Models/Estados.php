<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
   protected $connection = "mysql_communities";
   protected $table = "estados";
   // protected $connection = "mysql_becas";
   // protected $table = "db_becas.estados";
}
