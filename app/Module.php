<?php namespace Emiage;

use Illuminate\Database\Eloquent\Model;
use DB;

class Module extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'module';
	protected $primaryKey = 'code';
	public 	  $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['code','nom_module','id_cat'];

	/**
	 * Lien entre les entités Module et Contenu. Un module possède plusieurs contenus.
	 * @return [Array] Contenus Module
	 */
	public function contenus()
  {
        return $this->hasMany('Emiage\ModulesContenu','code','code');
  }

 /**
	 * Lien entre les entités Module et Categorie. Un module appartient à une categorie.
 */
	public function categorie()
  {
        return $this->belongsTo('Emiage\Categorie','id_cat','id_cat');
  }

	/**
	 * Get Liste de Modules tout en excluant une liste de choix.
	 * @param  [Array] $choixs Liste de Choix
	 * @return [Array]         Liste de Modules.
	 */
	public static function exclure_choix($choixs)
	{
			return DB::table('module')->whereNotIn('code',$choixs);
	}

}
