<?php namespace Emiage;

use Illuminate\Database\Eloquent\Model;
use DB;

class ActiviteParModule extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'activites_par_module';
	protected $primaryKey = array('id_act','code_module','code_semestre');
	public 	  $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id_act','code_module','code_semestre'];

	/**
	 * Get liste d'activités par semestre et par module
	 * @param   [string] $semestre code_semestre
	 * @param   [string] $module   code_module
	 * @return  [Array] Liste d'activités par semestre et par module
	 */
	public static function getActivitesParModule($semestre,$module)
    {
        $query= DB::table('activites_par_module');

				if(!empty($semestre))
				{
						$query->where('code_semestre','=',$semestre);
				}
				if(!empty($module))
				{
						$query->where('code_module','=',$module);
				}

        return $query->select('code_module','code_semestre')->groupBy('code_module','code_semestre');
    }
		/**
		 * Get Liste de Semestres - correspondant aux activités par module
		 * @return [Array] Liste de Semestres
		 */
		public static function getSemestres()
		{
					$query= DB::table('activites_par_module');
					return $query->select('code_semestre')->groupBy('code_semestre');
		}
		/**
		 * Get Liste de Modules - correspondant aux activités par module
		 * @return [Array] Liste de Modules
		 */
		public static function getModules()
		{
					$query= DB::table('activites_par_module');
					return $query->select('code_module')->groupBy('code_module');
		}

}
