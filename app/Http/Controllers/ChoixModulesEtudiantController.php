<?php namespace Emiage\Http\Controllers;
use Auth;
use Emiage\ChoixModulesEtudiant;
use Emiage\ModulesOuverts;
use Emiage\Semestre;
use Emiage\Etudiant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use DB;

class ChoixModulesEtudiantController extends Controller {

	/**
	* Page principale Inscription de Choix Etudiant.
	* @return Response
	*/
	public function index()
	{
				$semestre=Semestre::SemestreEnCours();
				$idetu = Etudiant::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail()->getIdEtudiant();
				$choix = ChoixModulesEtudiant::where('id_etudiant',$idetu)->where('code_semestre',$semestre)->paginate(15);
	            return view('modules/choixModulesEtudiant',['choix' => $choix]);
	}

	/**
	* Faire Choix Etudiant.
	* @return Response
	*/
	public function choisirget()
	{
				$modouverts = ModulesOuverts::modules_ouverts_semestre()->get();
				$choixs=NULL;
	            return view('modules/choisirModulesEtudiant',['choixs' => $choixs,'modouverts' => $modouverts]);
	}

	/**
	* Enregistrer Choix Etudiant.
	* @return Response
	*/
	public function choisirpost()
	{
				try
				{
					$choixetu=Request::input('post_content');
					$arrchoix=explode(',', $choixetu);
					array_pop($arrchoix);

					$semestre=Semestre::SemestreEnCours();
					$idetu = Etudiant::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail()->getIdEtudiant();
					$date = date('Y-m-d H:i:s');

					foreach ($arrchoix as $choix)
					{
					    DB::table('etudiant_choix_modules')->insert(
						    array('id_etudiant' => $idetu, 'code_semestre' => $semestre,'code_module'=>$choix,'date_inscription_choix'=>$date)
						);
					}

				    return redirect('choixModules')->with('success', "L'enregistrement de vos choix a été effectué avec succès.");
				}
				catch(Exception $ex)
				{
				    return redirect('choixModules')->with('error', "Une erreur s'est produite lors de l'enregistement de vos choix. Veuillez reessayer à nouveau.");
				}
	}

	/**
	* Modifier Choix Etudiant.
	* @return Response
	*/
	public function modifierget()
	{
				$semestre=Semestre::SemestreEnCours();
				$idetu = Etudiant::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail()->getIdEtudiant();
				$choixs = ChoixModulesEtudiant::where('id_etudiant',$idetu)->where('code_semestre',$semestre)->get();
				$arr_choixs = ChoixModulesEtudiant::where('id_etudiant',$idetu)->where('code_semestre',$semestre)->lists('code_module');
				$modouverts = ModulesOuverts::modules_ouverts_semestre_exclure_choix($arr_choixs)->get();

	            return view('modules/modifierModulesEtudiant',['choixs' => $choixs,'modouverts' => $modouverts]);
	}

	/**
	* Enregistrer Modification Choix Etudiant.
	* @return Response
	*/
	public function modifierpost()
	{
				try
				{
					$choixetu=Request::input('post_content');
					$arrchoix=explode(',', $choixetu);
					array_pop($arrchoix);

					$semestre=Semestre::SemestreEnCours();
					$idetu = Etudiant::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail()->getIdEtudiant();
					$date = date('Y-m-d H:i:s');

					DB::table('etudiant_choix_modules')->where('id_etudiant',$idetu)->where('code_semestre',$semestre)->delete();


					foreach ($arrchoix as $choix)
					{
					    DB::table('etudiant_choix_modules')->insert(
						    array('id_etudiant' => $idetu, 'code_semestre' => $semestre,'code_module'=>$choix,'date_inscription_choix'=>$date)
						);
					}

				    return redirect('choixModules')->with('success', "L'enregistrement de vos choix a été effectué avec succès. ");
				}
				catch(Exception $ex)
				{
				    return redirect('choixModules')->with('error', "Une erreur s'est produite lors de l'enregistement de vos choix. Veuillez reessayer à nouveau.");
				}
	}

	/**
	* Get Historique de Choix Etudiant.
	* @return Response
	*/
	public function historiqueget()
	{
		$idetu = Etudiant::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail()->getIdEtudiant();
		$choix = ChoixModulesEtudiant::where('id_etudiant',$idetu)->orderBy('date_inscription_choix', 'desc')->groupBy('code_semestre','code_module')->get();
	    return view('modules/historiqueChoixModules',['choix' => $choix]);

	}


}
