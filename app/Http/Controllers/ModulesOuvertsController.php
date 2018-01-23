<?php namespace Emiage\Http\Controllers;
use Auth;
use Emiage\ModulesOuverts;

class ModulesOuvertsController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	/**
	 * Get Liste de Modules Ouverts par Semestre
	 * @return Response
	 */
	public function index()
	{
				$modouverts = ModulesOuverts::modules_ouverts_semestre()->paginate(15);
	            return view('modules/modulesOuverts',['modsouverts' => $modouverts]);

	}

}
