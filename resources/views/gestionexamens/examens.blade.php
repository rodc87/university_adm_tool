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
            <h1 class="page-title">Examens</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Examens</li>
            <li class="active">Examens</li>
        </ul>
        </div>
        <div class="main-content">
          <a href="{{ url('/ajouterExamen') }}" class="btn btn-primary btn-md">
          <span class="glyphicon glyphicon-plus"></span> Ajouter Examen</a>
          </br>
          <div style="width: 100%;display: block;position: relative;float: left;margin-bottom:20px;padding-bottom:15px;border-bottom: 1px solid #dddddd;"></div>

        @if (count($examens) > 0)
        <table class="table">
            <thead style="font-weight:bold;">
              <tr>
                <th>Semestre</th>
                <th>Code Module</th>
                <th>Date Creation</th>
                <th>Utilisateur Creation</th>
                <th>Date Passage</th>
                <th><center>Actions</center></th>
              </tr>
            </thead>
            <tbody>
            @foreach($examens as $examen)
            <tr>
                    <td>{{ $examen->code_semestre }}</td>
                    <td><a href="#"> <span class="glyphicon glyphicon-unchecked"></span>{{ $examen->code_module }}</a></td>
                    <td>{{ $examen->date_creation }}</td>
                    <td>{{ $examen->utilisateur_creation }}</td>
                    <td>{{ $examen->date_passage }}</td>
                    <td style="text-align:center;"><a href="{{ url('/modifierExamen') }}/{{ $examen->code_semestre}}_{{ $examen->code_module}}"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Modifier"></span></a></td>
            </tr>
            @endforeach
        </tbody>
        </table>
        @else
        <div class="noresuts"><strong>Aucun Examen n'as encore été enregistré.</strong></div>
        @endif
        </div>

        {!! str_replace('/?', '?', $examens->render()) !!}
</div>

@endsection
