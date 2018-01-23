@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
<script type="text/javascript">
  $(function() {
    $('.close').click(function() {
       $(this).parent().parent().hide('slow');
    });
  });

</script>
@endsection
@section('content')

@if($periode_inscription_valide == true)
<div id="messages" class="alert alert-info">
  <div><i class="fa fa-info-circle fa-lg"></i>&nbsp;&nbsp;{{$message}}<a href="#" class="close">&times;</a></div>
</div>
@else
<div id="messages" class="alert alert-warning">
  <div><i class="fa fa-info-circle fa-lg"></i>&nbsp;&nbsp;{{$message}}<a href="#" class="close">&times;</a></div>
</div>
@endif
@if(Session::has('success'))
<div id="messages" class="alert alert-success">
  <div><i class="fa fa-check-circle fa-lg"></i>&nbsp;&nbsp;{{ Session::get('success') }}<a href="#" class="close">&times;</a></div>
</div>
@endif
@if(Session::has('error'))
<div id="messages" class="alert alert-danger">
  <div><i class="fa fa-times-circle fa-lg"></i>&nbsp;&nbsp;{{ Session::get('error') }}<a href="#" class="close">&times;</a></div>
</div>
@endif
<div class="content">
        <div class="header">
            <h1 class="page-title">Inscription Examens</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Examens</li>
            <li class="active">Inscription Examens</li>
        </ul>
        </div>
        <div class="main-content">
        @if($periode_inscription_valide == true)
          @if (count($etuexamens) > 0)
            <a href="{{ url('/faireInscriptionExamen') }}" class="btn btn-primary btn-md disabled">
            <span class="glyphicon glyphicon-list-alt"></span> Inscrire choix d'examens</a>
            <a href="{{ url('/modifierInscriptionExamen') }}" class="btn btn-default btn-md">
            <span class="glyphicon glyphicon-pencil"></span> Modifier choix d'examens </a>
          @else
            <a href="{{ url('/faireInscriptionExamen') }}" class="btn btn-primary btn-md">
            <span class="glyphicon glyphicon-list-alt"></span> Inscrire choix d'examens </a>
            <a href="{{ url('/modifierInscriptionExamen') }}" class="btn btn-default btn-md disabled">
            <span class="glyphicon glyphicon-pencil"></span> Modifier choix d'examens </a>
          @endif
        @endif

        @if (count($etuexamens) > 0)
        <table class="table">
          <thead style="font-weight:bold;">
            <tr>
              <th>Code Semestre</th>
              <th>Code Module</th>
              <th>Date d'inscription aux Examens</th>
              <th>Centre de Passage</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($etuexamens as $examen)
          	<tr>
          		<td>{{ $examen->code_semestre }}</td>
          		<td><a href="#"> <span class="glyphicon glyphicon-unchecked"></span>{{ $examen->code_module }}</a></td>
              <td>{{ $examen->date_inscription_examen }}</td>
              <td>{{ $examen->nom_centre }}</td>
              <td><span class="glyphicon glyphicon-ok icon-success"></span></td>
          	</tr>
          	@endforeach
          </tbody>
        </table>
        @else
        <div class="noresuts"><strong>Aucun choix d'examen n'as encore été enregistré.</strong></div>
        @endif

        {!! str_replace('/?', '?', $etuexamens->render()) !!}

        </div>
</div>

@endsection
