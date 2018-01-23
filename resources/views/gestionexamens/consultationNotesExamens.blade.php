@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
<script type="text/javascript">
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
  $('.close').click(function() {
     $(this).parent().parent().hide('slow');
  });
});
</script>
@endsection
@section('content')
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
            <h1 class="page-title">Consultation de Notes Examens</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Examens</li>
            <li class="active">Consultation de Notes Examens</li>
        </ul>
        </div>
        <div class="main-content">
        @if (count($allmodules) > 0 && count($centres) > 0)
            {!! Form::open(array('action' => 'GestionExamensController@postconsultationNotesExamens', 'class' =>'collapse form-inline','id' => 'formid')) !!}

              @if (count($allmodules) > 0)
              <label  class="form-label"><strong>Module</strong></label>
              <select class="form-control" name="module">
              <option>ALL</option>
              @foreach($allmodules as $module)
              <option>{{$module->code}}</option>
              @endforeach
              </select>
              @endif

              @if (count($centres) > 0)
              <label  class="form-label"><strong>Centre</strong></label>
              <select class="form-control" name="centre">
              <option>ALL</option>
              @foreach($centres as $centre)
              <option value="{{$centre->id_centre}}">{{$centre->nom_centre}}</option>
              @endforeach
              </select>
              @endif

              <button type="submit" class="btn btn-secondary" aria-label="Left Align">
              <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
              Rechercher
              </button>
              </br>
              </br>

              {!! Form::close() !!}
              <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#formid">
                <span class="glyphicon glyphicon-cog"></span> Recherche Avancée
              </button>
              </br>
              <div style="display: block;position: relative;float: left;margin-bottom:20px;padding-bottom:15px;border-bottom: 1px solid #dddddd;"></div>
              </br>
        @endif

        @if (count($examens) > 0)
        <div class="table-responsive">
        <table class="table">
            <thead style="font-weight:bold;">
              <tr>
                <th>Semestre</th>
                <th>Code Module</th>
                <th>Nom Etudiant</th>
                <th>Prenom Etudiant</th>
                <th>Centre</th>
                <th><center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Note Examen&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</center></th>
                <th><center>Note Examen Apres PV</center></th>
                @if($can_edit ==1)
                <th><center>Actions</center></th>
                @endif
              </tr>
            </thead>
            <tbody>
            @foreach($examens as $examen)
            <tr>
                    <td>{{ $examen->code_semestre }}</td>
                    <td><a href="#"> <span class="glyphicon glyphicon-unchecked"></span>{{ $examen->code_module }}</a></td>
                    <td>{{ $examen->nom_etudiant }}</td>
                    <td>{{ $examen->prenom_etudiant }}</td>
                    <td>{{ $examen->nom_centre }}</td>
                    <td>
                    <center>
                    @if(!empty($examen->note_examen))
                      @if($examen->note_examen >= 10)
                      <span class="alert-success" style="border-style:solid;border-width:1px;border-color:#bbb;padding:2px;display:block;"><strong><i class="fa fa-file-o"></i> {{$examen->note_examen}}&nbsp;/&nbsp;{{$examen->note_examen_sur}}</strong></span>
                      @else
                      <span class="alert-danger" style="border-style:solid;border-width:1px;border-color:#bbb;padding:2px;display:block;"><strong><i class="fa fa-file-o"></i> {{$examen->note_examen}}&nbsp;/&nbsp;{{$examen->note_examen_sur}}</strong></span>
                      @endif
                    @else
                    <span>-</span>
                    @endif
                    </center>
                    </td>
                    <td>
                      <center>
                      @if(!empty($examen->note_apres_pv))
                        @if($examen->note_apres_pv >= 10)
                        <span class="alert-success" style="border-style:solid;border-width:1px;border-color:#bbb;padding:2px;display:block;"><strong><i class="fa fa-file-o"></i> {{$examen->note_apres_pv}}&nbsp;/&nbsp;{{$examen->note_examen_sur}}</strong></span>
                        @else
                        <span class="alert-danger" style="border-style:solid;border-width:1px;border-color:#bbb;padding:2px;display:block;"><strong><i class="fa fa-file-o"></i> {{$examen->note_apres_pv}}&nbsp;/&nbsp;{{$examen->note_examen_sur}}</strong></span>
                        @endif
                      @else
                      <span>-</span>
                      @endif
                      </center>
                    </td>
                    @if($can_edit ==1)
                    <td><center>
                    <a id="edition_note" href="{{url('/modifierNotesExamens')}}/{{$examen->code_module}}_{{$examen->id_etudiant}}" data-toggle="modal"><span class="glyphicon glyphicon-edit" data-toggle="tooltip" data-placement="top" title="Attribuer ou Modifier Note d'Examen"></span></a>&nbsp;&nbsp;&nbsp;
                    <a id="edition_note_apres_pv" href="{{url('/modifierNotesExamensPV')}}/{{$examen->code_module}}_{{$examen->id_etudiant}}" data-toggle="modal"><span class="glyphicon glyphicon-edit" data-toggle="tooltip" data-placement="top" title="Attribuer ou Modifier Note d'Examen Après PV"></span></a></center></td>
                    @endif
            </tr>
            @endforeach
        </tbody>
        </table>
        </div>
        @else
        <div class="noresuts"><strong>Aucun Résultat.</strong></div>
        @endif
        </div>

        {!! str_replace('/?', '?', $examens->render()) !!}
</div>

@endsection
