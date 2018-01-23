<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/***********************LOGIN ROUTES*************************************/
Route::get('/', ['middleware' => 'auth', 'uses' => 'WelcomeController@index']);
Route::post('login','LoginController@index');
Route::get('login',['middleware' => 'auth', 'uses' =>  'LoginController@get']);
/****************HOMEPAGE AND REQUIRED PERMISSION ROUTES****************/
Route::get('home', ['middleware' => ['auth', 'roles'], 'uses' => 'HomeController@index','roles' => ['ADM', 'ETU','RESP','TUT','SCOL','PERS']]);
/**************************Modules*************************************/
Route::get('choixmodulesOuverts', ['middleware' => ['auth', 'roles'], 'uses' => 'ModulesOuvertsController@index','roles' => ['ADM', 'ETU','RESP','TUT','SCOL','PERS']]);
Route::get('choixModules', ['middleware' => ['auth', 'roles'], 'uses' => 'ChoixModulesEtudiantController@index','roles' => ['ADM', 'ETU','RESP','TUT','SCOL','PERS']]);
Route::get('historiqueChoixModules', ['middleware' => ['auth', 'roles'], 'uses' => 'ChoixModulesEtudiantController@historiqueget','roles' => ['ADM', 'ETU','RESP','TUT','SCOL','PERS']]);
Route::post('historiquechoixModules', ['middleware' => ['auth', 'roles'], 'uses' => 'ChoixModulesEtudiantController@historiquepost','roles' => ['ADM', 'ETU','RESP','TUT','SCOL','PERS']]);
Route::get('choisirModules', ['middleware' => ['auth', 'roles'], 'uses' => 'ChoixModulesEtudiantController@choisirget','roles' => ['ADM', 'ETU','RESP','TUT','SCOL','PERS']]);
Route::post('choisirModules', ['middleware' => ['auth', 'roles'], 'uses' => 'ChoixModulesEtudiantController@choisirpost','roles' => ['ADM', 'ETU','RESP','TUT','SCOL','PERS']]);
Route::get('modifierChoixModules', ['middleware' => ['auth', 'roles'], 'uses' => 'ChoixModulesEtudiantController@modifierget','roles' => ['ADM', 'ETU','RESP','TUT','SCOL','PERS']]);
Route::post('modifierChoixModules', ['middleware' => ['auth', 'roles'], 'uses' => 'ChoixModulesEtudiantController@modifierpost','roles' => ['ADM', 'ETU','RESP','TUT','SCOL','PERS']]);
Route::get('inscritsParModule', ['middleware' => ['auth', 'roles'], 'uses' => 'InscritsParModuleController@get','roles' => ['ADM','RESP','TUT','SCOL','PERS']]);
Route::post('inscritsParModule', ['middleware' => ['auth', 'roles'], 'uses' => 'InscritsParModuleController@post','roles' => ['ADM','RESP','TUT','SCOL','PERS']]);
Route::post('inscritsParModuleExport', ['middleware' => ['auth', 'roles'], 'uses' => 'InscritsParModuleController@exporter_excel','roles' => ['ADM','RESP','TUT','SCOL','PERS']]);
/**************************Gestion Utilisateurs****************************/
Route::get('monCompte', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionUtilisateursController@getcompte','roles' => ['ADM', 'ETU','RESP','TUT','SCOL','PERS']]);
Route::post('monCompte', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionUtilisateursController@postcompte','roles' => ['ADM', 'ETU','RESP','TUT','SCOL','PERS']]);
Route::get('utilisateurs', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionUtilisateursController@getutilisateurs','roles' => ['ADM']]);
Route::post('utilisateurs', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionUtilisateursController@postutilisateurs','roles' => ['ADM']]);
Route::get('ajouterUtilisateur', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionUtilisateursController@getajouterutilisateur','roles' => ['ADM']]);
Route::get('modifierUtilisateur/{idusr}', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionUtilisateursController@getmodifierutilisateur','roles' => ['ADM']]);
Route::post('ajouterUtilisateur', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionUtilisateursController@postajouterutilisateur','roles' => ['ADM']]);
Route::post('modifierUtilisateur', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionUtilisateursController@postmodifierutilisateur','roles' => ['ADM']]);
/**************************Gestion Modules********************************/
Route::get('modules', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@getmodules','roles' => ['ADM']]);
Route::post('modules', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@postmodules','roles' => ['ADM']]);
Route::get('modulescontenu/{code}', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@getmodulescontenu','roles' => ['ADM']]);
Route::get('modulescontenuzip/{zip}', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@getmodulescontenuzip','roles' => ['ADM']]);
Route::get('ajouterModule', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@getajoutermodule','roles' => ['ADM']]);
Route::get('ajouterContenuModule', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@getajoutercontenumodule','roles' => ['ADM']]);
Route::get('modifierContenuModule', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@getmodifiercontenumodule','roles' => ['ADM']]);
Route::post('ajouterModule', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@postajoutermodule','roles' => ['ADM']]);
Route::post('ajouterContenuModule', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@postajoutercontenumodule','roles' => ['ADM']]);
Route::post('modifierContenuModule', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@postmodifiercontenumodule','roles' => ['ADM']]);
Route::get('modulesOuverts', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@getmodulesouverts','roles' => ['ADM']]);
Route::get('choisirModulesOuverts', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@getchoisirmodulesouverts','roles' => ['ADM']]);
Route::post('choisirModulesOuverts', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@postchoisirmodulesouverts','roles' => ['ADM']]);
Route::get('modifierModulesOuverts', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@getmodifiermodulesouverts','roles' => ['ADM']]);
Route::post('modifierModulesOuverts', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@postmodifiermodulesouverts','roles' => ['ADM']]);
Route::get('categories', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@getcategories','roles' => ['ADM']]);
Route::get('ajouterCategorie', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@getajoutercategorie','roles' => ['ADM']]);
Route::get('modifierCategorie/{idcategorie}', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@getmodifiercategorie','roles' => ['ADM']]);
Route::post('ajouterCategorie', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@postajoutercategorie','roles' => ['ADM']]);
Route::post('modifierCategorie', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@postmodifiercategorie','roles' => ['ADM']]);
Route::get('responsablesModules', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@getresponsablesmodules','roles' => ['ADM']]);
Route::get('ajouterResponsableModule', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@getajouterresponsablemodule','roles' => ['ADM']]);
Route::post('ajouterResponsableModule', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@postajouterresponsablemodule','roles' => ['ADM']]);
Route::get('modifierResponsableModule/{idmodresp}', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@getmodifierresponsablemodule','roles' => ['ADM']]);
Route::post('modifierResponsableModule', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@postmodifierresponsablemodule','roles' => ['ADM']]);
Route::get('tuteurModules', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@gettuteursmodules','roles' => ['ADM']]);
Route::get('ajouterTuteurModule', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@getajoutertuteurmodule','roles' => ['ADM']]);
Route::post('ajouterTuteurModule', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@postajoutertuteurmodule','roles' => ['ADM']]);
Route::get('modifierTuteurModule/{idmodtut}', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@getmodifiertuteurmodule','roles' => ['ADM']]);
Route::post('modifierTuteurModule', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionModulesController@postmodifiertuteurmodule','roles' => ['ADM']]);
/**************************Gestion Centres**********************************/
Route::get('centres', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionCentresController@getcentres','roles' => ['ADM']]);
Route::get('ajouterCentre', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionCentresController@getajoutercentre','roles' => ['ADM']]);
Route::get('modifierCentre/{idcentre}', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionCentresController@getmodifiercentre','roles' => ['ADM']]);
Route::post('ajouterCentre', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionCentresController@postajoutercentre','roles' => ['ADM']]);
Route::post('modifierCentre', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionCentresController@postmodifiercentre','roles' => ['ADM']]);
/**************************Gestion Semestres********************************/
Route::get('semestres', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionSemestresController@getsemestres','roles' => ['ADM']]);
Route::get('ajouterSemestre', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionSemestresController@getajoutersemestre','roles' => ['ADM']]);
Route::get('modifierSemestre/{idsemestre}', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionSemestresController@getmodifiersemestre','roles' => ['ADM']]);
Route::post('ajouterSemestre', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionSemestresController@postajoutersemestre','roles' => ['ADM']]);
Route::post('modifierSemestre', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionSemestresController@postmodifiersemestre','roles' => ['ADM']]);
/**************************Gestion Devoirs********************************/
Route::get('devoirs', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionDevoirsController@getdevoirs','roles' => ['ADM']]);
Route::post('devoirs', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionDevoirsController@postdevoirs','roles' => ['ADM']]);
Route::get('listedevoirsparmodule', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionDevoirsController@listedevoirsparmodule','roles' => ['ADM']]);
Route::get('devoirscontenu/{rqfile}', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionDevoirsController@devoirscontenu','roles' => ['ADM']]);
Route::get('ajouterDevoir', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionDevoirsController@getajouterdevoir','roles' => ['ADM']]);
Route::post('ajouterDevoir', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionDevoirsController@postajouterdevoir','roles' => ['ADM']]);
Route::get('modifierDevoir', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionDevoirsController@getmodifierdevoir','roles' => ['ADM']]);
Route::post('modifierDevoir', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionDevoirsController@postmodifierdevoir','roles' => ['ADM']]);
/**************************Gestion des Examens***********************************/
Route::get('examens', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@getexamens','roles' => ['ADM','RESP']]);
Route::get('ajouterExamen', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@getajouterexamen','roles' => ['ADM','RESP']]);
Route::post('ajouterExamen', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@postajouterexamen','roles' => ['ADM','RESP']]);
Route::get('modifierExamen/{code_semestre}', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@getModifierExamen','roles' => ['ADM','RESP']]);
Route::post('modifierExamen', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@postModifierExamen','roles' => ['ADM','RESP']]);
Route::get('examensDelaisInscription', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@getExamensDelaisInscription','roles' => ['ADM','RESP']]);
Route::get('ajouterExamensDelaisInscription', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@getAjouterExamensDelaisInscription','roles' => ['ADM','RESP']]);
Route::post('ajouterExamensDelaisInscription', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@postajouterExamensDelaisInscription','roles' => ['ADM','RESP']]);
Route::get('modifierExamensDelaisInscription/{code_semestre}', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@getModifierExamensDelaisInscription','roles' => ['ADM','RESP']]);
Route::post('modifierExamensDelaisInscription', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@postModifierExamensDelaisInscription','roles' => ['ADM','RESP']]);
Route::get('inscriptionExamens', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@getinscriptionexamen','roles' => ['ETU']]);
Route::get('faireInscriptionExamen', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@getfaireInscriptionExamen','roles' => ['ETU']]);
Route::post('faireInscriptionExamen', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@postfaireInscriptionExamen','roles' => ['ETU']]);
Route::get('modifierInscriptionExamen', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@getmodifierInscriptionExamen','roles' => ['ETU']]);
Route::post('modifierInscriptionExamen', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@postmodifierInscriptionExamen','roles' => ['ETU']]);
Route::get('inscritsExamens', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@getinscritsExamens','roles' => ['ADM','RESP']]);
Route::post('inscritsExamens', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@postinscritsExamens','roles' => ['ADM','RESP']]);
Route::post('inscritsExamensExport', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@inscrits_examens_exporter_excel','roles' => ['ADM','RESP']]);
Route::get('consultationNotesExamens', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@getconsultationNotesExamens','roles' => ['ADM','RESP','ETU','TUT']]);
Route::post('consultationNotesExamens', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@postconsultationNotesExamens','roles' => ['ADM','RESP','ETU','TUT']]);
Route::get('modifierNotesExamens/{mod}', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@getmodifierNotesExamens','roles' => ['ADM','RESP']]);
Route::post('modifierNotesExamens', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@postmodifierNotesExamens','roles' => ['ADM','RESP']]);
Route::get('modifierNotesExamensPV/{mod}', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@getmodifierNotesExamensPV','roles' => ['ADM','RESP']]);
Route::post('modifierNotesExamensPV', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@postmodifierNotesExamensPV','roles' => ['ADM','RESP']]);
Route::get('copiesExamens', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@getcopiesExamens','roles' => ['ADM','RESP']]);
Route::post('copiesExamens', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@postcopiesExamens','roles' => ['ADM','RESP']]);
Route::post('copiesExamensajout', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@postcopiesExamensajout','roles' => ['ADM','RESP']]);
Route::post('copiesExamensmodification', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@postcopiesExamensmodification','roles' => ['ADM','RESP']]);
Route::post('copiesExamenssuppresion', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@postcopiesExamenssuppresion','roles' => ['ADM','RESP']]);
Route::get('copiesExamensContenu/{rqfile}', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@getcopiesExamensContenu','roles' => ['ADM','RESP']]);
Route::get('calendrierExamens', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@getcalendrierExamens','roles' => ['ADM', 'ETU','RESP','TUT','SCOL','PERS']]);
Route::get('calendrierExamensEvents', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionExamensController@getcalendrierExamensEvents','roles' => ['ADM', 'ETU','RESP','TUT','SCOL','PERS']]);
/**************************Gestion Docs Consortium********************************/
Route::get('DocsConsortium', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionDocsConsortiumController@getDocsConsortium','roles' => ['ADM']]);
Route::get('listedocsconsortium', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionDocsConsortiumController@getlistedocsconsortium','roles' => ['ADM']]);
Route::get('DocsConsortiumContenu/{rqfile}', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionDocsConsortiumController@getDocsConsortiumContenu','roles' => ['ADM']]);
Route::get('DocsConsortiumAjout', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionDocsConsortiumController@getDocsConsortiumAjout','roles' => ['ADM']]);
Route::post('DocsConsortiumAjout', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionDocsConsortiumController@postDocsConsortiumAjout','roles' => ['ADM']]);
Route::get('DocsConsortiumModification', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionDocsConsortiumController@getDocsConsortiumModification','roles' => ['ADM']]);
Route::post('DocsConsortiumModification', ['middleware' => ['auth', 'roles'], 'uses' => 'GestionDocsConsortiumController@postDocsConsortiumModification','roles' => ['ADM']]);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
/*Event::listen('illuminate.query', function() {
    print_r(func_get_args());
});*/
