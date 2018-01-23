<?php namespace Emiage\Http\Controllers;
use Auth;

use Emiage\Semestre;
use Emiage\Module;
use Emiage\Categorie;
use Emiage\ModulesContenu;
use Emiage\ModulesOuverts;
use Emiage\Responsable;
use Emiage\ResponsableModule;
use Emiage\Tuteur;
use Emiage\TuteurModule;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use DB;

class GestionModulesController extends Controller {

/**************************************************************************************************************************************
* 																																																																		*
* 																 	Gestion Modules                                                                                   *
* 																				                                                  																					*
**************************************************************************************************************************************/

  /**
  * Page principale Gestion Modules
  * @return Response
  */
  public function getmodules()
  {
    $categories= Categorie::with('module')->orderBy('id_cat', 'asc')->paginate(1);
    $allcategories = Categorie::all();
    $allmodules =  Module::all();
    return view('gestionmodules/modules',['categories' => $categories,'allmodules'=>$allmodules,'allcategories'=>$allcategories]);
  }

  /**
  * Filtrer liste de modules. Deux options de filtrage sont possibles: par categorie et par module.
  * @return Response
  */
  public function postmodules()
  {
    $categorie=Request::input('categorie');
    $module=Request::input('module');
    $allcategories = Categorie::all();
    $allmodules =  Module::all();

    //Check POST parameters
    if($categorie == 'ALL')
    {
      $cat=null;
    }
    else
    {
      $cat=$categorie;
    }

    if($module == 'ALL')
    {
      $mod=null;
    }
    else
    {
      $mod=$module;
    }

    if(!empty($mod))
    {
      //Apply POST parameters
      $q = Categorie::whereHas('module',function($query) use ($mod){
      $query->where('code', '=',$mod);});
      $q = $q->with(array('module' => function($query2) use ($mod){
      $query2->where('code', '=',$mod);}));
    }
    else
    {
      $q = Categorie::with('module');
    }

     if(!empty($cat))
     {
         $q->where('categorie','=',$cat);
     }

    $categories= $q->orderBy('id_cat', 'asc')->paginate(1);
    return view('gestionmodules/modules',['categories' => $categories,'allmodules'=>$allmodules,'allcategories'=>$allcategories]);
  }

  /**
   * Get Liste de Contenus par Module
   * @param  [string] $code code_module
   * @return [Array] JSON
   */
  public function getmodulescontenu($code)
  {
    $modcontenu= ModulesContenu::where('code',$code)->get();
    return Response::json($modcontenu);
  }

  /**
   *  Telecharger Contenu d'un Module
   * @param  [string] $zip fichier à telecharger
   * @return .zip (Contenu du Module)
   */
  public function getmodulescontenuzip($zip)
  {
    //Zip file is stored under project/public/resources/modules_contenu
    $file= public_path(). "/resources/modules_contenu/". $zip ;
    $headers = array('Content-Type: application/zip',);
    return Response::download($file,$zip,$headers);

  }

  /**
  * Ajouter Module
  * @return Response
  */
  public function getajoutermodule()
  {
    $allcategories = Categorie::all();
    return view('gestionmodules/ajoutermodule',['allcategories'=>$allcategories]);

  }

  /**
  * Enregistrer Module
  * @return Response
  */
  public function postajoutermodule()
  {
    //Get Module Params
		$code=Request::input('code');
		$nommodule=Request::input('nommodule');
    $categorie =Request::input('categorie');

    //Create New Module
    $mod = new Module;
    $mod->code =$code;
    $mod->nom_module =$nommodule;
    $mod->id_cat =$categorie;
    $mod->save();

    return redirect('modules');
  }

  /**
  * Ajouter Contenu Module
  * @return Response
  */
  public function getajoutercontenumodule()
  {
    $allmodules =  Module::all();
    $versions =  range(1,15);
    return view('gestionmodules/ajoutercontenumodule',['allmodules'=>$allmodules,'versions'=>$versions]);
  }

  /**
  * Enregistrer Contenu Module
  * @return Response
  */
  public function postajoutercontenumodule()
  {
    //Get Module Params
		$code=Request::input('code');
		$version=Request::input('version');
    $file = Request::file('filefield');
    $extension = $file->getClientOriginalExtension();
    Storage::disk('modules_contenu')->put($file->getClientOriginalName(),File::get($file));

    //Create New Module
    $mod = new ModulesContenu;
    $mod->code = $code;
    $mod->version= $version;
    $mod->adzip = $file->getClientOriginalName();
    $mod->save();

    return redirect('modules');
  }

  /**
  * Modifier Contenu Module
  * @return Response
  */
  public function getmodifiercontenumodule()
  {
    $allmodules =  Module::all();
    $versions =  range(1,15);
    return view('gestionmodules/modifiercontenumodule',['allmodules'=>$allmodules,'versions'=>$versions]);
  }

  /**
  * Enregistrer Modification Contenu Module
  * @return Response
  */
  public function postmodifiercontenumodule()
  {
    //Get Module Params
		$code=Request::input('code');
		$version=Request::input('version');
    $old_contenu_module =Request::input('old_contenu_module');
    $file = Request::file('filefield');
    $extension = $file->getClientOriginalExtension();

    //Retreive old Module Content
    $mod = ModulesContenu::where('id_contenu',$old_contenu_module)->firstOrFail();

    //Delete File on Disk 'modules_contenu'
    Storage::disk('modules_contenu')->delete($mod->adzip);
    //Replace content with new one
    Storage::disk('modules_contenu')->put($file->getClientOriginalName(),File::get($file));
    //Set new Module Content Values
    $mod->code = $code;
    $mod->version= $version;
    $mod->adzip = $file->getClientOriginalName();
    $mod->save();

    return redirect('modules');
  }

/**************************************************************************************************************************************
* 																																																																		*
* 																 	Gestion Categories                                                                                *
* 																				                                                  																					*
**************************************************************************************************************************************/

  /**
  * Page principale Gestion Categories
  * @return Response
  */
  public function getcategories(){
    $allcategories = Categorie::paginate(15);
    return view('gestionmodules/categories',['allcategories'=>$allcategories]);
  }

  /**
  * Ajouter Categorie
  * @return Response
  */
  public function getajoutercategorie(){
    return view('gestionmodules/ajoutercategorie');
  }

  /**
  * Enregistrer Categorie
  * @return Response
  */
  public function postajoutercategorie(){
    $categorie=Request::input('categorie');

    //Create New Categorie
    $cat = new Categorie;
    $cat->categorie = $categorie;
    $cat->save();

    return redirect('categories');
  }

  /**
  * Modifier Categorie
  * @return Response
  */
  public function getmodifiercategorie($idcategorie){
    $categorie = Categorie::where('id_cat',$idcategorie)->firstOrFail();
    return view('gestionmodules/modifiercategorie',['categorie'=>$categorie]);
  }

  /**
  * Enregister Modification Categorie
  * @return Response
  */
  public function postmodifiercategorie(){

    $idcategorie=Request::input('idcategorie');
    $categorie=Request::input('categorie');

    $cat = Categorie::where('id_cat',$idcategorie)->firstOrFail();
    $cat->categorie = $categorie;
    $cat->save();

    return redirect('categories');
  }

/**************************************************************************************************************************************
* 																																																																		*
* 																 	Gestion Modules Ouverts                                                                           *
* 																				                                                  																					*
**************************************************************************************************************************************/

  /**
  * Page principale Gestion de Modules Ouverts
  * @return Response
  */
  public function getmodulesouverts(){
    $modouverts = ModulesOuverts::modules_ouverts_semestre()->paginate(15);
    return view('gestionmodules/modulesouverts',['modouverts' => $modouverts]);
  }

  /**
  * Choix des modules qui seront ouverts pour le semestre en cours.
  * @return Response
  */
  public function getchoisirmodulesouverts(){
    $allmodules = Module::all();
    $modouverts=NULL;
    return view('gestionmodules/choisirmodulesouverts',['modouverts' => $modouverts,'allmodules' => $allmodules]);
  }

  /**
  * Enregister choix de modules ouverts pour le semestre en cours.
  * @return Response
  */
  public function postchoisirmodulesouverts(){
      try
      {
        $choixmod=Request::input('post_content');
        $arrchoix=explode(',', $choixmod);
        array_pop($arrchoix);

        $semestre=Semestre::SemestreEnCours();

        foreach ($arrchoix as $choix)
        {
            DB::table('modules_ouverts')->insert(
              array('code_semestre' => $semestre,'code_module'=>$choix)
          );
        }

          return redirect('modulesOuverts')->with('success', "L'enregistrement des modules ouverts a été effectué avec succès.");
      }
      catch(Exception $ex)
      {
          return redirect('modulesOuverts')->with('error', "Une erreur s'est produite lors de l'enregistement des modules ouverts. Veuillez reessayer à nouveau.");
      }

  }

  /**
  * Modifier choix des modules ouverts pour le semestre en cours.
  * @return Response
  */
  public function getmodifiermodulesouverts(){

    $modouverts = ModulesOuverts::modules_ouverts_semestre()->get();
    $arr_choixs = ModulesOuverts::modules_ouverts_semestre()->lists('code_module');
    $allmodules = Module::exclure_choix($arr_choixs)->get();

    return view('gestionmodules/modifiermodulesouverts',['modouverts' => $modouverts,'allmodules' => $allmodules]);

  }

  /**
  * Enregistrer modification des modules ouverts pour le semestre en cours.
  * @return Response
  */
  public function postmodifiermodulesouverts(){
    try
    {
      $choixmod=Request::input('post_content');
      $arrchoix=explode(',',$choixmod);
      array_pop($arrchoix);

      $semestre=Semestre::SemestreEnCours();

      DB::table('modules_ouverts')->where('code_semestre',$semestre)->delete();

      foreach ($arrchoix as $choix)
      {
          DB::table('modules_ouverts')->insert(
              array('code_semestre' => $semestre,'code_module'=>$choix)
          );
      }
        return redirect('modulesOuverts')->with('success', "L'enregistrement des modules ouverts a été effectué avec succès.");
    }
    catch(Exception $ex)
    {
        return redirect('modulesOuverts')->with('error', "Une erreur s'est produite lors de l'enregistement des modules ouverts. Veuillez reessayer à nouveau.");
    }

  }

/**************************************************************************************************************************************
 * 																																																																		*
 * 																 	Gestion Responsables Modules                                                                      *
 * 																				                                                  																					*
 **************************************************************************************************************************************/

 /**
 * Page principale Gestion Responsables Modules
 * @return Response
 */
  public function getresponsablesmodules(){
        $respmodules = ResponsableModule::getresponsablesmodules()->paginate(15);
        return view('gestionmodules/responsablesmodules',['respmodules' => $respmodules]);
  }
  /**
  * Ajouter Responsable Module pour le semestre en cours.
  * @return Response
  */
  public function getajouterresponsablemodule(){
        $allmodules = Module::all();
        $allresponsables = Responsable::all();

        return view('gestionmodules/ajouterresponsablemodule',['allmodules' => $allmodules,'allresponsables' => $allresponsables]);
  }
  /**
  * Enregistrer Responsable Module pour le semestre en cours.
  * @return Response
  */
  public function postajouterresponsablemodule(){
        $code=Request::input('code');
        $responsable=Request::input('responsable');
        $semestre=Semestre::SemestreEnCours();

        DB::table('responsable_modules')->where('code_module',$code)->where('code_semestre',$semestre)->delete();
        DB::table('responsable_modules')->insert(
            array('id_responsable' => $responsable,'code_semestre' => $semestre,'code_module'=>$code)
        );

        return redirect('responsablesModules');
  }
  /**
  * Modifier Responsable par Module pour le semestre en cours.
  * @param [int] $idmodresp  id_responsable (l'identifiant du responsable à modifier)
  * @return Response
  */
  public function getmodifierresponsablemodule($idmodresp){
        $allmodules = Module::selectRaw('CONCAT(code,"-", nom_module) as ModuleFullName,code')->lists('ModuleFullName','code');
        $allresponsables = Responsable::selectRaw('CONCAT(prenom_responsable," ", nom_responsable) as ResponsableFullName,id_responsable')->lists('ResponsableFullName','id_responsable');
        $arrresp=explode('_',$idmodresp);
        $code =$arrresp[0];
        $id_resp =$arrresp[1];
        return view('gestionmodules/modifierresponsablemodule',['allmodules' => $allmodules,'allresponsables' => $allresponsables,'code'=>$code,'id_resp'=>$id_resp]);
  }
  /**
  * Enregistrer Modification Responsable par Module pour le semestre en cours.
  * @return Response
  */
  public function postmodifierresponsablemodule(){
        $code=Request::input('code');
        $responsable=Request::input('responsable');
        $semestre=Semestre::SemestreEnCours();

        DB::table('responsable_modules')->where('code_module',$code)->where('code_semestre',$semestre)->delete();
        DB::table('responsable_modules')->insert(
            array('id_responsable' => $responsable,'code_semestre' => $semestre,'code_module'=>$code)
        );
        return redirect('responsablesModules');
  }

/**************************************************************************************************************************************
 * 																																																																		*
 * 																				Gestion Tuteurs Modules                                                                     *
 * 																				                                                  																					*
 **************************************************************************************************************************************/

 /**
 * Page principale Gestion Tuteurs Modules
 * @return Response
 */
  public function gettuteursmodules(){
        $tutmodules = TuteurModule::gettuteursmodules()->paginate(15);
        return view('gestionmodules/tuteursmodules',['tutmodules' => $tutmodules]);
  }

  /**
  * Ajouter Tuteur Module pour le semestre en cours.
  * @return Response
  */
  public function getajoutertuteurmodule(){
        $allmodules = ModulesOuverts::modules_ouverts_semestre()->selectRaw('CONCAT(module.code,"-", module.nom_module) as ModuleFullName,module.code')->lists('ModuleFullName','module.code');
        $alltuteurs = Tuteur::selectRaw('CONCAT(prenom_tuteur," ", nom_tuteur) as TuteurFullName,id_tuteur')->lists('TuteurFullName','id_tuteur');
        return view('gestionmodules/ajoutertuteurmodule',['allmodules' => $allmodules,'alltuteurs' => $alltuteurs]);
  }

  /**
  * Enregistrer Tuteur Module pour le semestre en cours.
  * @return Response
  */
  public function postajoutertuteurmodule(){
        $code=Request::input('code');
        $tuteur=Request::input('tuteur');
        $semestre=Semestre::SemestreEnCours();

        //DB::table('tuteur_modules')->where('code_module',$code)->where('code_semestre',$semestre)->delete();
        DB::table('tuteur_modules')->insert(
            array('id_tuteur' => $tuteur,'code_semestre' => $semestre,'code_module'=>$code)
        );
        return redirect('tuteurModules');
  }

  /**
  * Modifier Tuteur par Module pour le semestre en cours.
  * @param [int] $idmodtut  id_tuteur (l'identifiant du tuteur à modifier)
  * @return Response
  */
  public function getmodifiertuteurmodule($idmodtut){
        $allmodules = ModulesOuverts::modules_ouverts_semestre()->selectRaw('CONCAT(module.code,"-", module.nom_module) as ModuleFullName,module.code')->lists('ModuleFullName','module.code');
        $alltuteurs = Tuteur::selectRaw('CONCAT(prenom_tuteur," ", nom_tuteur) as TuteurFullName,id_tuteur')->lists('TuteurFullName','id_tuteur');
        $arrresp=explode('_',$idmodtut);
        $code =$arrresp[0];
        $id_tut =$arrresp[1];
        return view('gestionmodules/modifiertuteurmodule',['allmodules' => $allmodules,'alltuteurs' => $alltuteurs,'code'=>$code,'id_tut'=>$id_tut]);
  }

  /**
  * Enregistrer Modification Tuteur par Module pour le semestre en cours.
  * @return Response
  */
  public function postmodifiertuteurmodule(){
        $code=Request::input('code');
        $oldtuteur=Request::input('old_tut_val');
        $tuteur=Request::input('tuteur');
        $semestre=Semestre::SemestreEnCours();

        DB::table('tuteur_modules')->where('code_module',$code)->where('code_semestre',$semestre)->where('id_tuteur',$oldtuteur)->delete();
        DB::table('tuteur_modules')->insert(
            array('id_tuteur' => $tuteur,'code_semestre' => $semestre,'code_module'=>$code)
        );
        return redirect('tuteurModules');
  }

}
