@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
@endsection
@section('content')

<div class="content">
        <div class="header">
            <h1 class="page-title">Ajouter Tuteur Module</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Gestion Modules</li>
            <li class="active">Tuteurs</li>
            <li class="active">Ajouter Tuteur Module</li>
        </ul>
        </div>
        <div class="main-content">

        {!! Form::open(array('action' => 'GestionModulesController@postajoutertuteurmodule','id' => 'formid','enctype'=>'multipart/form-data')) !!}
        <div class="col-md-6 alert alert-info">
              <div class="form-group">
                @if (count($allmodules) > 0)
                <label  class="form-label"><strong>Module</strong></label>
                {!! Form::select('code',$allmodules,null,['class' => 'form-control form-inline']) !!}
                @endif
             </div>
             <div class="form-group">
               @if (count($alltuteurs) > 0)
               <label  class="form-label"><strong>Tuteur</strong></label>
               {!! Form::select('tuteur',$alltuteurs,null,['class' => 'form-control form-inline']) !!}
               @endif
            </div>
            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Enregistrer</button>
        </div>
        {!! Form::close() !!}
        </div>
</div>
@endsection
