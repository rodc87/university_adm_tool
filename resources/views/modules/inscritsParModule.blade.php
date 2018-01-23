@extends('app')
@section('head')
<meta name="_token" content="{!! csrf_token() !!}"/>
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
<script src="{{ asset('/js/jquery.validate.js') }}"></script>
<script text="javascript">
        $(function () {
          $.ajaxSetup({
             headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
          });

          //Search Form
          $('#rechercher').click(function(){
            $('#formid').submit();
          });

          //Export Form
          $('#export').click(function(){
            $('#form_export').submit();
          });

          $(".product-details").click(function(event){

            $(event.target).parent().next('.product-details_inner').toggle();


          });

          $(".glyphicon-plus-sign").click(function(event){

            $(event.target).parent().parent().next('.product-details_inner').toggle();

          });

          $('#formid').validate({wrapper: 'li',messages:{
            centre:"Le champ centre est obligatoire",
            module:"Le champ module est obligatoire",
          },errorLabelContainer: '#errors'
          });

          $('.close').click(function() {

             $('.alert').hide('slow');

          });

        });

</script>
@endsection
@section('content')
<div id="errors" class="alert alert-danger" style="display:none;">
	<a href="#" class="close">&times;</a>
</div>
<div class="content">
        <div class="header">
            <h1 class="page-title">Inscrits par Module</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Modules de formation</li>
            <li class="active">Inscrits par Module</li>
        </ul>
        </div>
        <div class="main-content">

      <div "form-container" class="container-fluid">
      {!! Form::open(array('action' => 'InscritsParModuleController@post', 'class' =>'form-inline','id' => 'formid')) !!}

      @if (count($toussemestre) > 0)
      <label  class="form-label"><strong>Semestre</strong></label>
      <select class="form-control" name="semestre" >
        @foreach($toussemestre as $semestre)
        <option>{{$semestre->code_semestre}}</option>
        @endforeach
        </select>
      @endif

      @if (count($tousmodules) > 0)
      <label  class="form-label"><strong>Module</strong></label>
      <select id="module" class="form-control" name="module" required>
        <option value="">ALL</option>
        @foreach($tousmodules as $module)
        <option>{{$module->code}}</option>
        @endforeach
        </select>
      @endif

      @if (count($touscentres) > 0)
      <label  class="form-label"><strong>Centre</strong></label>
      <select id="centre" class="form-control" name="centre" required>
        <option value="">ALL</option>
        @foreach($touscentres as $centre)
        <option value="{{$centre->id_centre}}">{{$centre->nom_centre}}</option>
        @endforeach
      </select>
      @endif

      <button id="rechercher" class="btn btn-secondary" aria-label="Left Align">
      <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
      Rechercher
      </button>

      {!! Form::close() !!}
     </div>
      <div style="width: 100%;display: block;position: relative;float: left;margin-bottom:20px;padding-bottom:15px;border-bottom: 1px solid #dddddd;"></div>
        <div class="container-fluid">
        @if (count($inscrits) > 0)
            {!! Form::open(array('action' => 'InscritsParModuleController@exporter_excel', 'class' =>'form-inline','id' => 'form_export')) !!}
            <button id="export" class="btn btn-default btn-md" style="float:right;">
            <i class="fa fa-file-excel-o fa-3" style="color:#08743B"></i> Exporter</button>
            <input id="semestre_export" type="hidden" name="semestre_export"  value="{{$sem}}"/>
            <input id="module_export" type="hidden" name="module_export" value="{{$mod}}"/>
            <input id="centre_export" type="hidden" name="centre_export" value="{{$cent}}"/>
            {!! Form::close() !!}
            <?php $mod=null; $prevmod=null; $j=0 ?>
            @for($i=0; $i<count($inscrits);$i++)
              @if($i==0)
                <?php $mod=$inscrits[$i]; $prevmod=$inscrits[$i]; ?>

                <div class="product col-lg-12">
                <h4 class="text-info"><span class="label label-primary" style="display:block;">{{$mod->code_module}} - {{$mod->nom_module}}</span></h4>
                <ul>
                <div class="col-md-4" style="position: relative;float: left;">
                <li class="alert-info product-label"><span class="glyphicon glyphicon-user "></span><strong> Etudiant:</strong>{{ $mod->nom_etudiant }} {{ $mod->prenom_etudiant }} <a id="etu_details" class="product-details" href="#"> <span class="glyphicon glyphicon-plus-sign"></span>Détails</a></li>
                <li id="li_details" class="product-details_inner"><strong>Nom Etudiant:</strong>{{ $mod->nom_etudiant }}</br>
                <strong>Prenom Etudiant:</strong>{{ $mod->prenom_etudiant}}</br>
                <strong>Email:</strong>{{ $mod->email}}</br>
                <strong>Date Inscription:</strong>{{ $mod->date_inscription_choix}}</br>
                <strong>Centre:</strong>{{ $mod->nom_centre}}
                </div>
              @else
               <?php $mod=$inscrits[$i]; ?>
               <div class="col-md-4" style="position: relative;float: left;">
                       <li class="alert-info product-label"><span class="glyphicon glyphicon-user "></span><strong> Etudiant:</strong>{{ $mod->nom_etudiant }} {{ $mod->prenom_etudiant }} <a id="etu_details" class="product-details" href="#"> <span class="glyphicon glyphicon-plus-sign"></span>Détails</a></li>
                       <li id="li_details" class="product-details_inner"><strong>Nom Etudiant:</strong>{{ $mod->nom_etudiant }}</br>
                       <strong>Prenom Etudiant:</strong>{{ $mod->prenom_etudiant}}</br>
                       <strong>Email:</strong>{{ $mod->email}}</br>
                       <strong>Date Inscription:</strong>{{ $mod->date_inscription_choix}}</br>
                       <strong>Centre:</strong>{{ $mod->nom_centre}}
                       </li>
                </div>
              @endif

            @endfor
            </ul>
            </div>
        </div>
        </div>

        @else
          @if($get != 1)
          <div class="noresuts"><strong>Aucun résultat.</strong></div>
          @endif
        @endif
</div>
@endsection
