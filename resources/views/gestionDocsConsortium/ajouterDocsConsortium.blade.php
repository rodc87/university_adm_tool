@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
<script src="{{ asset('/js/jquery.validate.js') }}"></script>
<script text="javascript">
$(function (){

      $('#formid').validate({wrapper: 'li',messages:{
        nom_document:"Le champ nom document est obligatoire",
        description_document:"Le champ description document est obligatoire",
        type_document:"Le champ type document est obligatoire",
        filefield:"Le champ document est obligatoire",
      },errorLabelContainer: '#errors'
      });

      $('.close').click(function() {
         $('#errors').hide('slow');
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
            <h1 class="page-title">Ajouter Document</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Documents Consortium</li>
            <li class="active">Ajouter Document</li>
        </ul>
        </div>
        <div class="main-content">
        {!! Form::open(array('action' => 'GestionDocsConsortiumController@postDocsConsortiumAjout','id' => 'formid','enctype'=>'multipart/form-data')) !!}
        <div class="col-lg-10 alert alert-info">
        <div class="alert alert-warning" style="width:100%;"><i class="fa fa-info-circle"></i>&nbsp;- Les documents admissibles doivent comporter les extensions suivantes : '.pdf', '.PDF', '.doc', '.DOC', '.docx', '.DOCX', '.zip', '.ZIP', '.rar', '.RAR'. </br>&nbsp; - Il est conseillé d'utiliser le format Document[#]_[semestre].[ext] pour nommer le fichier &nbsp;<strong>  e.g: Document1_2015S2.pdf</strong></br>&nbsp; - Il est conseillé d'utiliser le format Document n°[#] pour le nom des documents &nbsp;<strong> e.g: Document n°1</strong></div>
            <div class="form-group">
                <label  class="form-label"><strong>Nom Document</strong></label>
                <input  id="nom_document" type="text" name="nom_document" value="" class="form-control" required/>
            </div>
            <div class="form-group">
               <label  class="form-label"><strong>Description Document</strong></label>
               <input id="description_document" type="text" name="description_document" value="" class="form-control" required/>
            </div>
            <div class="form-group">
              <label  class="form-label"><strong>Type Document</strong></label>
              <input id="type_document" type="text" name="type_document" value="" class="form-control" required/>
           </div>
            <div class="form-group">
            <label  class="form-label"><strong>Document</strong></label>
            <input  id="filefield"  type="file" name="filefield" required>
            </div>
            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Enregistrer</button>
        </div>
        {!! Form::close() !!}
        </div>
</div>
@endsection
