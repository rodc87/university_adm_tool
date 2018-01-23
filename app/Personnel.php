<?php namespace Emiage;

use Illuminate\Database\Eloquent\Model;
use DB;

class Personnel extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'personnel';
	protected $primaryKey = 'id_personnel';
	public 	  $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id_utilisateur','nom_personnel','prenom_personnel',
	'email','telephone','addresse_postale','date_entree'];

	/**
	 * Get Identifiant Personnel
	 * @return [int] id_personnel
	 */
	public function getIdPersonnel() {
	    return $this->getKey();
	}

}
