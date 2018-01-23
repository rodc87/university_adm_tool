@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="content">
        <div class="header">
            <h1 class="page-title">Ajouter Module</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Gestion Modules</li>
            <li class="active">Modules</li>
            <li class="active">Ajouter Module</li>
        </ul>
        </div>
        <div class="main-content">
        {!! Form::open(array('action' => 'GestionModulesController@postajoutermodule','id' => 'formid')) !!}
        <div class="col-md-6 alert alert-info">
              <div class="form-group">
              <label><strong>Code Module</strong></label>
              <input type="text" name="code" value="" maxlength="6" class="form-control"/>
              </div>
              <div class="form-group">
              <label><strong>Nom Module</strong></label>
              <input type="text" name="nommodule" value="" class="form-control"/>
              </div>
              <div class="form-group">
                @if (count($allcategories) > 0)
                <label  class="form-label"><strong>Categorie</strong></label>
                <select class="form-control" name="categorie" >
                  @foreach($allcategories as $categorie)
                  <option value="{{$categorie->id_cat}}">{{$categorie->categorie}}</option>
                  @endforeach
                </select>
                @endif
             </div>
             <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Enregistrer</button>
        </div>
        {!! Form::close() !!}
        </div>
</div>
@endsection
