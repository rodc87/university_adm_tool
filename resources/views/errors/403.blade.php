@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="error-template text-danger ">
                <div class="error-details">
                 <h2 style="font-weight:bold;">
                 <span style="text-decoration:underline;"><strong>Access Interdit:</strong></span>Vous n'avez pas l'autorisation nécessaire pour accéder à cette resource.
                </h2>
                </div>
                <div class="error-actions">
                    <a href="{{ url('/home') }}" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-home"></span>
                     Retourner à la page d’accueil </a><a href="#" class="btn btn-danger btn-md"><span class="glyphicon glyphicon-envelope"></span> Contacter Support </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
