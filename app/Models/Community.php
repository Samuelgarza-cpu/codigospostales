<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $connection = "mysql_communities";
    protected $table = 'communities';
    public $timestamps = false;
}
