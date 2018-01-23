<?php namespace Emiage;

use Illuminate\Database\Eloquent\Model;
use DB;

class Responsable extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'responsable';
	protected $primaryKey = 'id_responsable';
	public 	  $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id_utilisateur','nom_responsable','prenom_responsable',
	'email','telephone','addresse_postale','date_entree','type_responsable'];

	/**
	 * Get Identifiant Responsable
	 * @return [int] id_responsable
	 */
	public function getIdResponsable() {
	    return $this->getKey();
	}

}
