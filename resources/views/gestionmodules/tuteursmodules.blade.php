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
        <h1 class="page-title">Tuteurs</h1>
        <ul class="breadcrumb">
          <li><a href="{{ url('/')}}">Accueil</a> </li>
          <li class="active">Gestion Modules</li>
          <li class="active">Tuteurs</li>
        </ul>
      </div>
      <div class="main-content">
        <a href="{{ url('/ajouterTuteurModule') }}" class="btn btn-primary btn-md">
        <span class="glyphicon glyphicon-plus"></span> Ajouter Tuteur Module</a>
      </br>
      </br>
      <div class="table-responsive">
      @if (count($tutmodules) > 0)
      <table class="table">
        <thead style="font-weight:bold;">
          <tr>
            <th>Code Module</th>
            <th>Nom Module</th>
            <th>Nom Responsable</th>
            <th>Email Responsable</th>
            <th>Centre</th>
            <th><center>Actions</center></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($tutmodules as $tut)
          <tr>
            <td><a href="#"><i class="glyphicon glyphicon-unchecked"></i>{{ $tut->code }}</a></td>
            <td>{{ $tut->nom_module }}</td>
            <td>{{ $tut->prenom_tuteur }}&nbsp;{{ $tut->nom_tuteur }}</td>
            <td>{{ $tut->email }}</td>
            <td>{{ $tut->nom_centre }}</td>
            <td style="text-align:center;"><a href="{{ url('/modifierTuteurModule') }}/{{ $tut->code }}_{{$tut->id_tuteur}}"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Modifier"></span></a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>
      @else
      <div class="noresuts"><strong>Aucun Tuteur n'as encore été enregistrée.</strong></div>
      @endif

      </div>
</div>

@endsection
