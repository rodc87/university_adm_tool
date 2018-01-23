<?php namespace Emiage;

use Illuminate\Database\Eloquent\Model;
use DB;

class Centre extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'centre';
	protected $primaryKey = 'id_centre';
	public 	  $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['nom_centre','ville',
	'pays','nature'];

}
