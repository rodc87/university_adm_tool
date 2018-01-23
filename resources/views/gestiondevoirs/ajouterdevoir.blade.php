@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
@endsection
@section('content')

<div class="content">
        <div class="header">
            <h1 class="page-title">Ajouter Devoir</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Gestion Devoirs</li>
            <li class="active">Devoirs</li>
            <li class="active">Ajouter Devoir</li>
        </ul>
        </div>
        <div class="main-content">

        {!! Form::open(array('action' => 'GestionDevoirsController@postajouterdevoir','id' => 'formid','enctype'=>'multipart/form-data')) !!}
        <div class="col-lg-10 alert alert-info">
        <div class="alert alert-warning" style="width:100%;"><i class="fa fa-info-circle"></i>&nbsp;- Les documents admissibles doivent comporter les extensions suivantes : '.pdf', '.PDF', '.doc', '.DOC', '.docx', '.DOCX', '.zip', '.ZIP', '.rar', '.RAR'. </br>&nbsp; - Il est conseillé d'utiliser le format activite[#]_[module]_[semestre].[ext] pour nommer le fichier d'activite &nbsp;<strong>  e.g: activite1_C215_2015S2.pdf</strong></br>&nbsp; - Il est conseillé d'utiliser le format Activite n°[#] pour le titre des activites &nbsp;<strong> e.g: Activite n°1</strong></div>
             <div class="form-group">
               @if (count($allsemestres) > 0)
               <label  class="form-label"><strong>Semestre</strong></label>
               <select class="form-control" name="semestre" >
                 @foreach($allsemestres as $semestre)
                 <option value="{{$semestre->code_semestre}}">{{$semestre->code_semestre}}</option>
                 @endforeach
               </select>
               @endif
            </div>
            <div class="form-group">
              @if (count($allmodules) > 0)
              <label  class="form-label"><strong>Module</strong></label>
              <select class="form-control" name="code" >
                @foreach($allmodules as $module)
                <option value="{{$module->code}}">{{$module->code}}</option>
                @endforeach
              </select>
              @endif
           </div>
           <div class="form-group">
             <label  class="form-label"><strong>Titre Devoir</strong></label>
             <input type="text" name="titre_act" value="" class="form-control"/>
          </div>
            <div class="form-group">
            <label  class="form-label"><strong>Document</strong></label>
            <input type="file" name="filefield">
            </div>
            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Enregistrer</button>
        </div>
        {!! Form::close() !!}
        </div>
</div>
@endsection
