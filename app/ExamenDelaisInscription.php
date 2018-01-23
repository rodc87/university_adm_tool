<?php namespace Emiage;

use Illuminate\Database\Eloquent\Model;
use DB;

class ExamenDelaisInscription extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'examen_delais_inscription';
	protected $primaryKey = 'code_semestre';
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['code_semestre','date_debut_inscription','date_fin_inscription'];

}
