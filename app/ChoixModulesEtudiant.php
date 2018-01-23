<?php namespace Emiage;

use Illuminate\Database\Eloquent\Model;
use DB;

class ChoixModulesEtudiant extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'etudiant_choix_modules';
	protected $primaryKey = array('id_etudiant','code_semestre','code_module');
	public 	  $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id_etudiant','code_semestre','code_module','date_inscription_choix'];

	/**
	 * Get liste d'Etudiants Inscrits. Il est possible de filtrer par semestre, par module et par centre.
	 * @param  [string] $semestre code_semestre
	 * @param  [string] $module   code_module
	 * @param  [string] $centre   nom centre
	 * @return [Array] Liste d'Etudiants Inscrits.
	 */
	public static function etudiants_inscrits($semestre,$module,$centre)
    {

        $query= DB::table('module')->leftjoin('etudiant_choix_modules', 'module.code', '=', 'etudiant_choix_modules.code_module')
				->join('etudiant', 'etudiant_choix_modules.id_etudiant', '=', 'etudiant.id_etudiant')
				->leftjoin('etudiant_centre', 'etudiant.id_etudiant', '=', 'etudiant_centre.id_etudiant')
				->leftjoin('centre', 'centre.id_centre', '=', 'etudiant_centre.id_centre');;

        if(!empty($semestre))
        {
            $query->where('etudiant_choix_modules.code_semestre','=',$semestre);
        }
        if(!empty($module))
        {
            $query->where('etudiant_choix_modules.code_module','=',$module);
        }
				if(!empty($centre))
        {
            $query->where('centre.id_centre','=',$centre);
        }

        return $query->orderBy('etudiant_choix_modules.code_module','asc')->orderBy('etudiant.nom_etudiant','asc');
    }

}
