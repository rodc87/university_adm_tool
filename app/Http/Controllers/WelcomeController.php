<?php namespace Emiage\Http\Controllers;
use Auth;
use Emiage\User;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$username = Auth::user()->username;
		$user = User::getutilisateurs(null,$username)->first();
		//dd($user);
		return view('home',['user'=>$user]);
	}

}
