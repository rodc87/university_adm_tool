@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
@endsection
@section('content')

<div class="content">
        <div class="header">
            <h1 class="page-title">Ajouter Contenu Module</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Gestion Modules</li>
            <li class="active">Modules</li>
            <li class="active">Ajouter Contenu Module</li>
        </ul>
        </div>
        <div class="main-content">

        {!! Form::open(array('action' => 'GestionModulesController@postajoutercontenumodule','id' => 'formid','enctype'=>'multipart/form-data')) !!}
        <div class="col-md-6 alert alert-info">
        <div class="alert alert-warning" style="width:100%;"><i class="fa fa-info-circle"></i>   Les contenus doivent impérativement être des paquetages zip.</div>
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
               @if (count($versions) > 0)
               <label  class="form-label"><strong>Version</strong></label>
               <select class="form-control" name="version" >
                 @foreach($versions as $version)
                 <option value="v{{$version}}">v{{$version}}</option>
                 @endforeach
               </select>
               @endif
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
