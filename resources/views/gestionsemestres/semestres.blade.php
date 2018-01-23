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
        <h1 class="page-title">Semestres</h1>
        <ul class="breadcrumb">
          <li><a href="{{ url('/')}}">Accueil</a> </li>
          <li class="active">Gestion Semestres</li>
          <li class="active">Semestres</li>
        </ul>
      </div>
      <div class="main-content">
        <a href="{{ url('/ajouterSemestre') }}" class="btn btn-primary btn-md">
        <span class="glyphicon glyphicon-plus"></span> Ajouter Semestre</a>
      </br>
      </br>
      <div class="table-responsive">
      @if (count($allsemestres) > 0)
      <table class="table">
        <thead style="font-weight:bold;">
          <tr>
            <th>Code Semestre</th>
            <th>Utilisateur Creation</th>
            <th>Date Creation</th>
            <th><center>Actions</center></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($allsemestres as $semestre)
          <tr>
            <td><a href="#"><i class="fa fa-dot-circle-o"></i>&nbsp;{{ $semestre->code_semestre }}</a></td>
            <td>{{ $semestre->utilisateur_creation }}</td>
            <td>{{ $semestre->date_creation }}</td>
            <td style="text-align:center;"><a href="{{ url('/modifierSemestre') }}/{{ $semestre->id_semestre }}"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Modifier"></span></a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>
      @else
      <div class="noresuts"><strong>Aucun Semestre n'as encore été enregistré.</strong></div>
      @endif

      {!! str_replace('/?', '?', $allsemestres->render()) !!}

      </div>
</div>

@endsection
