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
        <h1 class="page-title">Responsables</h1>
        <ul class="breadcrumb">
          <li><a href="{{ url('/')}}">Accueil</a> </li>
          <li class="active">Gestion Modules</li>
          <li class="active">Responsables</li>
        </ul>
      </div>
      <div class="main-content">
        <a href="{{ url('/ajouterResponsableModule') }}" class="btn btn-primary btn-md">
        <span class="glyphicon glyphicon-plus"></span> Ajouter Responsable Module</a>
      </br>
      </br>
      <div class="table-responsive">
      @if (count($respmodules) > 0)
      <table class="table">
        <thead style="font-weight:bold;">
          <tr>
            <th>Code Module</th>
            <th>Nom Module</th>
            <th>Nom Responsable</th>
            <th>Email Responsable</th>
            <th>Type Responsable</th>
            <th>Centre</th>
            <th><center>Actions</center></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($respmodules as $resp)
          <tr>
            <td><a href="#"><i class="glyphicon glyphicon-unchecked"></i>{{ $resp->code }}</a></td>
            <td>{{ $resp->nom_module }}</td>
            <td>{{ $resp->prenom_responsable }}&nbsp;{{ $resp->nom_responsable }}</td>
            <td>{{ $resp->email }}</td>
            <td>{{ $resp->type_responsable }}</td>
            <td>{{ $resp->nom_centre }}</td>
            <td style="text-align:center;"><a href="{{ url('/modifierResponsableModule') }}/{{ $resp->code }}_{{$resp->id_responsable}}"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Modifier"></span></a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>
      @else
      <div class="noresuts"><strong>Aucun Responsable Module n'as encore été enregistrée.</strong></div>
      @endif

      </div>
</div>

@endsection
