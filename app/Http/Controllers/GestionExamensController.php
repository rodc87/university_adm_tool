<?php namespace Emiage\Http\Controllers;
use Auth;
use Emiage\Semestre;
use Emiage\Module;
use Emiage\ModulesOuverts;
use Emiage\Centre;
use Emiage\Etudiant;
use Emiage\Tuteur;
use Emiage\Responsable;
use Emiage\ResponsableModule;
use Emiage\Examen;
use Emiage\ExamenDelaisInscription;
use Emiage\EtudiantExamens;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use DB;
use Input;
use DateTime;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class GestionExamensController extends Controller {

  /**************************************************************************************************************************************
  * 																																																																		*
  * 																 	 Examens                                                                                          *
  * 																				                                                  																					*
  **************************************************************************************************************************************/

  /**
  * Page principale Gestion des Examens
  * @return Response
  */
  public function getexamens(){
    $semestre=Semestre::SemestreEnCours();
    $examens =Examen::where('code_semestre',$semestre)->paginate(15);

    return view('gestionexamens/examens',['examens'=>$examens]);
  }

  /**
  * Ajouter Examen
  * @return Response
  */
  public function getajouterexamen(){
    $semestre=Semestre::SemestreEnCours();
    $examens =Examen::where('code_semestre',$semestre)->lists('code_module');
    $modouverts= ModulesOuverts::modules_ouverts_semestre_exclure_choix($examens)->get();

    return view('gestionexamens/ajouterexamen',['semestre'=>$semestre,'modouverts'=>$modouverts]);
  }

  /**
  * Enregistrer Examen
  * @return Response
  */
  public function postajouterexamen(){
    $module=Request::input('code');
    $date_pass=Request::input('date_passage');
    $time = strtotime($date_pass);
    $newformat = date('Y-m-d',$time);
    $semestre=Semestre::SemestreEnCours();
    $date = new \DateTime;

    DB::table('examen')->insert(
        ['code_module' => $module, 'code_semestre' => $semestre ,'date_creation' => $date,'utilisateur_creation' => Auth::user()->username ,'date_passage'=> $newformat]
    );

    return redirect('examens');
  }

  /**
  * Modifier Examen
  * @param [string] $code_semestre  concatenation semestre + module
  * @return Response
  */
  public function getModifierExamen($code_semestre)
  {
    $arrexm=explode('_',$code_semestre);
    $semestre =$arrexm[0];
    $mod =$arrexm[1];

    return view('gestionexamens/modifierexamen',['semestre'=>$semestre,'mod'=>$mod]);
  }

  /**
  * Enregistrer Modification Examen
  * @return Response
  */
  public function postModifierExamen()
  {
    $module=Request::input('code');
    $date_pass=Request::input('date_passage');
    $semestre =Request::input('semestre');
    $time = strtotime($date_pass);
    $newformat = date('Y-m-d',$time);

    DB::table('examen')->where('code_semestre',$semestre)->where('code_module',$module)->update(['date_passage'=> $newformat]);

    return redirect('examens');
  }

  /**************************************************************************************************************************************
  * 																																																																		*
  * 																 	 Delais D'inscription aux Examens                                                                 *
  * 																				                                                  																					*
  **************************************************************************************************************************************/

  /**
  * Page principale Gestion des Delais d'inscription aux examens.
  * Cette page permet permet de fixer les dates limites d'inscription aux examens.
  * @return Response
  */
  public function getExamensDelaisInscription(){
    $examensdelais =ExamenDelaisInscription::paginate(15);
    return view('gestionexamens/examensdelaisinscription',['examensdelais'=>$examensdelais]);
  }
  /**
  * Ajouter Delai d'inscription aux examens.
  * @return Response
  */
  public function getAjouterExamensDelaisInscription(){
    $allsemestres = Semestre::lists('code_semestre','code_semestre');
    return view('gestionexamens/ajouterexamensdelaisinscription',['allsemestres'=>$allsemestres]);
  }
  /**
  * Enregistrer Delai d'inscription aux examens.
  * @return Response
  */
  public function postajouterExamensDelaisInscription(){
    $semestre=Request::input('semestre');
    $date_debut=Request::input('date_debut');
    $date_fin=Request::input('date_fin');

    $time = strtotime($date_debut);
    $date_debut_inscription = date('Y-m-d',$time);

    $time2 = strtotime($date_fin);
    $date_fin_inscription = date('Y-m-d',$time2);

    $examendelais = new ExamenDelaisInscription;
    $examendelais->code_semestre= $semestre;
    $examendelais->date_debut_inscription = $date_debut_inscription;
    $examendelais->date_fin_inscription = $date_fin_inscription;
    $examendelais->save();

    return redirect('examensDelaisInscription');
  }
  /**
   * Modifier Delai d'inscription aux examens.
   * @param  [string]  $code_semestre code semestre
   * @return Response
   */
  public function getModifierExamensDelaisInscription($code_semestre){
    $allsemestres = Semestre::lists('code_semestre','code_semestre');
    $examendelais = ExamenDelaisInscription::where('code_semestre',$code_semestre)->firstOrFail();
    $semestre= $examendelais->code_semestre;
    $date = new DateTime($examendelais->date_debut_inscription);
    $date_debut = $date->format('d-m-Y');
    $date2 = new DateTime($examendelais->date_fin_inscription);
    $date_fin = $date2->format('d-m-Y');

    return view('gestionexamens/modifierexamensdelaisinscription',['allsemestres'=>$allsemestres,'semestre'=>$semestre,'date_debut'=>$date_debut,'date_fin'=>$date_fin]);
  }
  /**
  * Enregistrer Modification Delai d'inscription aux examens.
  * @return Response
  */
  public function postModifierExamensDelaisInscription(){
    $semestre=Request::input('semestre');
    $date_debut=Request::input('date_debut');
    $date_fin=Request::input('date_fin');

    $time = strtotime($date_debut);
    $date_debut_inscription = date('Y-m-d',$time);

    $time2 = strtotime($date_fin);
    $date_fin_inscription = date('Y-m-d',$time2);

    $examendelais = ExamenDelaisInscription::where('code_semestre',$semestre)->firstOrFail();
    $examendelais->date_debut_inscription = $date_debut_inscription;
    $examendelais->date_fin_inscription = $date_fin_inscription;
    $examendelais->save();

    return redirect('examensDelaisInscription');
  }

  /**************************************************************************************************************************************
  * 																																																																		*
  * 																 	 Inscription aux Examens                                                                          *
  * 																				                                                  																					*
  **************************************************************************************************************************************/

  /**
  * Page Principale: Faire Inscription aux Examens
  * @return Response
  */
  public function getinscriptionexamen(){

    $semestre=Semestre::SemestreEnCours();
    $idetu = Etudiant::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail()->getIdEtudiant();
    $etuexamens = EtudiantExamens::where('id_etudiant',$idetu)->where('code_semestre',$semestre)->paginate(15);
    $existe_periode_inscription = ExamenDelaisInscription::where('code_semestre',$semestre)->get();
    $message='';

    if(!$existe_periode_inscription->isEmpty())
    {
      $periode_inscription_actif =true;
      $examendelaisinscription= ExamenDelaisInscription::where('code_semestre',$semestre)->whereRaw("( NOW() between `date_debut_inscription` and `date_fin_inscription`)")->get();
      if(!$examendelaisinscription->isEmpty())
      {
        $periode_inscription_valide =true;
        $message ="Periode d'inscription valide. Veuillez inscrire vos choix d'examens à passer.";
      }
      else
      {
        $periode_inscription_valide =false;
        $message ="Désolé, vous n'etes pas dans une periode d'inscription valide. Il est possible aussi que le delais accordé pour la saisie de vos choix pour le semestre en cours est fini.";
      }
    }
    else
    {   $periode_inscription_actif =false;
        $periode_inscription_valide =false;
        $message ="Désolé, il n'existe pas une periode inscription ouverte aux examens pour le semestre en cours.";
    }

    return view('gestionexamens/inscriptionExamens',['etuexamens'=>$etuexamens,'periode_inscription_actif'=>$periode_inscription_actif,'periode_inscription_valide'=>$periode_inscription_valide,'message'=>$message]);
  }

  /**
  * Faire Inscription aux Examens
  * @return Response
  */
  public function getfaireInscriptionExamen(){

    $semestre=Semestre::SemestreEnCours();
    $examens =Examen::where('code_semestre',$semestre)->get();
    $centres = Centre::lists('nom_centre','nom_centre') + array(' ' => 'Autre');
    $choixs=NULL;

    return view('gestionexamens/faireInscriptionExamen',['choixs' => $choixs,'examens' => $examens,'centres'=>$centres]);
  }

  /**
  * Enregistrer choix d'inscription aux examens.
  * @return Response
  */
  public function postfaireInscriptionExamen(){
    try
    {
      $choixexamen=trim(Request::input('post_content'));
      $centre_tmp=trim(Request::input('centre'));
      $autre_centre_tmp=trim(Request::input('autre_centre'));

      if(!empty($centre_tmp))
      {
        $nom_centre =$centre_tmp;
        $autre_centre =0;
      }
      else
      {
        $nom_centre =$autre_centre_tmp;
        $autre_centre =1;
      }
      $arrchoix=explode(',', $choixexamen);
      array_pop($arrchoix);

      $semestre=Semestre::SemestreEnCours();
      $idetu = Etudiant::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail()->getIdEtudiant();
      $date = date('Y-m-d H:i:s');

      foreach ($arrchoix as $choix)
      {
          DB::table('etudiant_examens')->insert(
            array('id_etudiant' => $idetu, 'code_semestre' => $semestre,'code_module'=>trim($choix),'date_inscription_examen'=>$date,'nom_centre'=>$nom_centre,'autre_centre'=>$autre_centre)
        );
      }
        return redirect('inscriptionExamens')->with('success', "L'enregistrement de vos choix a été effectué avec succès.");
    }
    catch(Exception $ex)
    {
        return redirect('inscriptionExamens')->with('error', "Une erreur s'est produite lors de l'enregistement de vos choix. Veuillez reessayer à nouveau.");
    }
  }

  /**
  * Modifier inscription aux examens.
  * @return Response
  */
  public function getmodifierInscriptionExamen(){

    $semestre=Semestre::SemestreEnCours();
    $idetu = Etudiant::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail()->getIdEtudiant();
    $choixs = EtudiantExamens::where('id_etudiant',$idetu)->where('code_semestre',$semestre)->get();
    $arr_choixs =EtudiantExamens::where('id_etudiant',$idetu)->where('code_semestre',$semestre)->lists('code_module');
    $centres = Centre::lists('nom_centre','nom_centre') + array(' ' => 'Autre');
    $centre = head(EtudiantExamens::where('id_etudiant',$idetu)->where('code_semestre',$semestre)->groupBy('nom_centre')->lists('nom_centre'));
    $autre_centre = head(EtudiantExamens::where('id_etudiant',$idetu)->where('code_semestre',$semestre)->groupBy('autre_centre')->lists('autre_centre'));
    $examens =Examen::examens_exclure_choix($arr_choixs)->get();

    return view('gestionexamens/modifierInscriptionExamen',['choixs' => $choixs,'examens' => $examens,'centres'=>$centres,'centre'=>$centre,'autre_centre'=>$autre_centre]);
  }

  /**
  * Enregistrer Modification choix d'inscription aux examens.
  * @return Response
  */
  public function postmodifierInscriptionExamen(){
    try
    {
      $choixexamen=trim(Request::input('post_content'));
      $centre_tmp=trim(Request::input('centre'));
      $autre_centre_tmp=trim(Request::input('autre_centre'));

      if(!empty($centre_tmp))
      {
        $nom_centre =$centre_tmp;
        $autre_centre =0;
      }
      else
      {
        $nom_centre =$autre_centre_tmp;
        $autre_centre =1;
      }
      $arrchoix=explode(',', $choixexamen);
      array_pop($arrchoix);

      $semestre=Semestre::SemestreEnCours();
      $idetu = Etudiant::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail()->getIdEtudiant();
      $date = date('Y-m-d H:i:s');

      DB::table('etudiant_examens')->where('id_etudiant',$idetu)->where('code_semestre',$semestre)->delete();

      foreach ($arrchoix as $choix)
      {
          DB::table('etudiant_examens')->insert(
            array('id_etudiant' => $idetu, 'code_semestre' => $semestre,'code_module'=>trim($choix),'date_inscription_examen'=>$date,'nom_centre'=>$nom_centre,'autre_centre'=>$autre_centre)
        );
      }
        return redirect('inscriptionExamens')->with('success', "L'enregistrement de vos choix a été effectué avec succès.");
    }
    catch(Exception $ex)
    {
        return redirect('inscriptionExamens')->with('error', "Une erreur s'est produite lors de l'enregistement de vos choix. Veuillez reessayer à nouveau.");
    }
  }

  /**************************************************************************************************************************************
  * 																																																																		*
  * 																 	 Inscrits aux Examens                                                                             *
  * 																				                                                  																					*
  **************************************************************************************************************************************/

  /**
  * Page Principale: Inscrits aux Examens - Liste d'Inscrits aux Examens
  * @return Response
  */
  public function getinscritsExamens(){

    if(Auth::user()->Role->nom_role =="RESP")
		{
        $resp = Responsable::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
        $idresp=$resp->id_responsable;

        if($resp->type_responsable =="Module")
        {
          $semestre=Semestre::SemestreEnCours();
          $is_responsable_module= 1;
          $examens = EtudiantExamens::getinscritsExamens($semestre,$idresp,$is_responsable_module,null,null)->paginate(15);

          $centres = null;
          $allmodules = null;
        }
        else
        {
          $semestre=Semestre::SemestreEnCours();
          $examens = EtudiantExamens::getinscritsExamens($semestre,null,null,null,null)->paginate(15);
          $centres = Centre::all();
          $allmodules = Module::all();
        }
    }
    else
    {
        $semestre=Semestre::SemestreEnCours();
        $examens = EtudiantExamens::getinscritsExamens($semestre,null,null,null,null)->paginate(15);
        $centres = Centre::all();
        $allmodules = Module::all();
    }

    $mod=null;
    $ctr=null;

    return view('gestionexamens/inscritsExamens',['examens' =>$examens,'centres'=>$centres,'allmodules'=>$allmodules,'mod'=>$mod,'ctr'=>$ctr]);
  }

  /**
  * Filtrer liste des inscris aux examens. Deux options de filtrage sont possibles: par module et par centre de passage des examens.
  * @return Response
  */
  public function postinscritsExamens(){

    $module=Request::input('module');
    $centre=Request::input('centre');

    if($module == 'ALL')
    {
      $md=null;
    }
    else
    {
      $md=$module;
    }

    if($centre == 'ALL')
    {
      $ctr=null;
    }
    else
    {
      $ctr=$centre;
    }

    $semestre=Semestre::SemestreEnCours();
    $examens = EtudiantExamens::getinscritsExamens($semestre,null,null,$ctr,$md)->paginate(15);
    $centres = Centre::all();
    $allmodules = Module::all();

    return view('gestionexamens/inscritsExamens',['examens' =>$examens,'centres'=>$centres,'allmodules'=>$allmodules,'mod'=>$module,'ctr'=>$centre]);
  }

  /**
   * Exporter liste d'inscrits aux examens en fonction des paramètres de filtrage choisis.
   * @return .xlsx file
   */
  public function inscrits_examens_exporter_excel()
  {
      $semestre=Semestre::SemestreEnCours();
      $spreadsheet_name = 'Inscrits_Examens'.'_'.$semestre;
      Excel::create($spreadsheet_name, function($excel) {

      $excel->sheet('Inscrits_Examens', function($sheet)
      {
            $module=Request::input('module_export');
            $centre=Request::input('centre_export');
            if($module == 'ALL')
            {$md=null;}
            else
            {$md=$module;}

            if($centre == 'ALL')
            {$ctr=null;}
            else
            {$ctr=$centre;}

            $semestre=Semestre::SemestreEnCours();

            if(Auth::user()->Role->nom_role =="RESP")
            {
                $resp = Responsable::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
                $idresp=$resp->id_responsable;

                if($resp->type_responsable =="Module")
                { $is_responsable_module= 1;
                  $examens = EtudiantExamens::getinscritsExamens($semestre,$idresp,$is_responsable_module,null,null);
                }
                else
                { $examens = EtudiantExamens::getinscritsExamens($semestre,null,null,$ctr,$md);}
            }
            else
            {  $examens = EtudiantExamens::getinscritsExamens($semestre,null,null,$ctr,$md);}

             $inscrits = $examens->select('code_semestre','code_module','etudiant.nom_etudiant','etudiant.prenom_etudiant','etudiant.email','etudiant_examens.date_inscription_examen','etudiant_examens.nom_centre')->get();
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

  /**************************************************************************************************************************************
  * 																																																																		*
  * 																 	 Notes Examens                                                                                    *
  * 																				                                                  																					*
  **************************************************************************************************************************************/

  /**
  * Page Principale: Consultation de Notes d'Examen
  * @return Response
  */
  public function getconsultationNotesExamens(){

    $semestre=Semestre::SemestreEnCours();
    $can_edit =0;

    if(Auth::user()->Role->nom_role =="RESP")
    {
        $resp = Responsable::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
        $idresp=$resp->id_responsable;

        if($resp->type_responsable =="Module")
        {
          $examens = EtudiantExamens::getconsultationNotesExamens($semestre,null,null,$idresp,1,null,null,null,null)->paginate(15);
          $centres = null;
          $allmodules = null;
          $can_edit =1;
        }
        else
        {
          $examens = EtudiantExamens::getconsultationNotesExamens($semestre,null,null,null,null,null,null,null,null)->paginate(15);
          $centres = Centre::all();
          $allmodules = Module::all();
          $can_edit =1;
        }
    }
    elseif(Auth::user()->Role->nom_role =="TUT")
    {
        $tut = Tuteur::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
        $idtut=$tut->id_tuteur;

        $examens = EtudiantExamens::getconsultationNotesExamens($semestre,null,null,null,null,$idtut,1,null,null)->paginate(15);
        $centres = null;
        $allmodules = null;
    }
    elseif(Auth::user()->Role->nom_role =="ETU")
    {
        $etu = Etudiant::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
        $idetu=$etu->id_etudiant;

        $examens = EtudiantExamens::getconsultationNotesExamens($semestre,$idetu,1,null,null,null,null,null,null)->paginate(15);
        $centres = null;
        $allmodules = null;
    }
    elseif(Auth::user()->Role->nom_role =="ADM")
    {
        $examens = EtudiantExamens::getconsultationNotesExamens($semestre,null,null,null,null,null,null,null,null)->paginate(15);
        $centres = Centre::all();
        $allmodules = Module::all();
        $can_edit =1;
    }

    return view('gestionexamens/consultationNotesExamens',['examens' =>$examens,'centres'=>$centres,'allmodules'=>$allmodules,'can_edit'=>$can_edit]);
  }

  /**
  * Filtrer notes d'examen. Deux options de filtrage sont possibles: par module et par centre de passage des examens.
  * @return Response
  */
  public function postconsultationNotesExamens(){

        $module=Request::input('module');
        $centre=Request::input('centre');
        $can_edit =0;

        if($module == 'ALL')
        {
          $md=null;
        }
        else
        {
          $md=$module;
        }

        if($centre == 'ALL')
        {
          $ctr=null;
        }
        else
        {
          $ctr=$centre;
        }

        if(Auth::user()->Role->nom_role =="ADM" || Auth::user()->Role->nom_role =="RESP")
        {
          $can_edit=1;
        }

        $semestre=Semestre::SemestreEnCours();
        $examens = EtudiantExamens::getconsultationNotesExamens($semestre,null,null,null,null,null,null,$ctr,$md)->paginate(15);
        $centres = Centre::all();
        $allmodules = Module::all();

    return view('gestionexamens/consultationNotesExamens',['examens' =>$examens,'centres'=>$centres,'allmodules'=>$allmodules,'can_edit'=>$can_edit]);
  }

  /**
  * Modifier note d'examen d'un etudiant sur un module.
  * @param $mod concatenation code_module + id_etudiant
  * @return Response
  */
  public function getmodifierNotesExamens($mod)
  {
    $arrnot=explode('_',$mod);
    $code =$arrnot[0];
    $id_etu =$arrnot[1];

    $semestre=Semestre::SemestreEnCours();
    $etuexam =EtudiantExamens::where('id_etudiant',$id_etu)->where('code_semestre',$semestre)->where('code_module',$code)->firstOrFail();
    $note = $etuexam->note_examen;

    return view('gestionexamens/modifierNotesExamens',['code'=>$code,'id_etu'=>$id_etu,'note'=>$note]);
  }

  /**
  * Enregistrer Modification sur la note d'examen d'un etudiant sur un module.
  * @return Response
  */
  public function postmodifierNotesExamens()
  {   try
      {
        $code=Request::input('code');
        $id_etu=Request::input('id_etu');
        $note = Request::input('note');
        $echelle = Request::input('echelle');
        $semestre=Semestre::SemestreEnCours();
        $correcteur = Auth::user()->username;
        $date_correction = new \DateTime;

        DB::table('etudiant_examens')->where('id_etudiant',$id_etu)->where('code_semestre',$semestre)->where('code_module',$code)->update(['note_examen' => $note,'note_examen_sur'=>$echelle,'correcteur_examen'=>$correcteur,'date_correction_examen'=>$date_correction]);

        return redirect('consultationNotesExamens')->with('success', "L'enregistrement de la note a été effectué avec succès.");
      }
      catch(Exception $ex)
      {
        return redirect('consultationNotesExamens')->with('error', "Une erreur s'est produite lors de l'enregistement de la note d'examen. Veuillez reessayer à nouveau.");
      }
  }

  /**
  * Modifier note d'examen après PV d'un etudiant sur un module.
  * @param $mod concatenation code_module + id_etudiant
  * @return Response
  */
  public function getmodifierNotesExamensPV($mod)
  {
    $arrnot=explode('_',$mod);
    $code =$arrnot[0];
    $id_etu =$arrnot[1];

    $semestre=Semestre::SemestreEnCours();
    $etuexam =EtudiantExamens::where('id_etudiant',$id_etu)->where('code_semestre',$semestre)->where('code_module',$code)->firstOrFail();
    $note = $etuexam->note_apres_pv;

    return view('gestionexamens/modifierNotesExamensPV',['code'=>$code,'id_etu'=>$id_etu,'note'=>$note]);
  }

  /**
  * Enregistrer Modification sur la note d'examen après PV d'un etudiant sur un module.
  * @return Response
  */
  public function postmodifierNotesExamensPV()
  {
    try
        {
          $code=Request::input('code');
          $id_etu=Request::input('id_etu');
          $note = Request::input('note');
          $echelle = Request::input('echelle');
          $semestre=Semestre::SemestreEnCours();
          $correcteur = Auth::user()->username;
          $date_correction = new \DateTime;

          DB::table('etudiant_examens')->where('id_etudiant',$id_etu)->where('code_semestre',$semestre)->where('code_module',$code)->update(['note_apres_pv' => $note,'note_examen_sur'=>$echelle,'correcteur_examen'=>$correcteur,'date_correction_examen'=>$date_correction]);

          return redirect('consultationNotesExamens')->with('success', "L'enregistrement de la note après PV a été effectué avec succès.");
        }
        catch(Exception $ex)
        {
          return redirect('consultationNotesExamens')->with('error', "Une erreur s'est produite lors de l'enregistement de la note d'examen après PV. Veuillez reessayer à nouveau.");
        }
  }

/**************************************************************************************************************************************
* 																																																																		*
* 																 	 Copies d'Examens                                                                                 *
* 																				                                                  																					*
**************************************************************************************************************************************/

  /**
  * Page Principale: Consultation de Copies d'Examen
  * @return Response
  */
  public function getcopiesExamens(){
    $semestre=Semestre::SemestreEnCours();
    $can_edit =0;

    if(Auth::user()->Role->nom_role =="RESP")
    {
        $resp = Responsable::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
        $idresp=$resp->id_responsable;

        if($resp->type_responsable =="Module")
        {
          $examens = EtudiantExamens::getconsultationNotesExamens($semestre,null,null,$idresp,1,null,null,null,null)->paginate(15);
          $centres = null;
          $allmodules = null;
          $can_edit =0;
        }
        else
        {
          $examens = EtudiantExamens::getconsultationNotesExamens($semestre,null,null,null,null,null,null,null,null)->paginate(15);
          $centres = Centre::all();
          $allmodules = Module::all();
          $can_edit =1;
        }
    }
    elseif(Auth::user()->Role->nom_role =="ADM")
    {
        $examens = EtudiantExamens::getconsultationNotesExamens($semestre,null,null,null,null,null,null,null,null)->paginate(15);
        $centres = Centre::all();
        $allmodules = Module::all();
        $can_edit =1;
    }

    return view('gestionexamens/copiesExamens',['examens' =>$examens,'centres'=>$centres,'allmodules'=>$allmodules,'can_edit'=>$can_edit]);

  }

  /**
  * Filtrer copies d'examen. Deux options de filtrage sont possibles: par module et par centre de passage des examens.
  * @return Response
  */
  public function postcopiesExamens(){
    $module=Request::input('module');
    $centre=Request::input('centre');
    $can_edit =0;

    if($module == 'ALL')
    {
      $md=null;
    }
    else
    {
      $md=$module;
    }

    if($centre == 'ALL')
    {
      $ctr=null;
    }
    else
    {
      $ctr=$centre;
    }

    if(Auth::user()->Role->nom_role =="ADM" || Auth::user()->Role->nom_role =="RESP")
    {
      $can_edit=1;
    }

    $semestre=Semestre::SemestreEnCours();
    $examens = EtudiantExamens::getconsultationNotesExamens($semestre,null,null,null,null,null,null,$ctr,$md)->paginate(15);
    $centres = Centre::all();
    $allmodules = Module::all();

    return view('gestionexamens/copiesExamens',['examens' =>$examens,'centres'=>$centres,'allmodules'=>$allmodules,'can_edit'=>$can_edit]);

  }

  /**
   * Telecharger copie d'examen
   * @param  [string] $rqfile nom de la copie d'examen à telecharger
   * @return [file] copie d'examen
   */
  public function getcopiesExamensContenu($rqfile){
    //File is stored under project/public/resources/copies_examen
    $file= public_path()."/resources/copies_examen/". $rqfile ;
    return Response::download($file,$rqfile);
  }

  /**
  * Ajouter Copie d'Examen
  * @return Response
  */
  public function postcopiesExamensajout(){
    try
    {
      $semestre=Semestre::SemestreEnCours();
      $code=trim(Request::input('code_module'));
      $idetu=trim(Request::input('idetu'));
      $file = Request::file('filefield');

      Storage::disk('copies_examen')->put($file->getClientOriginalName(),File::get($file));

      DB::table('etudiant_examens')->where('id_etudiant',$idetu)->where('code_semestre',$semestre)->where('code_module',$code)->update(['copie_examen' => $file->getClientOriginalName()]);

      return redirect('copiesExamens')->with('success', "L'enregistrement de la copie d'examen a été effectué avec succès.");
    }
    catch(Exception $ex)
    {
      return redirect('copiesExamens')->with('error', "Une erreur s'est produite lors de l'enregistement de la copie d'examen. Veuillez reessayer à nouveau.");
    }
  }

  /**
  * Modifier Copie d'Examen
  * @return Response
  */
  public function postcopiesExamensmodification(){
    try
    {
      $semestre=Semestre::SemestreEnCours();
      $code=trim(Request::input('code_module'));
      $idetu=trim(Request::input('idetu'));
      $file = Request::file('filefield');
      $examens = EtudiantExamens::getconsultationNotesExamens($semestre,$idetu,1,null,null,null,null,null,$code)->first();
      Storage::disk('copies_examen')->delete($examens->copie_examen);
      Storage::disk('copies_examen')->put($file->getClientOriginalName(),File::get($file));
      DB::table('etudiant_examens')->where('id_etudiant',$idetu)->where('code_semestre',$semestre)->where('code_module',$code)->update(['copie_examen' => $file->getClientOriginalName()]);

      return redirect('copiesExamens')->with('success', "La modification de la copie d'examen a été effectué avec succès.");
    }
    catch(Exception $ex)
    {
      return redirect('copiesExamens')->with('error', "Une erreur s'est produite lors de la modification de la copie d'examen. Veuillez reessayer à nouveau.");
    }
  }

  /**
  * Supprimer Copie d'Examen
  * @return Response
  */
  public function postcopiesExamenssuppresion(){
    try
    {
      $semestre=Semestre::SemestreEnCours();
      $code=trim(Request::input('code_module'));
      $idetu=trim(Request::input('idetu'));
      $examens = EtudiantExamens::getconsultationNotesExamens($semestre,$idetu,1,null,null,null,null,null,$code)->first();
      Storage::disk('copies_examen')->delete($examens->copie_examen);
      DB::table('etudiant_examens')->where('id_etudiant',$idetu)->where('code_semestre',$semestre)->where('code_module',$code)->update(['copie_examen' => null]);

      return redirect('copiesExamens')->with('success', "La suppresion de la copie d'examen a été effectué avec succès.");
    }
    catch(Exception $ex)
    {
      return redirect('copiesExamens')->with('error', "Une erreur s'est produite lors de la suppresion de la copie d'examen. Veuillez reessayer à nouveau.");
    }
  }

/**************************************************************************************************************************************
* 																																																																		*
* 																 	 Calendrier d'Examens                                                                             *
* 																				                                                  																					*
**************************************************************************************************************************************/

  /**
  * Page Principale: Calendrier d'Examens
  * @return Response
  */
  public function getcalendrierExamens(){
      $semestre=Semestre::SemestreEnCours();
      $tmp_backup = substr($semestre,0,-2);
      $tmp_backup2 =($tmp_backup.'-'.'01'.'-'.'01');
      $backup_min_date= date('Y-m-d',strtotime($tmp_backup2));
      $examen_min_date = Examen::where('code_semestre',$semestre)->min('date_passage');
      return view('gestionexamens/calendrierExamens',['examen_min_date' =>$examen_min_date,'backup_min_date'=>$backup_min_date]);
  }

  /**
  * Liste d'examens avec leur date de passage correspondante.Ces evennements seront placés sur le calendrier d'examen.
  * @return [Array] JSON
  */
  public function getcalendrierExamensEvents(){
      $semestre=Semestre::SemestreEnCours();

      if(Auth::user()->Role->nom_role =="RESP")
      {   $resp = Responsable::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
          $idresp=$resp->id_responsable;
          if($resp->type_responsable =="Module")
          { $examens =Examen::getExamenEvents($semestre,null,null,$idresp,1,null,null);}
          else
          { $examens =Examen::getExamenEvents($semestre,null,null,null,null,null,null);}
      }
      elseif(Auth::user()->Role->nom_role =="TUT")
      {   $tut = Tuteur::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
          $idtut=$tut->id_tuteur;
          $examens =Examen::getExamenEvents($semestre,null,null,null,null,$idtut,1);}
      elseif(Auth::user()->Role->nom_role =="ETU")
      {   $etu = Etudiant::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
          $idetu=$etu->id_etudiant;
          $examens =Examen::getExamenEvents($semestre,$idetu,1,null,null,null,null);}
      else
      {   $examens =Examen::getExamenEvents($semestre,null,null,null,null,null,null);
      }

      return Response::json($examens);
  }

}
