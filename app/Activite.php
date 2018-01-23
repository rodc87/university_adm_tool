<?php namespace Emiage;

use Illuminate\Database\Eloquent\Model;
use DB;

class Activite extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'activite';
	protected $primaryKey = 'id_act';
	public 	  $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['titre_act','ordre','indicA','ad_act','utilisateur_creation','date_creation'];

}
