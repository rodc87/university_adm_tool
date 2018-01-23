<?php namespace Emiage;

use Illuminate\Database\Eloquent\Model;
use DB;

class Examen extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'examen';
	protected $primaryKey = array('code_module','code_semestre');
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['code_module','code_semestre','date_creation','utilisateur_creation','date_passage'];

	/**
	 * Get Liste d'examens tout en excluant une liste de choix.
	 * Cette fonction sera utilisée pour la modification de l'inscription aux examens ou il existe déjà un choix préalable.
	 * @param  [Array] $choixs Liste de Choix.
	 * @return [Array] Liste d'examens
	 */
	public static function examens_exclure_choix($choixs)
	{
			return DB::table('examen')->where('code_semestre','=', function($query)
			{
							$query->select('code_semestre')->from('semestre')->where('id_semestre','=',
							function($query)
					{
								$query->select(DB::raw('max(id_semestre)'))->from('semestre');
					});
			})->whereNotIn('code_module',$choixs);
	}

/**
 * Liste d'examens avec leur date de passage correspondante.Ces evennements seront placés sur le calendrier d'examen.
 * En dependant du rôle accèdant à cette fonction un filtrage pourra être effectué.
 * ---------------------
 * Conditions Possibles:
 * ---------------------
 * Un responsable module ne vera que le calendrier d'examen des modules desquel il est repsonsable.
 * Un responsable administratif,un responsable centre et un administrateur veront le calendrier d'examen complet.
 * Un tuteur module ne vera que le calendrier d'examen des modules desquels il est tuteur.
 * Un etudiant ne vera que le calendrier d'examen des modules auxquels il est inscrit.
 *
 * @param  [string]  $semestre               code_semestre
 * @param  [int]   	 $idetu                  identifiant etudiant
 * @param  boolean   $is_etudiant            condition: si c'est un etudiant ou pas.
 * @param  [int]     $idresp                 identifiant responsable
 * @param  boolean   $is_responsable_module  condition: si c'est un responsable ou pas.
 * @param  [int]     $idtut                  identifiant tuteur
 * @param  boolean   $is_tuteur_module       condition: si c'est un tuteur ou pas.
 * @return [Array]   Liste d'examens.
 */
	public static function getExamenEvents($semestre,$idetu,$is_etudiant,$idresp,$is_responsable_module,$idtut,$is_tuteur_module)
	{
			$query= DB::table('examen')->where('examen.code_semestre','=',$semestre);

			if(!empty($is_etudiant))
			{
					$query->join('etudiant_examens', function($join)
          {
                  $join->on('examen.code_module', '=', 'etudiant_examens.code_module');
									$join->on('examen.code_semestre', '=', 'etudiant_examens.code_semestre');
          });
					$query->where('etudiant_examens.id_etudiant',$idetu);
			}
			if(!empty($is_responsable_module))
			{
					$query->whereIN('examen.code_module', function($query) use ($idresp,$semestre)
					{
							$query->select('code_module')->from('responsable_modules')->where('id_responsable',$idresp)->where('code_semestre',$semestre);
					});
			}
			if(!empty($is_tuteur_module))
			{
					$query->whereIN('examen.code_module', function($query) use ($idtut,$semestre)
					{
							$query->select('code_module')->from('tuteur_modules')->where('id_tuteur',$idtut)->where('code_semestre',$semestre);
					});
			}

			return $query->selectRaw('CONCAT("Examen du Module ","-", examen.code_module) as title, examen.date_passage as start')->get();
	}

}
