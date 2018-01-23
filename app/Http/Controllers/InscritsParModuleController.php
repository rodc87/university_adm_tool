<?php namespace Emiage\Http\Controllers;
use Auth;
use Emiage\ChoixModulesEtudiant;
use Emiage\Module;
use Emiage\Semestre;
use Emiage\Etudiant;
use Emiage\Centre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class InscritsParModuleController extends Controller {

	/**
	 * Page principale des inscrits par module.
	 * On recupère tous les centres,tous les centres,tous les modules, pour effectuer un filtrage sur la liste d'inscrits.
	 * @return Response
	 */
	public function get()
	{
		$semestre=Semestre::SemestreEnCours();
		$toussemestre=Semestre::orderBy('id_semestre','desc')->get();
		$tousmodules=Module::all();
		$touscentres=Centre::all();

		$inscrits = null;
		$get =1;

	    return view('modules/inscritsParModule',['inscrits' => $inscrits,'toussemestre' => $toussemestre,'tousmodules' => $tousmodules,'touscentres'=>$touscentres,'get' =>$get]);
	}

	/**
	* Get Liste d'inscrits par Module, en fonction des paramètres de filtrage choisis (centre,module,semestre).
	* @return Response
	*/
	public function post()
	{
		$semestre=Request::input('semestre');
		$module=Request::input('module');
		$centre=Request::input('centre');

		if($module == '')
		{
			$mod=null;
		}
		else
		{
			$mod=$module;
		}

		if($centre == '')
		{
			$cent=null;
		}
		else
		{
			$cent=$centre;
		}

		$toussemestre=Semestre::orderBy('id_semestre','desc')->get();
		$tousmodules=Module::all();
		$touscentres=Centre::all();
		$get =0;

		//Retourner les etudiants pour tous les modules ouverts
		$inscrits =ChoixModulesEtudiant::etudiants_inscrits($semestre,$mod,$cent)->get();

	    return view('modules/inscritsParModule',['inscrits' => $inscrits,'toussemestre' => $toussemestre,'tousmodules' => $tousmodules,'touscentres'=>$touscentres,'sem'=>$semestre,'mod'=>$mod,'cent'=>$cent,'get' =>$get]);
	}

	/**
	 * Exporter liste d'inscrits en fonction des paramètres de filtrage choisis (centre,module,semestre)
	 * @return .xlsx file
	 */
	public function exporter_excel()
	{
			$spreadsheet_name = 'Inscrits_par_Module'.'_'.Request::input('semestre_export').'_'.Request::input('module_export');
			Excel::create($spreadsheet_name, function($excel) {

					$excel->sheet('Inscrits_Modules', function($sheet) {

										$semestre=Request::input('semestre_export');
										$module=Request::input('module_export');
										$centre=Request::input('centre_export');

										 $inscrits =ChoixModulesEtudiant::etudiants_inscrits($semestre,$module,$centre)
										 ->select('code','etudiant_choix_modules.code_semestre','etudiant.prenom_etudiant','etudiant.nom_etudiant','etudiant.nom_etudiant','etudiant.email','etudiant_choix_modules.date_inscription_choix','centre.nom_centre')->get();
										 foreach ($inscrits as &$inscrit) {
											    $inscrit = (array)$inscrit;
									   }

										 $sheet->fromArray($inscrits,null,'A1',false,true);
										 $sheet->cells('A1:G1', function($cells) {
										    // manipulate the range of cells
												$cells->setBackground('#337AB7');
												// Set with font color
												$cells->setFontColor('#ffffff');
										});

					});
		})->download('xlsx');
	}

}
