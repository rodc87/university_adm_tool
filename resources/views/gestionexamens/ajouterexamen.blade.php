@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
<script src="{{ asset('/js/jquery.validate.js') }}"></script>
<script type="text/javascript">
  $(function() {
    $("#date_passage").datepicker();
    $( "#date_passage" ).datepicker( "option", "dateFormat", "dd-mm-yy");
    $('#formid').validate({
      wrapper: 'li',
      rules: {
         date_passage: "required",
       },
      messages:{
        code:"Le champ code module est obligatoire",
        date_passage:"Le champ date de passage est obligatoire"},
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
            <h1 class="page-title">Ajouter Examen</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Examens</li>
            <li class="active">Ajouter Examen</li>
        </ul>
        </div>
        <div class="main-content">

        {!! Form::open(array('action' => 'GestionExamensController@postajouterexamen','id' => 'formid','enctype'=>'multipart/form-data')) !!}
        <div class="col-md-6 alert alert-info">
             <div class="form-group">
               @if (count($semestre) > 0)
               <label  class="form-label"><strong>Semestre:</strong></label>
               <label  class="form-label">{{$semestre}}</label>
               @endif
            </div>
            <div class="form-group">
              <label  class="form-label"><strong>Module:</strong></label>
              <select class="form-control" name="code" required >
              @if (count($modouverts) > 0)
                @foreach($modouverts as $module)
                <option value="{{$module->code}}">{{$module->code_module}}</option>
                @endforeach
              @endif
              </select>
           </div>
        <div class="control-group">
        <div class="controls">
            <label  class="form-label"><strong>Date de passage de l'examen:</strong></label>
            <div class="input-group">
                <input id="date_passage" name="date_passage" type="text" class="date-picker form-control" required/>
                <label id="label_passage" for="date_passage" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>
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
