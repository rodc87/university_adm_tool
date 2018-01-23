<?php namespace Emiage;

use Illuminate\Database\Eloquent\Model;
use DB;

class EtudiantExamens extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'etudiant_examens';
	protected $primaryKey = array('id_etudiant','code_module','code_semestre');
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id_etudiant','code_module','code_semestre','copie_examen','presence_examen','nom_centre','autre_centre','date_inscription_examen','date_upload_examen','date_correction_examen','correcteur_examen','note_examen','note_examen_sur','note_apres_pv'];

	/**
	 * Get Liste d'inscrits aux examens. En dependant du role accèdant à cette fonction un filtrage pourra être effectué.
	 * ---------------------
	 * Conditions Possibles:
	 * ---------------------
	 * Un responsable module ne vera que la liste d'inscrits des modules desquels il est responsable.
	 * Un responsable administratif, un responsable centre et un administrateur veront la liste complète d'inscrits.
	 *
	 * @param  [string]  $semestre             			code_semestre
	 * @param  [int]  	 $idresp                  	identifiant responsable
	 * @param  boolean	 $is_responsable_module 		condition : si c'est un responsable module ou pas.
	 * @param  [string]  $centre                  	centre
	 * @param  [string]  $module                  	code_module
	 * @return [Array]  Liste d'inscrits aux examens.
	 */
	public static function getinscritsExamens($semestre,$idresp,$is_responsable_module,$centre,$module)
		{
				$query= DB::table('etudiant_examens')->join('etudiant', 'etudiant_examens.id_etudiant', '=', 'etudiant.id_etudiant');

				if(!empty($semestre))
				{
						$query->where('code_semestre',$semestre);
				}
				if(!empty($is_responsable_module))
				{
						$query->whereIN('code_module', function($query) use ($idresp,$semestre)
						{
								$query->select('code_module')->from('responsable_modules')->where('id_responsable',$idresp)->where('code_semestre',$semestre);
						});
				}
				if(!empty($centre))
				{
						if($centre!='Autre')
						{
							$query->where('nom_centre',$centre);
						}
						else
						{
							$query->where('autre_centre',1);
						}
				}
				if(!empty($module))
				{
					$query->where('code_module',$module);
				}

				return $query->orderBy('code_module','ASC');
		}

	/**
	 * Get Liste de notes d'examen. En dependant du rôle accèdant à cette fonction un filtrage pourra être effectué.
	 * ---------------------
	 * Conditions Possibles:
	 * ---------------------
	 * Un responsable module ne vera que la liste des notes des modules desquels il est responsable.
	 * Un responsable administratif,un responsable centre et un administrateur veront la liste complète des notes.
	 * Un tuteur module ne vera que la liste des notes de modules desquels il est tuteur.
	 * Un etudiant ne vera que la liste de notes des modules auxquels il est inscrit.
	 *
	 * @param  [string]  $semestre              	code_semestre
	 * @param  [int]  	 $idetu                 	identifiant etudiant
	 * @param  boolean 	 $is_etudiant           	condition: si c'est un etudiant ou pas.
	 * @param  [int]  	 $idresp                	identifiant responsable
	 * @param  boolean 	 $is_responsable_module 	condition: si c'est un responsable ou pas.
	 * @param  [int]  	 $idtut                   identifiant tuteur
	 * @param  boolean 	 $is_tuteur_module        condition: si c'est tuteur ou pas.
	 * @param  [string]  $centre                  centre
	 * @param  [string]  $module                  code_module
	 * @return [Array] 	 Liste de notes d'examen.
	 */
	public static function getconsultationNotesExamens($semestre,$idetu,$is_etudiant,$idresp,$is_responsable_module,$idtut,$is_tuteur_module,$centre,$module){

			$query= DB::table('etudiant_examens')->join('etudiant', 'etudiant_examens.id_etudiant', '=', 'etudiant.id_etudiant')
			->join('etudiant_centre', 'etudiant.id_etudiant', '=', 'etudiant_centre.id_etudiant')->join('centre', 'etudiant_centre.id_centre', '=', 'centre.id_centre');

			if(!empty($semestre))
			{
					$query->where('code_semestre',$semestre);
			}
			if(!empty($is_etudiant))
			{
					$query->where('etudiant_examens.id_etudiant',$idetu);
			}
			if(!empty($is_responsable_module))
			{
					$query->whereIN('code_module', function($query) use ($idresp,$semestre)
					{
							$query->select('code_module')->from('responsable_modules')->where('id_responsable',$idresp)->where('code_semestre',$semestre);
					});
			}
			if(!empty($is_tuteur_module))
			{
					$query->whereIN('code_module', function($query) use ($idtut,$semestre)
					{
							$query->select('code_module')->from('tuteur_modules')->where('id_tuteur',$idtut)->where('code_semestre',$semestre);
					});
			}
			if(!empty($centre))
			{
					$query->where('centre.id_centre',$centre);
			}
			if(!empty($module))
			{
					$query->where('code_module',$module);
			}

			return $query->orderBy('code_module','ASC');

	}
}
