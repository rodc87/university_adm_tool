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
        <h1 class="page-title">Centres</h1>
        <ul class="breadcrumb">
          <li><a href="{{ url('/')}}">Accueil</a> </li>
          <li class="active">Gestion Centres</li>
          <li class="active">Centres</li>
        </ul>
      </div>
      <div class="main-content">
        <a href="{{ url('/ajouterCentre') }}" class="btn btn-primary btn-md">
        <span class="glyphicon glyphicon-plus"></span> Ajouter Centre</a>
      </br>
      </br>
      <div class="table-responsive">
      @if (count($allcentres) > 0)
      <table class="table">
        <thead style="font-weight:bold;">
          <tr>
            <th>Centre</th>
            <th>Pays</th>
            <th>Ville</th>
            <th>Nature</th>
            <th><center>Actions</center></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($allcentres as $centre)
          <tr>
            <td><a href="#"><i class="fa fa-dot-circle-o"></i>&nbsp;{{ $centre->nom_centre }}</a></td>
            <td>{{ $centre->pays }}</td>
            <td>{{ $centre->ville }}</td>
            <td>{{ $centre->nature }}</td>
            <td style="text-align:center;"><a href="{{ url('/modifierCentre') }}/{{ $centre->id_centre }}"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Modifier"></span></a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>
      @else
      <div class="noresuts"><strong>Aucun Centre n'as encore été enregistré.</strong></div>
      @endif

      {!! str_replace('/?', '?', $allcentres->render()) !!}

      </div>
</div>

@endsection
