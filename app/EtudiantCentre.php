<?php namespace Emiage;

use Illuminate\Database\Eloquent\Model;
use DB;

class EtudiantCentre extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'etudiant_centre';
	protected $primaryKey = array('id_etudiant','id_centre');
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id_etudiant','id_centre'];

}
