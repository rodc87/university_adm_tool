@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="content">
        <div class="header">
            <h1 class="page-title">Modifier Centre</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Gestion Centres</li>
            <li class="active">Centres</li>
            <li class="active">Modifier Centre</li>
        </ul>
        </div>
        <div class="main-content">
        {!! Form::open(array('action' => 'GestionCentresController@postmodifiercentre','id' => 'formid')) !!}
        <div class="col-md-6 alert alert-info">
          <div class="form-group">
          <input type="hidden" name="idcentre" value="{{$centre->id_centre}}" class="form-control"/>
          </div>
          <div class="form-group">
          <label><strong>Nom Centre</strong></label>
          <input type="text" name="nom_centre" value="{{$centre->nom_centre}}" class="form-control"/>
          </div>
          <div class="form-group">
          <label><strong>Pays</strong></label>
          <input type="text" name="pays" value="{{$centre->pays}}" class="form-control"/>
          </div>
          <div class="form-group">
          <label><strong>Ville</strong></label>
          <input type="text" name="ville" value="{{$centre->ville}}" class="form-control"/>
          </div>
          <div class="form-group">
          <label><strong>Nature</strong></label>
          {!! Form::select('nature', ['centre de référence' => 'centre de référence','centre associé' =>'centre associé'],$centre->nature,['class' => 'form-control']) !!}
          </br>
          </div>
             <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Modifier</button>
        </div>
        {!! Form::close() !!}
        </div>
</div>
@endsection
