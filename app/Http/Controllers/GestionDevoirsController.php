<?php namespace Emiage\Http\Controllers;
use Auth;

use Emiage\Activite;
use Emiage\ActiviteParModule;
use Emiage\Semestre;
use Emiage\Module;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use DB;
use Input;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class GestionDevoirsController extends Controller {

  /**
	* Page principale Gestion de Devoirs
	* @return Response
	*/
  public function getdevoirs(){

    $sm=null;
    $mod=null;
    $allsemestres= ActiviteParModule::getSemestres()->get();
    $allmodules= ActiviteParModule::getModules()->get();
    $alldevoirs = ActiviteParModule::getActivitesParModule($sm,$mod)->simplePaginate(15);

    return view('gestiondevoirs/devoirs',['alldevoirs'=>$alldevoirs,'allsemestres'=>$allsemestres,'allmodules'=>$allmodules]);
  }

  /**
  * Filtrer liste de devoirs. Deux options de filtrage sont possibles: par semestre et par module.
  * @return Response
  */
  public function postdevoirs(){

    $semestre=Request::input('semestre');
    $module=Request::input('module');

    //Check POST parameters
    if($semestre == 'ALL')
    {
      $sm=null;
    }
    else
    {
      $sm=$semestre;
    }

    if($module == 'ALL')
    {
      $mod=null;
    }
    else
    {
      $mod=$module;
    }

    $allsemestres= ActiviteParModule::getSemestres()->get();
    $allmodules= ActiviteParModule::getModules()->get();
    $alldevoirs = ActiviteParModule::getActivitesParModule($sm,$mod)->simplePaginate(15);

    return view('gestiondevoirs/devoirs',['alldevoirs'=>$alldevoirs,'allsemestres'=>$allsemestres,'allmodules'=>$allmodules]);
  }

  /**
  * Get Liste de Devoirs par Semestre et par Module.
  * @return [Array] JSON
  */
  public function listedevoirsparmodule(){

    $code = Input::get('code');
    $semestre = Input::get('semestre');

    $idact= ActiviteParModule::where('code_module',$code)->where('code_semestre',$semestre)->lists('id_act');
    $acts = DB::table('activite')->whereIn('id_act',$idact)->get();

    return Response::json($acts);

  }

  /**
  * Telecharger Contenu d'un Devoir
  * @param [string] $rqfile  nom activité
  * @return activité
  */
  public function devoirscontenu($rqfile){

    //File is stored under project/public/resources/activites
    $file= public_path()."/resources/activites/". $rqfile ;
    return Response::download($file,$rqfile);

  }

  /**
  * Ajouter Devoir
  * @return Response
  */
  public function getajouterdevoir(){
    $allsemestres = Semestre::all();
    $allmodules   = Module::all();
    return view('gestiondevoirs/ajouterdevoir',['allsemestres'=>$allsemestres,'allmodules'=>$allmodules]);
  }

  /**
  * Enregistrer Devoir
  * @return Response
  */
  public function postajouterdevoir(){
    //Get Module Params
		$code=Request::input('code');
		$semestre=Request::input('semestre');
    $titre = Request::input('titre_act');
    $file = Request::file('filefield');
    Storage::disk('activites')->put($file->getClientOriginalName(),File::get($file));

    //Create New Activite
    $date = new \DateTime;
    $act = new Activite;
    $act->titre_act = $titre;
    $act->indicA= 'Ok';
    $act->ad_act = $file->getClientOriginalName();
    $act->utilisateur_creation = Auth::user()->username;
    $act->date_creation =$date;
    $act->save();

    //Retrieve Inserted Id
    $insertedId = $act->id_act;

    //Create New Activite Par Module
    DB::table('activites_par_module')->insert(
      array('id_act' => $insertedId, 'code_semestre' => $semestre,'code_module'=>$code)
    );

    return redirect('devoirs');
  }

  /**
  * Modifier Devoir
  * @return Response
  */
  public function getmodifierdevoir(){
    $allsemestres = Semestre::all();
    $allmodules   = Module::all();
    return view('gestiondevoirs/modifierdevoir',['allsemestres'=>$allsemestres,'allmodules'=>$allmodules]);
  }

  /**
  * Enregistrer Modification Devoir
  * @return Response
  */
  public function postmodifierdevoir(){

    //Get Module Params
		$code=Request::input('code');
		$semestre=Request::input('semestre');
    $titre = Request::input('titre_act');
    $devoir_a_modifier = Request::input('devoir_a_modifier');
    $file = Request::file('filefield');

    //Retrieve old Devoir Content
    $act = Activite::where('id_act',$devoir_a_modifier)->firstOrFail();
    //Delete File on Disk 'activites'
    Storage::disk('activites')->delete($act->ad_act);
    //Replace content with new one
    Storage::disk('activites')->put($file->getClientOriginalName(),File::get($file));

    //Update Devoir
    $date = new \DateTime;
    $act->titre_act = $titre;
    $act->ad_act = $file->getClientOriginalName();
    $act->utilisateur_creation = Auth::user()->username;
    $act->date_creation =$date;
    $act->save();

    return redirect('devoirs');
  }

}
