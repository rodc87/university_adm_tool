<?php namespace Emiage;

use Illuminate\Database\Eloquent\Model;
use DB;

class ResponsableModule extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'responsable_modules';
	protected $primaryKey = array('id_responsable','code_semestre','code_module');
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id_responsable','code_semestre','code_module'];

	/**
	 * Liste de Responsables par Module pour le semestre en cours.
	 * @return [Array] Liste de Responsables par Module
	 */
	public static function getresponsablesmodules()
	{
		$semestre=Semestre::SemestreEnCours();

		return DB::table('responsable_modules')
		->join('module', 'responsable_modules.code_module', '=', 'module.code')
		->join('responsable', 'responsable_modules.id_responsable', '=', 'responsable.id_responsable')
		->join('responsable_centre', 'responsable.id_responsable', '=', 'responsable_centre.id_responsable')
		->join('centre', 'responsable_centre.id_centre', '=', 'centre.id_centre')
		->where('responsable_modules.code_semestre',$semestre)->orderBy('module.code','asc');
	}

}
