<?php namespace Emiage;

use Illuminate\Database\Eloquent\Model;
use DB;

class ModulesOuverts extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'modules_ouverts';
	protected $primaryKey = array('code_module','code_semestre');
	public 	  $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['code_module','code_semestre'];

	/**
	 * Liste de modules ouverts pour le semestre en cours
	*/
	public static function modules_ouverts_semestre()
    {
        return DB::table('modules_ouverts')->join('module', 'modules_ouverts.code_module', '=', 'module.code')->where('code_semestre','=', function($query)
        {
                $query->select('code_semestre')->from('semestre')->where('id_semestre','=',
                function($query)
        		{
                	$query->select(DB::raw('max(id_semestre)'))->from('semestre');
        		});
        });
    }

		/**
		 * Liste de modules ouverts pour le semestre en cours tout en excluant une liste de choix prealables.
		*/
    public static function modules_ouverts_semestre_exclure_choix($choixs)
    {
        return DB::table('modules_ouverts')->join('module', 'modules_ouverts.code_module', '=', 'module.code')->where('code_semestre','=', function($query)
        {
                $query->select('code_semestre')->from('semestre')->where('id_semestre','=',
                function($query)
        		{
                	$query->select(DB::raw('max(id_semestre)'))->from('semestre');
        		});
        })->whereNotIn('code_module',$choixs);
    }

}
