<?php namespace Emiage\Http\Controllers;
use Auth;

use Emiage\Centre;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use DB;

class GestionCentresController extends Controller {

  /**
	* Page principale Gestion de Centres
	* @return Response
	*/
  public function getcentres(){
    $allcentres = Centre::paginate(15);
    return view('gestioncentres/centres',['allcentres'=>$allcentres]);
  }
  /**
  * Ajouter Centre
  * @return Response
  */
  public function getajoutercentre(){
    return view('gestioncentres/ajoutercentre');
  }
  /**
  * Enregistrer Centre
  * @return Response
  */
  public function postajoutercentre(){
    $centre=Request::input('nom_centre');
    $ville=Request::input('ville');
    $pays=Request::input('pays');
    $nature=Request::input('nature');

    //Create New Categorie
    $ctr = new Centre;
    $ctr->nom_centre = $centre;
    $ctr->ville = $ville;
    $ctr->pays = $pays;
    $ctr->nature = $nature;
    $ctr->save();

    return redirect('centres');
  }
  /**
  * Modifier Centre
  * @param [int] $idcentre Identifant Centre
  * @return Response
  */
  public function getmodifiercentre($idcentre){
    $centre = Centre::where('id_centre',$idcentre)->firstOrFail();
    return view('gestioncentres/modifiercentre',['centre'=>$centre]);
  }
  /**
  * Enregistrer Modification Centre
  * @return Response
  */
  public function postmodifiercentre(){
    $idcentre=Request::input('idcentre');
    $centre=Request::input('nom_centre');
    $ville=Request::input('ville');
    $pays=Request::input('pays');
    $nature=Request::input('nature');

    $ctr = Centre::where('id_centre',$idcentre)->firstOrFail();
    $ctr->nom_centre = $centre;
    $ctr->ville = $ville;
    $ctr->pays = $pays;
    $ctr->nature = $nature;
    $ctr->save();

    return redirect('centres');
  }

}
