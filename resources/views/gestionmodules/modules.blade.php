@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
<script type="text/javascript">
$(function () {
  $('[data-toggle="tooltip"]').tooltip();


  $('[id^=linkmodal_]').click(function(){

    var code= $.trim($(this).parent().parent().parent().children().first().find('a').text());
    var url ="{{ url('/modulescontenu')}}/"+code ;
    var resource ="{{ url('/modulescontenuzip')}}/";

    $.getJSON( url, function( json ) {
      $('.modal-body').find('.container-fluid').empty();

      $.each(json, function(i,mod) {
        $('.modal-body').find('.container-fluid').append("<div class='col-md-1' style='padding-right:7em;'><a href='"+resource+mod.adzip+"' id='zip'><i class='fa fa-file-archive-o fa-3x'></i>"+mod.adzip+"</a></div>");
      });

    });

  });

})
</script>
@endsection
@section('content')

<div class="content">
        <div class="header">
            <h1 class="page-title">Modules</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Gestion Modules</li>
            <li class="active">Modules</li>
        </ul>
        </div>
        <div class="main-content">
        {!! Form::open(array('action' => 'GestionModulesController@postmodules', 'class' =>'collapse form-inline','id' => 'formid')) !!}

          @if (count($allcategories) > 0)
          <label  class="form-label"><strong>Categorie</strong></label>
          <select class="form-control" name="categorie" >
          <option>ALL</option>
            @foreach($allcategories as $categorie)
            <option>{{$categorie->categorie}}</option>
            @endforeach
            </select>
          @endif

          @if (count($allmodules) > 0)
          <label  class="form-label"><strong>Module</strong></label>
          <select class="form-control" name="module">
          <option>ALL</option>
          @foreach($allmodules as $module)
          <option>{{$module->code}}</option>
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
          <a href="{{ url('/ajouterModule') }}" class="btn btn-default btn-md">
          <span class="glyphicon glyphicon-plus"></span> Ajouter Module</a>
          <a href="{{ url('/ajouterContenuModule') }}" class="btn btn-default btn-md">
          <span class="glyphicon glyphicon-plus"></span> Ajouter Contenu Module </a>
          <a href="{{ url('/modifierContenuModule') }}" class="btn btn-default btn-md">
          <span class="glyphicon glyphicon-edit"></span> Modifier Contenu Module </a>
          <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#formid">
            <span class="glyphicon glyphicon-cog"></span> Recherche Avancée
          </button>
          </br>
          <div style="width: 100%;display: block;position: relative;float: left;margin-bottom:20px;padding-bottom:15px;border-bottom: 1px solid #dddddd;"></div>

        @if (count($categories) > 0)

            @foreach($categories as $categorie)

                  @if(count($categorie->module) > 0)
                  <table class="table">
                    <thead style="font-weight:bold;">
                      <tr>
                        <th>Code Module</th>
                        <th>Nom Module</th>
                        <th><center>Contenu Module</center></th>
                      </tr>
                    </thead>
                    <tbody>
                    <h4><span class="label label-primary"><i class="glyphicon glyphicon-book"></i>{{$categorie->categorie}}</span></h4>
                    @foreach($categorie->module as $module)
                          <tr>
                            <td><a href="#"> <span class="glyphicon glyphicon-unchecked"></span>{{ $module->code }}</a></td>
                            <td>{{ $module->nom_module }}</td>
                            <td><center>
                            <a id="linkmodal_{{$module->code}}" href="#modal" data-toggle="modal"><span class="glyphicon glyphicon-new-window" data-toggle="tooltip" data-placement="top" title="Voir contenu"></span></a></center></td>
                          </tr>
                    @endforeach
                  @else
                  @endif
                </tbody>
                </table>
            @endforeach

        @else
        <div class="noresuts"><strong>Aucun Module n'as encore été enregistré.</strong></div>
        @endif
        </div>

        <div id="modal" class="modal in" role="dialog" aria-labelledby="Contenu Module" aria-hidden="false" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-danger">Contenu Module</h4>
              </div>
              <div class="modal-body">
              <div id="info" class="alert alert-warning alert-dismissible" style="font-size:10px;"><strong>Information</strong> :Le fichier compressé zip contient tous les fichiers utiles ainsi que le format SCORM. Il peut être installé automatiquement sur toute plateforme compatible SCORM. On peut voir la structure du contenu en explorant le fichier imsmanifest.xml inclus dans le paquetage.</div>
              <div class='container-fluid'>
              </div>
              </div>
              <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn">Fermer</a>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dalog -->
        </div>
        {!! str_replace('/?', '?', $categories->render()) !!}
</div>

@endsection
