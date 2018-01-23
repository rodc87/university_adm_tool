<?php namespace Emiage;

use Illuminate\Database\Eloquent\Model;
use DB;

class PersonnelCentre extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'personnel_centre';
	protected $primaryKey = array('id_personnel','id_centre');
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id_personnel','id_centre'];

}
