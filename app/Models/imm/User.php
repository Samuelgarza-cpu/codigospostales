<?php

namespace App\Models\imm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable{
    use HasApiTokens, HasFactory;
   
    /**
     * Especificar la conexion si no es la por default
     * @var string
     */
    protected $connection = "mysql_imm";
    protected $guard = 'db_imm';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'active',
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    /**
     * Nombre de la tabla asociada al modelo.
     * @var string
     */
    protected $table = 'users';

    /**
     * Obtener rol asociado con el user.
     */
    public function role()
    {   //primero se declara FK y despues la PK del modelo asociado
        return $this->belongsTo(Role::class,'role_id','id');
    }

    // public function games()
    // {
    //     return $this->hasMany(Game::class, 'game_user_id', 'id');
    // }

    /**
     * Valores defualt para los campos especificados.
     * @var array
     */
    protected $attributes = [
        'active' => true,
    ];
}
