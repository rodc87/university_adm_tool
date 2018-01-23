<?php namespace Emiage;

use Illuminate\Database\Eloquent\Model;
use DB;

class Semestre extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'semestre';
	protected $primaryKey = 'id_semestre';
	public 	  $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['code_semestre','utilisateur_creation',
	'date_creation'];

	/**
	 * Semestre en Cours
	 * @return [string] code_semestre.
	 */
	public static function SemestreEnCours()
    {
            return DB::table('semestre')->select('code_semestre')->where('id_semestre','=',
            function($query)
    		{
            	$query->select(DB::raw('max(id_semestre)'))->from('semestre');
    		})->first()->code_semestre;
    }

}
