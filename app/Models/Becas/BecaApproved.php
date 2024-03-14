<?php

namespace App\Models\becas;

use App\Models\Becas\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BecaApproved extends Model
{
    use HasFactory;

    /**
     * Especificar la conexion si no es la por default
     * @var string
     */
    protected $connection = "mysql_becas";

    /**
     * Los atributos que se pueden solicitar.
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'beca_id',
        'approved',
        'feedback',
        'active',
        'deleted_at'
    ];

    /**
     * Nombre de la tabla asociada al modelo.
     * @var string
     */
    protected $table = 'becas_approved';

    /**
     * LlavePrimaria asociada a la tabla.
     * @var string
     */
    protected $primaryKey = 'id';


    /**
     * Obtener usuario asociada con la beca aprovada.
     */
    public function user()
    {   //primero se declara FK y despues la PK del modelo asociado
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Obtener beca asociada con la beca aprovada.
     */
    public function beca()
    {   //primero se declara FK y despues la PK del modelo asociado
        return $this->belongsTo(Beca::class, 'beca_id', 'id');
    }


    /**
     * Obtener los usuarios relacionados a un rol.
     */
    // public function users()
    // {
    //     return $this->hasMany(User::class,'role_id','id'); //primero se declara FK y despues la PK
    // }

    /**
     * Valores defualt para los campos especificados.
     * @var array
     */
    // protected $attributes = [
    //     'active' => true,
    // ];
}
