<?php namespace Emiage;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'categorie';
	protected $primaryKey = 'id_cat';
	public 	  $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id_cat','categorie'];

	/**
	 * Lien entre les entités Categorie et Module. Une Categorie possède plusieurs modules.
	 * @return [Array] Liste de Modules appartenant a une categorie
	*/
	public function module()
  {
        return $this->hasMany('Emiage\Module','id_cat','id_cat');
  }

}
