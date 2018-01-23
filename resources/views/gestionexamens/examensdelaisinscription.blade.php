@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
<script type="text/javascript">
$(function () {
$('[data-toggle="tooltip"]').tooltip();
})
</script>
@endsection
@section('content')
<div class="content">
        <div class="header">
            <h1 class="page-title">Delais d'Inscription aux Examens</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Gestion des Examens</li>
            <li class="active">Delais d'Inscription aux Examens</li>
        </ul>
        </div>
        <div class="main-content">
          <a href="{{ url('/ajouterExamensDelaisInscription') }}" class="btn btn-primary btn-md">
          <span class="glyphicon glyphicon-plus"></span> Ajouter delais d'inscription aux examens</a>
          </br>
          <div style="width: 100%;display: block;position: relative;float: left;margin-bottom:20px;padding-bottom:15px;border-bottom: 1px solid #dddddd;"></div>

        @if (count($examensdelais) > 0)
        <table class="table">
            <thead style="font-weight:bold;">
              <tr>
                <th>Semestre</th>
                <th>Date de Debut Inscription aux Examens</th>
                <th>Date de Fin Inscription aux Examens</th>
                <th><center>Actions</center></th>
              </tr>
            </thead>
            <tbody>
            @foreach($examensdelais as $examen)
            <tr>
                    <td>{{ $examen->code_semestre }}</td>
                    <td>{{ $examen->date_debut_inscription }}</td>
                    <td>{{ $examen->date_fin_inscription }}</td>
                    <td style="text-align:center;"><a href="{{ url('/modifierExamensDelaisInscription') }}/{{ $examen->code_semestre}}"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Modifier"></span></a></td>
            </tr>
            @endforeach
        </tbody>
        </table>
        @else
        <div class="noresuts"><strong>Aucun delais d'inscription aux examens n'as encore été enregistré.</strong></div>
        @endif
        </div>

        {!! str_replace('/?', '?', $examensdelais->render()) !!}
</div>

@endsection
