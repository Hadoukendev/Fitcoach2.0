<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitado extends Model
{
    protected $table = 'invitados';

	protected $fillable = ['nombre','email','telefono','genero','horario_id'];

  	public function reservacion(){
       	return $this->belongsTo('App\Reservacion');
    }
}
