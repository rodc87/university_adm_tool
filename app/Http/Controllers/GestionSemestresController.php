<?php namespace Emiage\Http\Controllers;
use Auth;

use Emiage\Semestre;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use DB;

class GestionSemestresController extends Controller {

  /**
  * Page principale Gestion de Semestres
  * @return Response
  */
  public function getsemestres(){
    $allsemestres = Semestre::paginate(15);
    return view('gestionsemestres/semestres',['allsemestres'=>$allsemestres]);
  }

  /**
  * Ajouter Semestre
  * @return Response
  */
  public function getajoutersemestre(){
    return view('gestionsemestres/ajoutersemestre');
  }
  
  /**
  * Enregistrer Semestre
  * @return Response
  */
  public function postajoutersemestre(){
    $semestre=Request::input('semestre');

    //Create New Categorie
    $date = new \DateTime;
    $sm = new Semestre;
    $sm->code_semestre = $semestre;
    $sm->utilisateur_creation = Auth::user()->username;
    $sm->date_creation =$date;
    $sm->save();

    return redirect('semestres');
  }

  /**
  * Modifier Semestre
  * @param [int] $idsemestre  identifiant semestre
  * @return Response
  */
  public function getmodifiersemestre($idsemestre){
    $semestre = Semestre::where('id_semestre',$idsemestre)->firstOrFail();
    return view('gestionsemestres/modifiersemestre',['semestre'=>$semestre]);
  }

  /**
  * Enregistrer Modification Semestre
  * @return Response
  */
  public function postmodifiersemestre(){

    $idsemestre=Request::input('idsemestre');
    $semestre=Request::input('semestre');

    $sm = Semestre::where('id_semestre',$idsemestre)->firstOrFail();
    $sm->code_semestre = $semestre;
    $sm->save();

    return redirect('semestres');
  }

}
