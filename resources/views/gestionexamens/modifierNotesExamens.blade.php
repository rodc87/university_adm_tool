@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
<script src="{{ asset('/js/jquery.validate.js') }}"></script>
<script type="text/javascript">
  $(function() {
      $( "#note" ).spinner({
       step: 0.01,
       numberFormat: "n",
       spin: function( event, ui ) {
        var echelle = $('#echelle').val();
        if ( ui.value > echelle ) {
          $( this ).spinner( "value", 0);
          return false;
        } else if ( ui.value < 0) {
          $( this ).spinner( "value", 0);
          return false;
        }
      }
     });
     $( "#echelle" ).spinner({
      step: 10,
      numberFormat: "n",
      min:0,
      max:100
    });
    $('#formid').validate({
      wrapper: 'li',
      rules: {
         note: {required:true}
       },
      messages:{
        note:"Le champ note d'examen est obligatoire",
      },
      errorLabelContainer: '#errors'
    });

    jQuery( "#note").keyup(function() {
            if(  isNaN (jQuery(this).val() )){ //Only numbers !
                jQuery(this).prop("value", "0") ; //Back to 0, as it is the minimum
            }
    });

    jQuery( "#echelle").keyup(function() {
            if(  isNaN (jQuery(this).val() )){ //Only numbers !
                jQuery(this).prop("value", "0") ; //Back to 0, as it is the minimum
            }
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
            <h1 class="page-title">Attribuer ou Modifier Note d'Examen</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Examens</li>
            <li class="active">Consultation de Notes</li>
            <li class="active">Attribuer ou Modifier Note d'Examen</li>
        </ul>
        </div>
        <div class="main-content">
        {!! Form::open(array('action' => 'GestionExamensController@postmodifierNotesExamens','id' => 'formid','enctype'=>'multipart/form-data')) !!}
        <div class="col-md-6 alert alert-info">
        <div class="form-group">
          <input id="code" name="code" type="hidden" class="form-control" value="{{$code}}"/>
          <input id="id_etu" name="id_etu" type="hidden" class="form-control" value="{{$id_etu}}"/>
          <label for="spinner" class="form-label" ><strong>Attribuer ou Modifer note d'examen:</strong></label></br>
          <input id="note" name="note" value="{{$note}}" length="5" required style="width:250px;"/>
          </br>
          <label for="echelle" class="form-label" ><strong>Echelle de notation:</strong></label></br>
          <input id="echelle" name="echelle" value="20" length="2" required style="width:250px;"/>
        </div>
        </br>
        <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Enregistrer</button>
        </div>
        {!! Form::close() !!}
        </div>
</div>
@endsection
