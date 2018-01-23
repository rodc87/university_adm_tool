@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
<script src="{{ asset('/js/jquery.validate.js') }}"></script>
<script text="javascript">
        $(function () {

          $('#contenu_div').hide();
          $('#version_div').hide();
          $('#save').hide();

          $('#formid').validate({wrapper: 'li',messages:{
            version:"Le champ version est obligatoire",
            old_contenu_module:"Le champ module a modifier est obligatoire",
          },errorLabelContainer: '#errors'
          });

          $('.close').click(function() {

             $('#errors').hide('slow');

          });

          $( "#code" ).change(function() {
              var url ="{{ url('/modulescontenu')}}/"+this.value ;
              $.getJSON( url, function( json ) {
                  $('#old_contenu_module').empty();
                  $('#old_contenu_module').append($("<option value=''>---------------Choisir Contenu Module---------------</option>"));
                  $.each(json, function(i,mod) {
                    $('#old_contenu_module').append($("<option></option>")
                    .attr("value",mod.id_contenu)
                    .text(mod.adzip));
                  });

                  });
                $('#contenu_div').show();
              });

              $( "#old_contenu_module" ).change(function() {
                    $('#version_div').show();
              });

              $( "#version" ).change(function() {
                    $('#save').show();
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
            <h1 class="page-title">Modifier Contenu Module</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Gestion Modules</li>
            <li class="active">Modules</li>
            <li class="active">Modifier Contenu Module</li>
        </ul>
        </div>
        <div class="main-content">

        {!! Form::open(array('action' => 'GestionModulesController@postmodifiercontenumodule','id' => 'formid','enctype'=>'multipart/form-data')) !!}
        <div class="col-md-6 alert alert-info">
        <div class="alert alert-warning" style="width:100%;"><i class="fa fa-info-circle"></i>   Les contenus doivent impérativement être des paquetages zip.</div>
              <div class="form-group">
                @if (count($allmodules) > 0)
                <label  class="form-label"><strong>Module</strong></label>
                <select id="code" class="form-control" name="code" >
                  <option value="">---------------Choisir Module---------------</option>
                  @foreach($allmodules as $module)
                  <option value="{{$module->code}}">{{$module->code}}</option>
                  @endforeach
                </select>
                @endif
             </div>
             <div id="contenu_div" class="form-group">
               <label  class="form-label"><strong>Contenu Module a Modifier</strong></label>
               <select id="old_contenu_module" class="form-control" name="old_contenu_module" required>
                 <option value="">---------------Choisir Contenu Module---------------</option>
               </select>
            </div>
            <div id="version_div" class="form-group">
              @if (count($versions) > 0)
              <label  class="form-label"><strong>Version</strong></label>
              <select id="version" class="form-control" name="version" required>
                <option value="">---------------Choisir Version---------------<option>
                @foreach($versions as $version)
                <option value="v{{$version}}">v{{$version}}</option>
                @endforeach
              </select>
              @endif
           </div>
            <div id="save" class="form-group">
            <label  class="form-label"><strong>Document</strong></label>
            <input type="file" name="filefield">
            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Enregistrer</button>
            </div>

        </div>
        {!! Form::close() !!}
        </div>
</div>
@endsection
