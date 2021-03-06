@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="content">
        <div class="header">
            <h1 class="page-title">Ajouter Semestre</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Gestion Semestres</li>
            <li class="active">Semestres</li>
            <li class="active">Ajouter Semestre</li>
        </ul>
        </div>
        <div class="main-content">
        {!! Form::open(array('action' => 'GestionSemestresController@postajoutersemestre','id' => 'formid')) !!}
        <div class="col-md-6 alert alert-info">
              <div class="alert alert-warning" style="width:100%;"><i class="fa fa-info-circle"></i> Il est conseillé d'utiliser le format [année][semestre] pour nommer les semestres &nbsp;  <strong>  e.g: 2015S1</strong></div>  
              <div class="form-group">
              <label><strong>Nom Semestre</strong></label>
              <input type="text" name="semestre" value="" class="form-control"/>
              </div>
             <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Enregistrer</button>
        </div>
        {!! Form::close() !!}
        </div>
</div>
@endsection
