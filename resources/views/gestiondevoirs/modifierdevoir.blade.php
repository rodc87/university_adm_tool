@extends('app')
@section('head')
<meta name="_token" content="{!! csrf_token() !!}"/>
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
<script src="{{ asset('/js/jquery.validate.js') }}"></script>
<script text="javascript">
        $(function (){

          $.ajaxSetup({
                 headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
          });

          $('#code_div').hide();
          $('#devoir_div').hide();
          $('#titre_div').hide();
          $('#save').hide();

          $('#formid').validate({wrapper: 'li',messages:{
            devoir_a_modifier:"Le champ devoir a modifier est obligatoire",
            titre_act:"Le champ titre est obligatoire",
          },errorLabelContainer: '#errors'
          });

          $('.close').click(function() {

             $('#errors').hide('slow');

          });

          $( "#semestre" ).change(function() {
                $('#code_div').show();
          });

          $( "#code" ).change(function() {
              var url ="{{ url('/listedevoirsparmodule')}}";
              var semestre = $.trim($('#semestre').val());
              var code = $.trim(this.value);

              $.getJSON( url,
              { code:code,
                semestre:semestre
              }, function(json) {
                  $('#devoir_a_modifier').empty();
                  $('#devoir_a_modifier').append($("<option value=''>---------------Choisir Devoir a Modifier---------------</option>"));
                  $.each(json, function(i,mod) {
                    $('#devoir_a_modifier').append($("<option></option>")
                    .attr("value",mod.id_act)
                    .text(mod.ad_act));
                  });

                  });
                $('#devoir_div').show();
          });

          $( "#devoir_div" ).change(function() {
                    $('#titre_div').show();
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
            <h1 class="page-title">Modifier Devoir</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Gestion Devoirs</li>
            <li class="active">Devoirs</li>
            <li class="active">Modifier Devoir</li>
        </ul>
        </div>
        <div class="main-content">

        {!! Form::open(array('action' => 'GestionDevoirsController@postmodifierdevoir','id' => 'formid','enctype'=>'multipart/form-data')) !!}
        <div class="col-lg-10 alert alert-info">
        <div class="alert alert-warning" style="width:100%;"><i class="fa fa-info-circle"></i>&nbsp;- Les documents admissibles doivent comporter les extensions suivantes : '.pdf', '.PDF', '.doc', '.DOC', '.docx', '.DOCX', '.zip', '.ZIP', '.rar', '.RAR'. </br>&nbsp; - Il est conseillé d'utiliser le format activite[#]_[module]_[semestre].[ext] pour nommer le fichier d'activite &nbsp;<strong>  e.g: activite1_C215_2015S2.pdf</strong></br>&nbsp; - Il est conseillé d'utiliser le format Activite n°[#] pour le titre des activites &nbsp;<strong> e.g: Activite n°1</strong></div>
             <div class="form-group">
               @if (count($allsemestres) > 0)
               <label  class="form-label"><strong>Semestre</strong></label>
               <select id="semestre" class="form-control" name="semestre" >
                 <option value="">---------------Choisir Semestre---------------</option>
                 @foreach($allsemestres as $semestre)
                 <option value="{{$semestre->code_semestre}}">{{$semestre->code_semestre}}</option>
                 @endforeach
               </select>
               @endif
            </div>
            <div id="code_div" class="form-group">
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
           <div id="devoir_div" class="form-group">
             <label  class="form-label"><strong>Devoir a Modifier</strong></label>
             <select id="devoir_a_modifier" class="form-control" name="devoir_a_modifier" required>
               <option value="">---------------Choisir Devoir a Modifier---------------</option>
             </select>
          </div>
           <div id="titre_div" class="form-group">
             <label  class="form-label"><strong>Titre Devoir</strong></label>
             <input id="titre_act" type="text" name="titre_act" value="" class="form-control" required/>
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
