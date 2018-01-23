@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
@endsection
@section('content')

<div class="content">
        <div class="header">
            <h1 class="page-title">Modules Ouverts</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Gestion Modules</li>
            <li class="active">Modules Ouverts</li>
        </ul>
        </div>
        <div class="main-content">
        @if (count($modouverts) > 0)
          <a href="{{ url('/choisirModulesOuverts') }}" class="btn btn-primary btn-md disabled">
          <span class="glyphicon glyphicon-list-alt"></span> Choisir Liste de Modules Ouverts </a>
          <a href="{{ url('/modifierModulesOuverts') }}" class="btn btn-default btn-md">
          <span class="glyphicon glyphicon-pencil"></span> Modifier Liste de Modules Ouverts </a>
        @else
          <a href="{{ url('/choisirModulesOuverts') }}" class="btn btn-primary btn-md">
          <span class="glyphicon glyphicon-list-alt"></span> Choisir Liste de Modules Ouverts </a>
          <a href="{{ url('/modifierModulesOuverts') }}" class="btn btn-default btn-md disabled">
          <span class="glyphicon glyphicon-pencil"></span> Modifier Liste de Modules Ouverts </a>
        @endif
        </br>
        </br>
        @if (count($modouverts) > 0)
        <table class="table">
          <thead style="font-weight:bold;">
            <tr>
              <th>Code Semestre</th>
              <th>Code Module</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($modouverts as $mod)
          	<tr>
          		<td>{{ $mod->code_semestre }}</td>
          		<td><a href="#"> <span class="glyphicon glyphicon-unchecked"></span>{{ $mod->code_module }}</a></td>
          	</tr>
          	@endforeach
          </tbody>
        </table>
        @else
        <div class="noresuts"><strong>Aucun module ouvert pour ce semestre.</strong></div>
        @endif

        {!! str_replace('/?', '?', $modouverts->render()) !!}

        </div>
</div>

@endsection
