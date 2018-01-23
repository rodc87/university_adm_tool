<?php namespace Emiage;

use Illuminate\Database\Eloquent\Model;
use DB;

class Administrateur extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'administrateur';
	protected $primaryKey = 'id_admin';
	public 	  $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id_utilisateur','nom_admin','prenom_admin',
	'email','telephone','addresse_postale','date_entree'];

	/**
	 * Get Identifiant Administrateur
	 * @return [int] id_administrateur
	 */
	public function getIdAdmin() {
	    return $this->getKey();
	}

}
