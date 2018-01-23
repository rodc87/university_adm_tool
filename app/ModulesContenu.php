<?php namespace Emiage;

use Illuminate\Database\Eloquent\Model;

class ModulesContenu extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'modules_contenu';
	protected $primaryKey = 'id_contenu';
	public 	  $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['code','version','adzip'];

}
