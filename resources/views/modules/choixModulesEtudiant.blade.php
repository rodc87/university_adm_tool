@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
@endsection
@section('content')

<div class="content">
        <div class="header">
            <h1 class="page-title">Choix de Modules</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Modules de formation</li>
            <li class="active">Choix de Modules</li>
        </ul>
        </div>
        <div class="main-content">
        @if (count($choix) > 0)  
          <a href="{{ url('/choisirModules') }}" class="btn btn-primary btn-md disabled">
          <span class="glyphicon glyphicon-list-alt"></span> Choisir Liste de Modules </a> 
          <a href="{{ url('/modifierChoixModules') }}" class="btn btn-default btn-md">
          <span class="glyphicon glyphicon-pencil"></span> Modifier Choix </a>
        @else
          <a href="{{ url('/choisirModules') }}" class="btn btn-primary btn-md">
          <span class="glyphicon glyphicon-list-alt"></span> Choisir Liste de Modules </a> 
          <a href="{{ url('/modifierChoixModules') }}" class="btn btn-default btn-md disabled">
          <span class="glyphicon glyphicon-pencil"></span> Modifier Choix </a>
        @endif
        </br>
        </br>
        @if (count($choix) > 0)            
        <table class="table">
          <thead style="font-weight:bold;">
            <tr>
              <th>Code Semestre</th>
              <th>Code Module</th>
              <th>Date d'inscription du choix</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($choix as $ch)
          	<tr>
          		<td>{{ $ch->code_semestre }}</td>
          		<td><a href="#"> <span class="glyphicon glyphicon-unchecked"></span>{{ $ch->code_module }}</a></td>
              <td>{{ $ch->date_inscription_choix }}</td>
              <td><span class="glyphicon glyphicon-ok icon-success"></span></td>
          	</tr>
          	@endforeach
          </tbody>
        </table>
        @else
        <div class="noresuts"><strong>Aucun choix n'as encore été enregistré.</strong></div>
        @endif

        {!! str_replace('/?', '?', $choix->render()) !!}

        </div>
</div>

@endsection
