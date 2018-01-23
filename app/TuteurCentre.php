<?php namespace Emiage;

use Illuminate\Database\Eloquent\Model;
use DB;

class TuteurCentre extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'tuteur_centre';
	protected $primaryKey = array('id_tuteur','id_centre');
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id_tuteur','id_centre'];

}
