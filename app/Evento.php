<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';

	protected $fillable = ['nombre', 'direccion', 'imagen', 'fecha', 'hora','descripcion', 'condominio_id', 'precio', 'cupo', 'ocupados'];

    public function condominio(){
		return $this->belongsTo('App\Condominio');
	}
}
