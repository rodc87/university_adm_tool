<?php namespace Emiage\Http\Controllers;
use Auth;

use Emiage\Semestre;
use Emiage\Centre;
use Emiage\Etudiant;
use Emiage\EtudiantCentre;
use Emiage\Administrateur;
use Emiage\Personnel;
use Emiage\PersonnelCentre;
use Emiage\Responsable;
use Emiage\ResponsableCentre;
use Emiage\Tuteur;
use Emiage\TuteurCentre;
use Emiage\User;
use Emiage\User_Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use DB;
use Hash;

class GestionUtilisateursController extends Controller {

	/**************************************************************************************************************************************
	* 																																																																		*
	* 																 	Gestion Compte Utilisateur                                                                        *
	* 																				                                                  																					*
	**************************************************************************************************************************************/

	/**
  * Page compte Utilisateur. Les informations correspondantes au compte seront presentées.
  * @return Response
  */
	public function getcompte()
	{

		if(Auth::user()->Role->nom_role =="ADM")
		{	$user = Administrateur::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
		}
		elseif(Auth::user()->Role->nom_role =="ETU")
		{	$user = Etudiant::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
		}
		elseif(Auth::user()->Role->nom_role =="RESP")
		{
			$user = Responsable::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
		}
		elseif(Auth::user()->Role->nom_role =="TUT")
		{
			$user = Tuteur::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
		}
		elseif(Auth::user()->Role->nom_role =="SCOL")
		{
			$user = Personnel::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
		}
		elseif(Auth::user()->Role->nom_role =="PERS")
		{
			$user = Personnel::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
		}
		else
		{
			$user =null;
		}

	    return view('gestionutilisateurs/moncompte',['user' => $user]);
	}

	/**
  * Modifier les informations du compte utilisateur.
  * @return Response
  */
	public function postcompte()
	{
		//Information utilisateur
		$nom_utilisateur=Request::input('nom_utilisateur');
		$prenom_utilisateur=Request::input('prenom_utilisateur');
		$email=Request::input('email');
		$telephone=Request::input('telephone');
		$addresse_postale=Request::input('addresse_postale');
		//Modification Mot de Passe Utilisateur
		$password=Request::input('password');

		if(!empty($password))
		{
			$pwd_hash = Hash::make($password);
			$utilisateur_pwd= User::find(Auth::user()->getAuthIdentifier());
			$utilisateur_pwd->password = $pwd_hash;
			$utilisateur_pwd->save();
		}

		if(Auth::user()->Role->nom_role =="ADM")
		{	$user = Administrateur::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
			$user->nom_admin=$nom_utilisateur;
			$user->prenom_admin=$prenom_utilisateur;
			$user->email=$email;
			$user->telephone=$telephone;
			$user->addresse_postale=$addresse_postale;
			$user->save();
			$user = Administrateur::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
		}
		elseif(Auth::user()->Role->nom_role =="ETU")
		{	$user = Etudiant::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
			$user->nom_etudiant=$nom_utilisateur;
			$user->prenom_etudiant=$prenom_utilisateur;
			$user->email=$email;
			$user->telephone=$telephone;
			$user->addresse_postale=$addresse_postale;
			$user->save();
			$user = Etudiant::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
		}
		elseif(Auth::user()->Role->nom_role =="RESP")
		{
			$user = Responsable::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
			$user->nom_responsable=$nom_utilisateur;
			$user->prenom_responsable=$prenom_utilisateur;
			$user->email=$email;
			$user->telephone=$telephone;
			$user->addresse_postale=$addresse_postale;
			$user->save();
			$user = Responsable::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
		}
		elseif(Auth::user()->Role->nom_role =="TUT")
		{
			$user = Tuteur::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
			$user->nom_tuteur=$nom_utilisateur;
			$user->prenom_tuteur=$prenom_utilisateur;
			$user->email=$email;
			$user->telephone=$telephone;
			$user->addresse_postale=$addresse_postale;
			$user->save();
			$user = Tuteur::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
		}
		elseif(Auth::user()->Role->nom_role =="SCOL")
		{
			$user = Personnel::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
			$user->nom_personnel=$nom_utilisateur;
			$user->prenom_personnel=$prenom_utilisateur;
			$user->email=$email;
			$user->telephone=$telephone;
			$user->addresse_postale=$addresse_postale;
			$user->save();
			$user = Personnel::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
		}
		elseif(Auth::user()->Role->nom_role =="PERS")
		{
			$user = Personnel::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
			$user->nom_personnel=$nom_utilisateur;
			$user->prenom_personnel=$prenom_utilisateur;
			$user->email=$email;
			$user->telephone=$telephone;
			$user->addresse_postale=$addresse_postale;
			$user->save();
			$user = Personnel::where('id_utilisateur',Auth::user()->getAuthIdentifier())->firstOrFail();
		}
		else
		{
			$user =null;
		}

		return view('gestionutilisateurs/moncompte',['user' => $user]);
	}

	/**************************************************************************************************************************************
	* 																																																																		*
	* 																 	Gestion des Utilisateurs                                                                       		*
	* 																				                                                  																					*
	**************************************************************************************************************************************/

	/**
	* Page principale Gestion Utilisateurs
	* @return Response
	*/
	public function getutilisateurs()
	{
		$allusernames = User::orderBy('username')->get();
		$allroles = User_Role::orderBy('nom_role')->get();
		$utilisateurs = User::getutilisateurs(null,null)->paginate(15);
		return view('gestionutilisateurs/utilisateurs',['utilisateurs' => $utilisateurs,'allusernames'=>$allusernames,'allroles'=>$allroles]);
	}

	/**
	* Filtrer liste d'utilisateurs. Deux options de filtrage sont possibles: par role et par nom utilisateur.
	* @return Response
	*/
	public function postutilisateurs()
	{

	  $role =Request::input('role');
		$username =Request::input('username');

		//Check POST parameters
		if($role == 'ALL')
		{
			$rl=null;
		}
		else
		{
			$rl=$role;
		}

		if($username == 'ALL')
		{
			$usr=null;
		}
		else
		{
			$usr=$username;
		}

		$allusernames = User::orderBy('username')->get();
		$allroles = User_Role::orderBy('nom_role')->get();
		$utilisateurs = User::getutilisateurs($rl,$usr)->paginate(15);
		return view('gestionutilisateurs/utilisateurs',['utilisateurs' => $utilisateurs,'allusernames'=>$allusernames,'allroles'=>$allroles]);
	}

	/**
  * Ajouter Utilisateur
  * @return Response
  */
	public function getajouterutilisateur(){

		$roles = User_Role::all();
		$centres = Centre::lists('nom_centre','id_centre');
		return view('gestionutilisateurs/ajouterUtilisateur',['roles' => $roles,'centres'=>$centres]);
	}

	/**
  * Enregistrer Utilisateur
  * @return Response
  */
	public function postajouterutilisateur(){

		//Role Utilisateur
		$role=Request::input('roles');
		$id_role= User_Role::where('nom_role',$role)->firstOrFail()->id_role;
		//Information utilisateur
		$nom_utilisateur=Request::input('nom_utilisateur');
		$prenom_utilisateur=Request::input('prenom_utilisateur');
		$email=Request::input('email');
		$telephone=Request::input('telephone');
		$addresse_postale=Request::input('addresse_postale');
		$niveau_etudes=Request::input('niveau_etudes');
		$type_responsable=Request::input('type_responsable');
		//Etat Utilisateur
		$status=Request::input('status');
		//Centre Utilisateur
		$centre=Request::input('centre');
		//Identifiants Site
		$username=Request::input('nomaccessutilisateur');
		$password=Request::input('password');
		$pwd_hash = Hash::make($password);

		//Create General Acces User
		$date = new \DateTime;
		$usr = new User;
		$usr->username =$username;
		$usr->password=$pwd_hash;
		$usr->status='ENA';
		$usr->last_update=$date;
		$usr->user_update=Auth::user()->username;
		$usr->id_role=$id_role;
		$usr->save();
		//Retrieve Inserted Id
		$insertedId = $usr->id_user;

		//Create Specific Type of User
		if($role == "ADM")
		{	$user = new Administrateur;
			$user->id_utilisateur=$insertedId;
			$user->nom_admin=$nom_utilisateur;
			$user->prenom_admin=$prenom_utilisateur;
			$user->email=$email;
			$user->telephone=$telephone;
			$user->addresse_postale=$addresse_postale;
			$user->date_entree=$date;
			$user->save();
		}
		elseif($role =="ETU")
		{	$user = new Etudiant;
			$user->id_utilisateur=$insertedId;
			$user->nom_etudiant=$nom_utilisateur;
			$user->prenom_etudiant=$prenom_utilisateur;
			$user->email=$email;
			$user->telephone=$telephone;
			$user->addresse_postale=$addresse_postale;
			$user->niveau_etudes=$niveau_etudes;
			$user->date_entree=$date;
			$user->save();

			//Retrieve Inserted Id
			$insertedId = $user->id_etudiant;

			//Insert Etudiant Centre
	    DB::table('etudiant_centre')->insert(
	      array('id_etudiant' => $insertedId, 'id_centre' => $centre)
	    );

		}
		elseif($role =="RESP")
		{
			$user = new Responsable;
			$user->id_utilisateur=$insertedId;
			$user->nom_responsable=$nom_utilisateur;
			$user->prenom_responsable=$prenom_utilisateur;
			$user->email=$email;
			$user->telephone=$telephone;
			$user->addresse_postale=$addresse_postale;
			$user->type_responsable=$type_responsable;
			$user->date_entree=$date;
			$user->save();

			//Retrieve Inserted Id
			$insertedId = $user->id_responsable;

			//Insert Responsable Centre
	    DB::table('responsable_centre')->insert(
	      array('id_responsable' => $insertedId, 'id_centre' => $centre)
	    );
		}
		elseif($role =="TUT")
		{
			$user = new Tuteur;
			$user->id_utilisateur=$insertedId;
			$user->nom_tuteur=$nom_utilisateur;
			$user->prenom_tuteur=$prenom_utilisateur;
			$user->email=$email;
			$user->telephone=$telephone;
			$user->addresse_postale=$addresse_postale;
			$user->date_entree=$date;
			$user->save();

			//Retrieve Inserted Id
			$insertedId = $user->id_tuteur;

			//Insert Tuteur Centre
	    DB::table('tuteur_centre')->insert(
	      array('id_tuteur' => $insertedId, 'id_centre' => $centre)
	    );
		}
		elseif($role =="SCOL")
		{
			$user = new Personnel;
			$user->id_utilisateur=$insertedId;
			$user->nom_personnel=$nom_utilisateur;
			$user->prenom_personnel=$prenom_utilisateur;
			$user->email=$email;
			$user->telephone=$telephone;
			$user->addresse_postale=$addresse_postale;
			$user->date_entree=$date;
			$user->save();

			//Retrieve Inserted Id
			$insertedId = $user->id_personnel;

			//Insert Tuteur Centre
			DB::table('personnel_centre')->insert(
				array('id_personnel' => $insertedId, 'id_centre' => $centre)
			);

		}
		elseif($role =="PERS")
		{
			$user = new Personnel;
			$user->id_utilisateur=$insertedId;
			$user->nom_personnel=$nom_utilisateur;
			$user->prenom_personnel=$prenom_utilisateur;
			$user->email=$email;
			$user->telephone=$telephone;
			$user->addresse_postale=$addresse_postale;
			$user->date_entree=$date;
			$user->save();

			//Retrieve Inserted Id
			$insertedId = $user->id_personnel;

			//Insert Tuteur Centre
			DB::table('personnel_centre')->insert(
				array('id_personnel' => $insertedId, 'id_centre' => $centre)
			);
		}
		else
		{
			$user =null;
		}

		return redirect('utilisateurs');
	}

	/**
  * Modifier utilisateur
  * @param [int] $iduser id_utilisateur
  * @return Response
  */
	public function getmodifierutilisateur($idusr){

		$centres = Centre::lists('nom_centre','id_centre');
		$usr = User::where('id_user',$idusr)->firstOrFail();
		$idgeneraluser = $usr->id_user;
		$role=$usr->Role->nom_role;
		$status = $usr->status;

		if($role =="ADM")
		{	$user = Administrateur::where('id_utilisateur',$usr->getAuthIdentifier())->firstOrFail();
			$idspecificuser = $user->id_admin;
			$centre =null;
		}
		elseif($role =="ETU")
		{	$user = Etudiant::where('id_utilisateur',$usr->getAuthIdentifier())->firstOrFail();
			$idspecificuser = $user->id_etudiant;
			$centre = EtudiantCentre::where('id_etudiant',$idspecificuser)->lists('id_centre');
		}
		elseif($role =="RESP")
		{
			$user = Responsable::where('id_utilisateur',$usr->getAuthIdentifier())->firstOrFail();
			$idspecificuser = $user->id_responsable;
			$centre = ResponsableCentre::where('id_responsable',$idspecificuser)->lists('id_centre');
		}
		elseif($role =="TUT")
		{
			$user = Tuteur::where('id_utilisateur',$usr->getAuthIdentifier())->firstOrFail();
			$idspecificuser = $user->id_tuteur;
			$centre = TuteurCentre::where('id_tuteur',$idspecificuser)->lists('id_centre');
		}
		elseif($role =="SCOL")
		{
			$user = Personnel::where('id_utilisateur',$usr->getAuthIdentifier())->firstOrFail();
			$idspecificuser = $user->id_personnel;
			$centre = PersonnelCentre::where('id_personnel',$idspecificuser)->lists('id_centre');
		}
		elseif($role =="PERS")
		{
			$user = Personnel::where('id_utilisateur',$usr->getAuthIdentifier())->firstOrFail();
			$idspecificuser = $user->id_personnel;
			$centre = PersonnelCentre::where('id_personnel',$idspecificuser)->lists('id_centre');
		}
		else
		{
			$user =null;
			$centre =null;
		}

		return view('gestionutilisateurs/modifierUtilisateur',['user' => $user,'usr' => $usr,'idgeneraluser' => $idgeneraluser,'idspecificuser' => $idspecificuser,'role' =>$role,'centres'=>$centres,'centre'=>$centre,'status'=>$status]);
	}

	/**
  * Enregistrer Modification Utilisateur.
  * @return Response
  */
	public function postmodifierutilisateur(){

		//Ids Utilisateur
		$idgeneraluser=Request::input('idgeneraluser');
		$idspecificuser=Request::input('idspecificuser');
		//Information utilisateur
		$role=Request::input('role');
		$nom_utilisateur=Request::input('nom_utilisateur');
		$prenom_utilisateur=Request::input('prenom_utilisateur');
		$email=Request::input('email');
		$telephone=Request::input('telephone');
		$addresse_postale=Request::input('addresse_postale');
		$niveau_etudes=Request::input('niveau_etudes');
		$type_responsable=Request::input('type_responsable');
		//Etat Utilisateur
		$status=Request::input('status');
		//Centre Utilisateur
		$centre=Request::input('centre');
		//Identifiants Site
		$username=Request::input('nomaccessutilisateur');
		$password=Request::input('password');

		//Modify General User Information
		$usr = User::where('id_user',$idgeneraluser)->firstOrFail();
		$date = new \DateTime;
		if($usr->password == $password)
		{
					$pwd_hash = $password;
		}
		else
		{
					$pwd_hash = Hash::make($password);
		}
		if($status == "on")
		{
			$usr->status= 'ENA';
		}
		else
		{
			$usr->status= 'DIS';
		}
		$usr->username =$username;
		$usr->last_update =$date;
		$usr->password =$pwd_hash;
		$usr->save();

		//Modify Specific Type of User Information
		if($role == "ADM")
		{	$user = Administrateur::where('id_admin',$idspecificuser)->firstOrFail();
			$user->nom_admin=$nom_utilisateur;
			$user->prenom_admin=$prenom_utilisateur;
			$user->email=$email;
			$user->telephone=$telephone;
			$user->addresse_postale=$addresse_postale;
			$user->save();
		}
		elseif($role =="ETU")
		{	$user = Etudiant::where('id_etudiant',$idspecificuser)->firstOrFail();
			$user->nom_etudiant=$nom_utilisateur;
			$user->prenom_etudiant=$prenom_utilisateur;
			$user->email=$email;
			$user->telephone=$telephone;
			$user->addresse_postale=$addresse_postale;
			$user->niveau_etudes=$niveau_etudes;
			$user->save();

			//Retrieve Updated Id
			$updatedId = $user->id_etudiant;
			DB::table('etudiant_centre')->where('id_etudiant',$updatedId)->delete();
			//Insert Etudiant Centre
			DB::table('etudiant_centre')->insert(
				array('id_etudiant' => $updatedId, 'id_centre' => $centre)
			);
		}
		elseif($role =="RESP")
		{
			$user = Responsable::where('id_responsable',$idspecificuser)->firstOrFail();
			$user->nom_responsable=$nom_utilisateur;
			$user->prenom_responsable=$prenom_utilisateur;
			$user->email=$email;
			$user->telephone=$telephone;
			$user->addresse_postale=$addresse_postale;
			$user->type_responsable=$type_responsable;
			$user->save();

			//Retrieve Updated Id
			$updatedId = $user->id_responsable;
			DB::table('responsable_centre')->where('id_responsable',$updatedId)->delete();
			//Insert Etudiant Centre
			DB::table('responsable_centre')->insert(
				array('id_responsable' => $updatedId, 'id_centre' => $centre)
			);
		}
		elseif($role =="TUT")
		{
			$user = Tuteur::where('id_tuteur',$idspecificuser)->firstOrFail();
			$user->nom_tuteur=$nom_utilisateur;
			$user->prenom_tuteur=$prenom_utilisateur;
			$user->email=$email;
			$user->telephone=$telephone;
			$user->addresse_postale=$addresse_postale;
			$user->save();

			//Retrieve Updated Id
			$updatedId = $user->id_tuteur;
			DB::table('tuteur_centre')->where('id_tuteur',$updatedId)->delete();
			//Insert Etudiant Centre
			DB::table('tuteur_centre')->insert(
				array('id_tuteur' => $updatedId, 'id_centre' => $centre)
			);
		}
		elseif($role =="SCOL")
		{
			$user = Personnel::where('id_personnel',$idspecificuser)->firstOrFail();
			$user->nom_personnel=$nom_utilisateur;
			$user->prenom_personnel=$prenom_utilisateur;
			$user->email=$email;
			$user->telephone=$telephone;
			$user->addresse_postale=$addresse_postale;
			$user->save();

			//Retrieve Updated Id
			$updatedId = $user->id_personnel;
			DB::table('personnel_centre')->where('id_personnel',$updatedId)->delete();
			//Insert Etudiant Centre
			DB::table('personnel_centre')->insert(
				array('id_personnel' => $updatedId, 'id_centre' => $centre)
			);
		}
		elseif($role =="PERS")
		{
			$user = Personnel::where('id_personnel',$idspecificuser)->firstOrFail();
			$user->nom_personnel=$nom_utilisateur;
			$user->prenom_personnel=$prenom_utilisateur;
			$user->email=$email;
			$user->telephone=$telephone;
			$user->addresse_postale=$addresse_postale;
			$user->save();

			//Retrieve Updated Id
			$updatedId = $user->id_personnel;
			DB::table('personnel_centre')->where('id_personnel',$updatedId)->delete();
			//Insert Etudiant Centre
			DB::table('personnel_centre')->insert(
				array('id_personnel' => $updatedId, 'id_centre' => $centre)
			);
		}
		else
		{
			$user =null;
		}

		return redirect('utilisateurs');
	}


}
