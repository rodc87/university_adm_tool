@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
@endsection
@section('content')

<div class="content">
        <div class="header">
            <h1 class="page-title">Ajouter Responsable Module</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Gestion Modules</li>
            <li class="active">Responsables</li>
            <li class="active">Ajouter Responsable Module</li>
        </ul>
        </div>
        <div class="main-content">

        {!! Form::open(array('action' => 'GestionModulesController@postajouterresponsablemodule','id' => 'formid','enctype'=>'multipart/form-data')) !!}
        <div class="col-md-6 alert alert-info">
              <div class="form-group">
                @if (count($allmodules) > 0)
                <label  class="form-label"><strong>Module</strong></label>
                <select class="form-control" name="code" >
                  @foreach($allmodules as $module)
                  <option value="{{$module->code}}">{{$module->code}} - {{$module->nom_module}}</option>
                  @endforeach
                </select>
                @endif
             </div>
             <div class="form-group">
               @if (count($allresponsables) > 0)
               <label  class="form-label"><strong>Responsable</strong></label>
               <select class="form-control" name="responsable" >
                 @foreach($allresponsables as $resp)
                 <option value="{{$resp->id_responsable}}">{{$resp->prenom_responsable}}&nbsp;{{$resp->nom_responsable}}</option>
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
