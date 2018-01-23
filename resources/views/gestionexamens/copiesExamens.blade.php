@extends('app')
@section('head')
<meta name="_token" content="{!! csrf_token() !!}"/>
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
<script type="text/javascript">
$(function () {
  $.ajaxSetup({
     headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
  });

  $('[data-toggle="tooltip"]').tooltip();
  $('.closealert').click(function() {
     $(this).parent().parent().hide('slow');
  });

  $('#ajouter_copie,#modifier_copie,#supp_copie').click(function(){

    var iddetu= $.trim($(this).parent().parent().children().first().text());
    var code= $.trim($(this).parent().parent().children().eq(2).text());
    $('#selected_idetu').val(iddetu);
    $('#selected_code').val(code);
  })

  $('#ajouter_modal').click(function(){
    $('#myModal').find('.container-fluid').find('input#idetu').val($('#selected_idetu').val());
    $('#myModal').find('.container-fluid').find('input#code_module').val($('#selected_code').val());
    $('#formajout').submit();

  });

  $('#modifier_modal').click(function(){
    $('#myModal2').find('.container-fluid').find('input#idetu').val($('#selected_idetu').val());
    $('#myModal2').find('.container-fluid').find('input#code_module').val($('#selected_code').val());
    $('#formmod').submit();
  });

  $('#supprimer_modal').click(function(){
    $('#myModal3').find('.container-fluid').find('input#idetu').val($('#selected_idetu').val());
    $('#myModal3').find('.container-fluid').find('input#code_module').val($('#selected_code').val());
    $('#formsupp').submit();
  });

});
</script>
@endsection
@section('content')
@if(Session::has('success'))
<div id="messages" class="alert alert-success">
  <div><i class="fa fa-check-circle fa-lg"></i>&nbsp;&nbsp;{{ Session::get('success') }}<a href="#" class="close closealert">&times;</a></div>
</div>
@endif
@if(Session::has('error'))
<div id="messages" class="alert alert-danger">
  <div><i class="fa fa-times-circle fa-lg"></i>&nbsp;&nbsp;{{ Session::get('error') }}<a href="#" class="close closealert">&times;</a></div>
</div>
@endif
<div class="content">
        <div class="header">
            <h1 class="page-title">Copies d'Examen</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Examens</li>
            <li class="active">Copies d'Examen</li>
        </ul>
        </div>
        <div class="main-content">
        @if (count($allmodules) > 0 && count($centres) > 0)
            {!! Form::open(array('action' => 'GestionExamensController@postcopiesExamens', 'class' =>'collapse form-inline','id' => 'formid')) !!}

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
                <th class="hidden">idetudiant</th>
                <th>Semestre</th>
                <th>Code Module</th>
                <th>Nom Etudiant</th>
                <th>Prenom Etudiant</th>
                <th>Centre</th>
                <th>Copie d'Examen</th>
                @if($can_edit ==1)
                <th>Actions</th>
                @endif
              </tr>
            </thead>
            <tbody>
            @foreach($examens as $examen)
            <tr>
                    <td class="hidden">{{ $examen->id_etudiant }}</td>
                    <td>{{ $examen->code_semestre }}</td>
                    <td><a href="#"> <span class="glyphicon glyphicon-unchecked"></span>{{ $examen->code_module }}</a></td>
                    <td>{{ $examen->nom_etudiant }}</td>
                    <td>{{ $examen->prenom_etudiant }}</td>
                    <td>{{ $examen->nom_centre }}</td>
                    <td>
                    @if(!empty($examen->copie_examen))
                      <div class='col-md-10' style='padding-right:7em;'><a href="{{url('copiesExamensContenu/')}}/{{$examen->copie_examen}}" id='contenu' style='font-size:11px;'><i class='fa fa-file-pdf-o fa-2x'></i><span>&nbsp;{{$examen->copie_examen}}</span></a></div></td>
                    @endif
                    @if($can_edit ==1)
                    <td>
                      @if(empty($examen->copie_examen))
                      <a id="ajouter_copie" href="#modal" data-toggle="modal" class="text-success" data-target="#myModal" ><span class="glyphicon glyphicon-plus" data-toggle="tooltip" data-placement="top" title="Ajouter copie d'examen"></span></a>&nbsp;&nbsp;&nbsp;
                      @else
                      <a id="modifier_copie" href="#modal" data-toggle="modal" class="text-warning" data-target="#myModal2" ><span class="glyphicon glyphicon-edit" data-toggle="tooltip" data-placement="top" title="Modifier copie d'examen"></span></a>&nbsp;&nbsp;&nbsp;
                      <a id="supp_copie" href="#modal" data-toggle="modal" class="text-danger" data-target="#myModal3" ><span class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top" title="Supprimer copie d'examen"></span></a>
                      @endif
                    </td>
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

        <!-- /.Modal pour l'ajout de copies -->
        <div id="myModal" class="modal in" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
            {!! Form::open(array('action' => 'GestionExamensController@postcopiesExamensajout','id' => 'formajout','enctype'=>'multipart/form-data')) !!}
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title text-danger">Ajouter une copie d'examen</h4>
              </div>
              <div class="modal-body">
              <div id="info" class="alert alert-warning alert-dismissible" style="font-size:11px;"><strong>Information:</strong>&nbsp;Les documents admissibles doivent comporter les extensions suivantes : '.pdf', '.PDF'. Il est conseillé d'utiliser le format examen_[premierelettre-prenometudiant]-[nometudiant]_[module]_[semestre].[ext] pour nommer la copie d'examen &nbsp;<strong>  e.g: examen_PRENOM-NOMETUDIANT_C107_2015S2.pdf</strong>&nbsp;</div></br>
              <div class='container-fluid'>
                <input type="hidden" id="idetu" name="idetu"/>
                <input type="hidden" id="code_module" name="code_module"/>
                <div class="form-group">
                <label  class="form-label"><strong>Veuillez choisir une copie d'examen à ajouter :</strong></label>
                </br>
                </br>
                <input type="file" name="filefield" accept=".pdf">
                </div>
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button id="ajouter_modal" type="button" class="btn btn-primary">Ajouter</button>
              </div>
            {!! Form::close() !!}
            </div>
          </div>
        </div>
        <!-- /.Modal pour la modification de copies -->
        <div id="myModal2" class="modal in" role="dialog">
          <div class="modal-dialog">
              <div class="modal-content">
              {!! Form::open(array('action' => 'GestionExamensController@postcopiesExamensmodification','id' => 'formmod','enctype'=>'multipart/form-data')) !!}
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title text-danger">Modifier une copie d'examen</h4>
              </div>
              <div class="modal-body">
              <div class='container-fluid'>
                <div id="info" class="alert alert-warning alert-dismissible" style="font-size:11px;"><strong>Information:</strong>&nbsp;Les documents admissibles doivent comporter les extensions suivantes : '.pdf', '.PDF'. Il est conseillé d'utiliser le format examen_[premierelettre-prenometudiant]-[nometudiant]_[module]_[semestre].[ext] pour nommer la copie d'examen &nbsp;<strong>  e.g: examen_PRENOM-NOMETUDIANT_C107_2015S2.pdf</strong>&nbsp;</div></br>
                <input type="hidden" id="idetu" name="idetu"/>
                <input type="hidden" id="code_module" name="code_module"/>
                <div class="form-group">
                <label  class="form-label"><strong>Veuillez choisir une copie d'examen à modifier :</strong></label>
                </br>
                </br>
                <input type="file" name="filefield" accept=".pdf">
                </div>
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button id="modifier_modal" type="button" class="btn btn-primary">Modifier</button>
              </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
        <!-- /.Modal pour la suppresion de copies -->
        <div id="myModal3" class="modal in" role="dialog">
          <div class="modal-dialog">
              <div class="modal-content">
              {!! Form::open(array('action' => 'GestionExamensController@postcopiesExamenssuppresion','id' => 'formsupp','enctype'=>'multipart/form-data')) !!}
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title text-danger">Supprimer une copie d'examen</h4>
              </div>
              <div class="modal-body">
              <div class='container-fluid'>
              <input type="hidden" id="idetu" name="idetu"/>
              <input type="hidden" id="code_module" name="code_module"/>
              Êtes-vous sûr de vouloir supprimer définitivement cette copie d'examen ?
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button id="supprimer_modal" type="button" class="btn btn-danger">Supprimer</button>
              </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>

        <div id="selected_idetu" class="hidden"></div>
        <div id="selected_code" class="hidden"></div>
</div>

@endsection
