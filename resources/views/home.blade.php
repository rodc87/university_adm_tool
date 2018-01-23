@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
		<div class="row jumbotron hero-spacer vertical-center">
			<div class="panel panel-default" style="margin: 0 auto;">
				<div class="panel-heading">Accueil</div>

				<div class="panel-body">
					Bienvenu <strong style="color:#337ab7;">{{$user->prenom}}&nbsp;{{$user->nom}}</strong> dans l'espace privé de l'université.
				</div>
		</div>
	</div>
</div>
@endsection
