<?php namespace Emiage;

use Illuminate\Database\Eloquent\Model;
use DB;

class ResponsableCentre extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'responsable_centre';
	protected $primaryKey = array('id_responsable','id_centre');
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id_responsable','id_centre'];

}
