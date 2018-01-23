<?php namespace Emiage;

use Illuminate\Database\Eloquent\Model;

class User_Role extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'utilisateur_role';
	protected $primaryKey = 'id_role';
	public 	  $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['nom_role','description_role','utilisateur_creation', 
	'date_creation'];

}
