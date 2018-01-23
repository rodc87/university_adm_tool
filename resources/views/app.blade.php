<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>University Administration Tool</title>
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<!-- Fonts -->
	<!--link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'-->
	<link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('/css/jquery-ui-1.10.4.custom.css') }}" rel="stylesheet" />
	<script src="{{ asset('/js/jquery-1.11.2.min.js') }}"></script>
	<script src="{{ asset('/js/jquery-ui-1.10.4.custom.js') }}"></script>
	<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
	<script>

		$( document ).ready(function() {

			$('#administratif').click(function() {

				   $('.sidebar-nav').slideDown('slow');

			});

			$('#menu-close').click(function() {

			   $('.sidebar-nav').slideUp('slow');

			});

		});
	</script>
	@yield('head')
</head>
<body>
	@if (Auth::guest())
		<nav class="navbar navbar-default">
		<div class="container-fluid" style="background-repeat:no-repeat;padding-top:40px;">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('/') }}">University Administration Tool (UAT) </a>
			</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			</div>
		</div>
	</nav>
	@else
	<nav class="navbar navbar-default">
		<div style="background-repeat:no-repeat;padding-top:40px;">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('/') }}">University Administration Tool (UAT)</a>
			</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				@if (Auth::user()->Role->nom_role == 'ADM')
					@include('menu.administrateur')
				@elseif(Auth::user()->Role->nom_role == 'ETU')
					@include('menu.etudiant')
				@elseif(Auth::user()->Role->nom_role == 'RESP')
					@include('menu.responsable')
				@elseif(Auth::user()->Role->nom_role == 'TUT')
					@include('menu.tuteur')
				@elseif(Auth::user()->Role->nom_role == 'SCOL')
					@include('menu.scolarite')
				@elseif(Auth::user()->Role->nom_role == 'PERS')
					@include('menu.personnel')
				@endif
				@if (Auth::user()->Role->nom_role == 'ADM')
				<ul id="administratif" class="nav navbar-nav">
				<li><a href="#"><span class="glyphicon glyphicon-briefcase padding-right-small" style="position:relative;top: 3px;"></span>
					Administratif</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="glyphicon glyphicon-user padding-right-small" style="position:relative;top: 3px;"></span> {{ Auth::user()->username }}
                <span class="caret"></span>
            	</a></a>
				<ul class="dropdown-menu" role="menu" style="width:100%;">
	                <li><a href="{{ url('/monCompte') }}"><i class="glyphicon glyphicon-dashboard"></i>Mon Compte</a></li>
	                <li><a href="{{ url('/auth/logout') }}"><i class="glyphicon glyphicon-log-out"></i>Logout</a></li>
				</ul>
				</li>
				</ul>
				</div>
				<div class="sidebar-nav">
				<button id="menu-close" type="button" class="btn btn-secondary navbar-right2 button-close" aria-label="Left Align">
						 <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>
				<ul class="nav navbar-nav">
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#337ab7;margin-top: 5px;"><span class="glyphicon glyphicon-wrench padding-right-small" style="position:relative;top: 3px;"></span>
					Gestion des Utilisateurs <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu" style="width:100%;position:relative;">
					<li><a class="nav_space_left" href="{{ url('/utilisateurs') }}"><i class="glyphicon glyphicon-menu-right"></i>Utilisateurs</a></li>
					</ul>
				</li>
				</ul>
				<ul class="nav navbar-nav">
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#337ab7;margin-top: 5px;"><span class="glyphicon glyphicon-wrench padding-right-small" style="position:relative;top: 3px;"></span>
					Gestion des Modules <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu" style="width:100%;position:relative;">
					<li><a class="nav_space_left" href="{{ url('/modules') }}"><i class="glyphicon glyphicon-menu-right"></i>Modules</a></li>
					<li><a class="nav_space_left" href="{{ url('/modulesOuverts') }}"><i class="glyphicon glyphicon-menu-right"></i>Modules Ouverts</a></li>
					<li><a class="nav_space_left" href="{{ url('/categories') }}"><i class="glyphicon glyphicon-menu-right"></i>Categories</a></li>
					<li><a class="nav_space_left" href="{{ url('/responsablesModules') }}"><i class="glyphicon glyphicon-menu-right"></i>Responsables</a></li>
					<li><a class="nav_space_left" href="{{ url('/tuteurModules') }}"><i class="glyphicon glyphicon-menu-right"></i>Tuteurs</a></li>
					</ul>
				</li>
				</ul>
				<ul class="nav navbar-nav">
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#337ab7;margin-top: 5px;"><span class="glyphicon glyphicon-wrench padding-right-small" style="position:relative;top: 3px;"></span>
					Gestion des Devoirs <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu" style="width:100%;position:relative;">
					<li><a class="nav_space_left" href="{{ url('/devoirs') }}"><i class="glyphicon glyphicon-menu-right"></i>Devoirs</a></li>
					</ul>
				</li>
				</ul>
				<ul class="nav navbar-nav">
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#337ab7;margin-top: 5px;"><span class="glyphicon glyphicon-wrench padding-right-small" style="position:relative;top: 3px;"></span>
					Gestion des Examens <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu" style="width:100%;position:relative;">
					<li ><a class="nav_space_left" href="{{ url('/examensDelaisInscription') }}"><i class="glyphicon glyphicon-menu-right"></i>Delais d'inscription</a></li>
					</ul>
				</li>
				</ul>
				<ul class="nav navbar-nav">
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#337ab7;margin-top: 5px;"><span class="glyphicon glyphicon-wrench padding-right-small" style="position:relative;top: 3px;"></span>
					Gestion des Centres <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu" style="width:100%;position:relative;">
					<li ><a class="nav_space_left" href="{{ url('/centres') }}"><i class="glyphicon glyphicon-menu-right"></i>Centres</a></li>
					</ul>
				</li>
				</ul>
				<ul class="nav navbar-nav">
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#337ab7;margin-top: 5px;"><span class="glyphicon glyphicon-wrench padding-right-small" style="position:relative;top: 3px;"></span>
					Gestion des Semestres <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu" style="width:100%;position:relative">
					<li ><a class="nav_space_left" href="{{ url('/semestres') }}"><i class="glyphicon glyphicon-menu-right"></i>Semestres</a></li>
					</ul>
				</li>
				</ul>
				<ul class="nav navbar-nav">
				<li class="dropdown">
				<a href="{{ url('/DocsConsortium') }}" class="dropdown-toggle" style="color:#337ab7;margin-top: 5px;"><span class="glyphicon glyphicon-wrench padding-right-small" style="position:relative;top: 3px;"></span>
					Documents Administratifs </a>
				</li>
				</ul>
				@else
				<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="glyphicon glyphicon-user padding-right-small" style="position:relative;top: 3px;"></span> {{ Auth::user()->username }}
                <span class="caret"></span>
        </a></a>
				<ul class="dropdown-menu" role="menu" style="width:100%;">
          <li><a href="{{ url('/monCompte') }}"><i class="glyphicon glyphicon-dashboard"></i>Mon Compte</a></li>
          <li><a href="{{ url('/auth/logout') }}"><i class="glyphicon glyphicon-log-out"></i>Logout</a></li>
				</ul>
				</li>
				</div>
				@endif
			</ul>
		</div>
	</nav>

  @endif

	@yield('content')
</body>
</html>
