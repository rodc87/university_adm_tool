<?php namespace Emiage;

use Illuminate\Database\Eloquent\Model;
use DB;

class Etudiant extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'etudiant';
	protected $primaryKey = 'id_etudiant';
	public 	  $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id_utilisateur','nom_etudiant','prenom_etudiant',
	'email','telephone','date_entree','addresse_postale','niveau_etudes'];

	/**
	 * Get Identifiant Etudiant
	 * @return [int] id_etudiant
	 */
	public function getIdEtudiant() {
	    return $this->getKey();
	}

}
