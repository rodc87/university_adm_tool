<?php namespace Emiage;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use DB;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'utilisateur';
	protected $primaryKey = 'id_user';
	public 	  $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['username','password'];

	/**
	 * Get Identifiant Utilisateur
	 * @return [int] id_user
	 */
	public function getAuthIdentifier() {
	    return $this->getKey();
	}

	/**
	 * Get Password Utilisateur
	 * @return [string] password
	 */
	  public function getAuthPassword() {
	    return $this->password;    ////////////// password = the columnname of your databasetable for the model
	 }

	 /**
	  * Get Role Utilisateur. Un utilisateur possède un unique role, cette relation permet de récupérer le role correspondant.
	  * @return [User_Role]  Role Utilisateur
	  */
	public function Role()
    {
        return $this->hasOne('Emiage\User_Role','id_role','id_role');
    }

	/**
	 * Fonction permettant de valider si un utilisateur possède un role particulier, defini dans une liste de roles.
	 * @param  [Array]  $roles Liste de Roles
	 * @return boolean
	 */
    public function hasRole($roles)
	{
		$this->have_role = $this->getUserRole();

		// Check if the user is a root account
		if($this->have_role->nom_role == 'ADM') {
			return true;
		}

		if(is_array($roles)){
			foreach($roles as $need_role){
				if($this->checkIfUserHasRole($need_role)) {
					return true;
				}
			}
		} else{
			return $this->checkIfUserHasRole($roles);
		}
		return false;
	}

	/**
	 * Fonction recuperer le role d'un utilisateur.
	 */
	private function getUserRole()
	{
		return $this->Role()->getResults();
	}

	/**
	 * Check si un utilisateur possède un role particulier.
	 */
	private function checkIfUserHasRole($need_role)
	{
		return (strtolower($need_role)==strtolower($this->have_role->nom_role)) ? true : false;
	}

	/**
	 * Get liste d'utilisateurs. Des conditions de filtrage par role et nom utilisateur sont possibles.
	 * @param  [string] $rl  		 nom role
	 * @param  [string] $usr 		nom utilisateur
	 * @return [Array]     		  Liste d'utilisateurs
	 */
	public static function getutilisateurs($rl,$usr)
    {
        $query= DB::table('utilisateur')
        ->select(DB::raw("utilisateur.id_user,utilisateur_role.nom_role,utilisateur.username,utilisateur.last_update,utilisateur.status,
        	CASE nom_role
	        	WHEN 'ADM' THEN administrateur.nom_admin
	        	WHEN 'RESP' THEN responsable.nom_responsable
	        	WHEN 'TUT' THEN tuteur.nom_tuteur
	        	WHEN 'PERS' THEN personnel.nom_personnel
	        	WHEN 'SCOL' THEN personnel.nom_personnel
	        	WHEN 'ETU' THEN etudiant.nom_etudiant
	        	ELSE  ''
        	END AS nom,
        	CASE nom_role
	        	WHEN 'ADM' THEN administrateur.prenom_admin
	        	WHEN 'RESP' THEN responsable.prenom_responsable
	        	WHEN 'TUT' THEN tuteur.prenom_tuteur
	        	WHEN 'PERS' THEN personnel.prenom_personnel
	        	WHEN 'SCOL' THEN personnel.prenom_personnel
	        	WHEN 'ETU' THEN etudiant.prenom_etudiant
	        	ELSE  ''
        	END AS prenom,
        	CASE nom_role
	        	WHEN 'ADM' THEN administrateur.email
	        	WHEN 'RESP' THEN responsable.email
	        	WHEN 'TUT' THEN tuteur.email
	        	WHEN 'PERS' THEN personnel.email
	        	WHEN 'SCOL' THEN personnel.email
	        	WHEN 'ETU' THEN etudiant.email
	        	ELSE  ''
        	END AS email,
        	CASE nom_role
	        	WHEN 'ADM' THEN administrateur.date_entree
	        	WHEN 'RESP' THEN responsable.date_entree
	        	WHEN 'TUT' THEN tuteur.date_entree
	        	WHEN 'PERS' THEN personnel.date_entree
	        	WHEN 'SCOL' THEN personnel.date_entree
	        	WHEN 'ETU' THEN etudiant.date_entree
	        	ELSE  ''
        	END AS date_entree
        	"))
        ->leftjoin('administrateur', 'utilisateur.id_user', '=', 'administrateur.id_utilisateur')
        ->leftjoin('responsable', 'utilisateur.id_user', '=', 'responsable.id_utilisateur')
        ->leftjoin('tuteur', 'utilisateur.id_user', '=', 'tuteur.id_utilisateur')
        ->leftjoin('personnel', 'utilisateur.id_user', '=', 'personnel.id_utilisateur')
				->leftjoin('etudiant', 'utilisateur.id_user', '=', 'etudiant.id_utilisateur')
        ->join('utilisateur_role', 'utilisateur.id_role', '=', 'utilisateur_role.id_role');

				if(!empty($rl))
				{
						$query->where('utilisateur_role.nom_role','=',$rl);
				}
				if(!empty($usr))
				{
						$query->where('utilisateur.username','=',$usr);
				}

        return $query->orderBy('utilisateur_role.id_role','asc')->orderBy('utilisateur.username','asc')->orderBy('nom','asc');
    }


	protected $hidden = ['password', 'remember_token'];

}
