<?php

namespace App\Models\GPCenter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Especificar la conexion si no es la por default
     * @var string
     */
    protected $connection = "mysql_gp_center";

    /**
     * Los atributos que se pueden solicitar.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role_id',
        'phone',
        'license_number',
        'license_due_date',
        'payroll_number',
        'department_id',
        'name',
        'paternal_last_name',
        'maternal_last_name',
        'community_id',
        'street',
        'num_ext',
        'num_int',
        'active',
        'deleted_at'
    ];

    /**
     * Los atributos que deben ocultarse para la serialización.
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
