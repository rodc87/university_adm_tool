<?php namespace Emiage;

use Illuminate\Database\Eloquent\Model;
use DB;

class Tuteur extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'tuteur';
	protected $primaryKey = 'id_tuteur';
	public 	  $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id_utilisateur','nom_tuteur','prenom_tuteur',
	'email','telephone','addresse_postale','date_entree'];

	/**
	 * Get Identifiant Tuteur
	 * @return [int] id_tuteur
	 */
	public function getIdResponsable() {
	    return $this->getKey();
	}

}
