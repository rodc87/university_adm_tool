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

$('[id^=linkmodal_]').click(function(){

  var semestre= $.trim($(this).parent().parent().parent().children().first().text());
  var code= $.trim($(this).parent().parent().parent().children().eq(1).text());
  var url ="{{ url('/listedevoirsparmodule')}}";
  var resource ="{{ url('/devoirscontenu')}}/";

  $.getJSON( url,
    {
        code: code,
        semestre: semestre
    },
     function( json ) {
    $('.modal-body').find('.container-fluid').empty();

    $.each(json, function(i,mod) {
      var extension = mod.ad_act.split('.').pop().toUpperCase();
      var ext;

      if(extension =="PDF")
      {ext="<i class='fa fa-file-pdf-o fa-3x'></i>"}
      else if (extension == "ZIP" || extension == "RAR")
      {ext="<i class='fa fa-file-archive-o fa-3x'></i>"}
      else if (extension == "DOC" || extension == "DOCX")
      {ext="<i class='fa fa-file-word-o  fa-3x'></i>"}
      else
      {ext="<i class='fa fa-file-o fa-3x'></i>"}

      $('.modal-body').find('.container-fluid').append("<div class='col-md-5' style='padding-right:7em;'><a href='"+resource+mod.ad_act+"' id='zip' style='font-size:11px;'>"+ext+"<span>&nbsp;"+mod.titre_act+"</br>"+mod.ad_act+"</span></a></div>");
    });

  });

});

})
</script>
@endsection
@section('content')

<div class="content">
      <div class="header">
        <h1 class="page-title">Devoirs</h1>
        <ul class="breadcrumb">
          <li><a href="{{ url('/')}}">Accueil</a> </li>
          <li class="active">Gestion Devoirs</li>
          <li class="active">Devoirs</li>
        </ul>
      </div>
      <div class="main-content">
        {!! Form::open(array('action' => 'GestionDevoirsController@postdevoirs', 'class' =>'collapse form-inline','id' => 'formid')) !!}

          @if (count($allsemestres) > 0)
          <label  class="form-label"><strong>Semestre</strong></label>
          <select class="form-control" name="semestre" >
          <option>ALL</option>
            @foreach($allsemestres as $sm)
            <option>{{$sm->code_semestre}}</option>
            @endforeach
          </select>
          @endif

          @if (count($allmodules  ) > 0)
          <label  class="form-label"><strong>Module</strong></label>
          <select class="form-control" name="module">
          <option>ALL</option>
            @foreach($allmodules as $md)
            <option>{{$md->code_module}}</option>
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
          <a href="{{ url('/ajouterDevoir') }}" class="btn btn-primary btn-md">
          <span class="glyphicon glyphicon-plus"></span> Ajouter Devoir</a>
          <a href="{{ url('/modifierDevoir') }}" class="btn btn-default btn-md">
          <span class="glyphicon glyphicon-edit"></span> Modifier Devoir</a>
          <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#formid">
            <span class="glyphicon glyphicon-cog"></span> Recherche Avancée
          </button>
          </br>
          <div style="width: 100%;display: block;position: relative;float: left;margin-bottom:20px;padding-bottom:15px;border-bottom: 1px solid #dddddd;"></div>
      </br>
      </br>
      <div class="table-responsive">
      @if (count($alldevoirs) > 0)
      <table class="table">
        <thead style="font-weight:bold;">
          <tr>
            <th>Semestre</th>
            <th>Module</th>
            <th><center>Actions</center></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($alldevoirs as $devoir)
          <tr>
            <td>{{ $devoir->code_semestre }}</td>
            <td>{{ $devoir->code_module }}</td>
            <td><center>
            <a id="linkmodal_{{$devoir->code_semestre}}_{{$devoir->code_module}}" href="#modal" data-toggle="modal"><span class="glyphicon glyphicon-new-window" data-toggle="tooltip" data-placement="top" title="Voir devoirs"></span></a></center></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>
      @else
      <div class="noresuts"><strong>Aucun Devoir n'as encore été enregistré.</strong></div>
      @endif

    {!! str_replace('/?', '?', $alldevoirs->render()) !!}

      <div id="modal" class="modal in" role="dialog" aria-labelledby="Contenu Module" aria-hidden="false" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title text-danger">Devoirs</h4>
            </div>
            <div class="modal-body">
            <div class='container-fluid'>
            </div>
            </div>
            <div class="modal-footer">
              <a href="#" data-dismiss="modal" class="btn">Fermer</a>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dalog -->
      </div>

      </div>
</div>

@endsection
