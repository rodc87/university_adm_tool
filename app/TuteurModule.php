<?php namespace Emiage;

use Illuminate\Database\Eloquent\Model;
use DB;

class TuteurModule extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'tuteur_modules';
	protected $primaryKey = array('id_tuteur','code_semestre','code_module');
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id_tuteur','code_semestre','code_module'];

	/**
	 * Liste de Tuteurs par Module pour le semestre en cours.
	 * @return [Array] Liste de Tuteurs par Module
	 */
	public static function gettuteursmodules()
	{
		$semestre=Semestre::SemestreEnCours();

		return DB::table('tuteur_modules')->join('modules_ouverts', function($join)
    {
      $join->on('tuteur_modules.code_module','=', 'modules_ouverts.code_module')->on('tuteur_modules.code_semestre','=','modules_ouverts.code_semestre');
    })
    ->join('module', 'tuteur_modules.code_module', '=', 'module.code')
    ->join('tuteur', 'tuteur_modules.id_tuteur', '=', 'tuteur.id_tuteur')
    ->join('tuteur_centre', 'tuteur.id_tuteur', '=', 'tuteur_centre.id_tuteur')
    ->join('centre', 'tuteur_centre.id_centre', '=', 'centre.id_centre')
    ->where('tuteur_modules.code_semestre',$semestre)->orderBy('tuteur_modules.code_module','asc');
	}

}
