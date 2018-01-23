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

  var id_doc= $.trim($(this).parent().parent().parent().children().first().text());
  var url ="{{ url('/listedocsconsortium')}}";
  var resource ="{{ url('/DocsConsortiumContenu')}}/";

  $.getJSON( url,
    {
        id_doc: id_doc
    },
     function( json ) {
    $('.modal-body').find('.container-fluid').empty();

    $.each(json, function(i,mod) {
      var extension = mod.document.split('.').pop().toUpperCase();
      var ext;

      if(extension =="PDF")
      {ext="<i class='fa fa-file-pdf-o fa-3x'></i>"}
      else if (extension == "ZIP" || extension == "RAR")
      {ext="<i class='fa fa-file-archive-o fa-3x'></i>"}
      else if (extension == "DOC" || extension == "DOCX")
      {ext="<i class='fa fa-file-word-o  fa-3x'></i>"}
      else
      {ext="<i class='fa fa-file-o fa-3x'></i>"}

      $('.modal-body').find('.container-fluid').append("<div class='col-md-5' style='padding-right:7em;'><a href='"+resource+mod.document+"' id='zip' style='font-size:11px;'>"+ext+"<span>&nbsp;"+mod.nom_document+"</br>"+mod.document+"</span></a></div>");
    });

  });

});

})
</script>
@endsection
@section('content')
<div class="content">
      <div class="header">
        <h1 class="page-title">Documents Administratifs</h1>
        <ul class="breadcrumb">
          <li><a href="{{ url('/')}}">Accueil</a> </li>
          <li class="active">Documents Administratifs</li>
        </ul>
      </div>
      <div class="main-content">
          <a href="{{ url('/DocsConsortiumAjout') }}" class="btn btn-primary btn-md">
          <span class="glyphicon glyphicon-plus"></span> Ajouter Document</a>
          <a href="{{ url('/DocsConsortiumModification') }}" class="btn btn-default btn-md">
          <span class="glyphicon glyphicon-edit"></span> Modifier Document</a>
          </br>
          <div style="width: 100%;display: block;position: relative;float: left;margin-bottom:20px;padding-bottom:15px;border-bottom: 1px solid #dddddd;"></div>
      </br>
      </br>
      <div class="table-responsive">
      @if (count($alldocs) > 0)
      <table class="table">
        <thead style="font-weight:bold;">
          <tr>
            <th>Id Document</th>
            <th>Nom Document</th>
            <th>Description Document</th>
            <th>Type Document</th>
            <th><center>Actions</center></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($alldocs as $doc)
          <tr>
            <td>{{ $doc->id_document }}</td>
            <td>{{ $doc->nom_document }}</td>
            <td>{{ $doc->description_document }}</td>
            <td>{{ $doc->type_document }}</td>
            <td><center>
            <a id="linkmodal_{{$doc->id_document}}" href="#modal" data-toggle="modal"><span class="glyphicon glyphicon-new-window" data-toggle="tooltip" data-placement="top" title="Voir Document"></span></a></center></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>
      @else
      <div class="noresuts"><strong>Aucun Document n'as encore été enregistré.</strong></div>
      @endif

    {!! str_replace('/?', '?', $alldocs->render()) !!}

      <div id="modal" class="modal in" role="dialog" aria-labelledby="Contenu Documents" aria-hidden="false" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title text-danger">Documents</h4>
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
