@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="content">
        <div class="header">
            <h1 class="page-title">Ajouter Categorie</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Gestion Modules</li>
            <li class="active">Categories</li>
            <li class="active">Ajouter Categorie</li>
        </ul>
        </div>
        <div class="main-content">
        {!! Form::open(array('action' => 'GestionModulesController@postajoutercategorie','id' => 'formid')) !!}
        <div class="col-md-6 alert alert-info">
              <div class="form-group">
              <label><strong>Nom Categorie</strong></label>
              <input type="text" name="categorie" value="" class="form-control"/>
              </div>
             <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Enregistrer</button>
        </div>
        {!! Form::close() !!}
        </div>
</div>
@endsection
