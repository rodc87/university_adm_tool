<?php namespace Emiage\Http\Controllers;

use Emiage\Http\Requests;
use Emiage\Http\Controllers\Controller;
use Emiage\User;

use Validator;
use Illuminate\Support\Facades\Request;
use Redirect;
use Auth;
use DB;
use Hash;

class LoginController extends Controller {

	/**
	 * Controller pour l'Authentification Utilisateur
	 * Si les identifiants sont corrects l'utilisateur sera loggé et redirigé vers la page d'accueil principale.
	 * Si les identifiants sont incorrects l'utilisateur sera redirigé vers la page de login.
	 * @return Response
	 */
	public function index()
	{
	    /* Get the login form data using the 'Input' class */
        $username=Request::input('username');
        $password=Request::input('password');

				$v = Validator::make(
				    array(
				        'username' => $username,
				        'password' => $password,
				    ),
				    array(
				        'username' => 'required',
				        'password' => 'required',
				    )
				);

				if ($v->fails())
				{
		    		// The given data did not pass validation
		    		return view('auth/login')->withErrors($v->errors());
				}

        /* Try to authenticate the credentials */
        if(Auth::attempt(['username' => $username, 'password' => $password, 'status' => 'ENA']))
        {
						$username = Auth::user()->username;
						$user = User::getutilisateurs(null,$username)->first();
            return view('home',['user'=>$user]);
        }
        else
        {
            return view('auth/login')->withErrors(array('errors' => "Nom d'utilisateur ou mot de passe incorrect. Veuillez réessayer."));
        }


	}
	/**
	 * Controller pour login utilisateur. Si un utilisateur est déjà authentifié et il veut consulter la page /login, il sera redirigé vers
	 * la page d'acceuil principale.
	 * @return Response
	 */
	 public function get()
	{
							$username = Auth::user()->username;
							$user = User::getutilisateurs(null,$username)->first();
	            return view('home',['user'=>$user]);

	}



}
