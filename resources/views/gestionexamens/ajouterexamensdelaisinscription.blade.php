@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
<script src="{{ asset('/js/jquery.validate.js') }}"></script>
<script type="text/javascript">
  $(function() {
    $("#date_debut").datepicker();
    $("#date_fin").datepicker();
    $( "#date_debut" ).datepicker( "option", "dateFormat", "dd-mm-yy");
    $( "#date_fin" ).datepicker( "option", "dateFormat", "dd-mm-yy");
    $('#formid').validate({
      wrapper: 'li',
      rules: {
         semestre: "required",
         date_debut: "required",
         date_fin: "required",
       },
      messages:{
        semestre:"Le champ semestre est obligatoire",
        date_debut:"Le champ date de debut d'inscription est obligatoire",
        date_fin:"Le champ date de fin d'inscription est obligatoire",
      },
      errorLabelContainer: '#errors'
    });

    $('.close').click(function() {
       $('.alert-danger').hide('slow');
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
            <h1 class="page-title">Ajouter Delais d'Inscription</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Gestion des Examens</li>
            <li class="active">Delais d'Inscription</li>
            <li class="active">Ajouter Delais d'Inscription</li>
        </ul>
        </div>
        <div class="main-content">

        {!! Form::open(array('action' => 'GestionExamensController@postajouterExamensDelaisInscription','id' => 'formid','enctype'=>'multipart/form-data')) !!}
        <div class="col-md-6 alert alert-info">
             <div class="form-group">
               @if (count($allsemestres) > 0)
               <label  class="form-label"><strong>Semestre:</strong></label>
               {!! Form::select('semestre',$allsemestres,null,['class' => 'form-control form-inline']) !!}
               @endif
            </div>
        <div class="control-group">
           <div class="controls">
               <label  class="form-label"><strong>Date de Debut d'Inscription</strong></label>
               <div class="input-group">
                   <input id="date_debut" name="date_debut" type="text" class="date-picker form-control" required/>
                   <label id="label_debut" for="date_debut" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>
                   </label>
               </div>
           </div>
        </div>
        <div class="control-group">
        <div class="controls">
            <label  class="form-label"><strong>Date de Fin d'Inscription</strong></label>
            <div class="input-group">
                <input id="date_fin" name="date_fin" type="text" class="date-picker form-control" required/>
                <label id="label_fin" for="date_fin" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>
                </label>
            </div>
        </div>
        </div>
      </br>
        <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Enregistrer</button>
        </div>
        {!! Form::close() !!}
        </div>
</div>
@endsection
