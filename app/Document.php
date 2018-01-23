<?php namespace Emiage;

use Illuminate\Database\Eloquent\Model;
use DB;

class Document extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'documents';
	protected $primaryKey = 'id_document';
	public 	  $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['nom_document','description_document','type_document',
	'document','utilisateur_creation','date_creation'];

}
