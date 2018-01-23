@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
@endsection
@section('content')

<div class="content">
        <div class="header">
            <h1 class="page-title">Modifier Responsable Module</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Gestion Modules</li>
            <li class="active">Responsables</li>
            <li class="active">Modifier Responsable Module</li>
        </ul>
        </div>
        <div class="main-content">

        {!! Form::open(array('action' => 'GestionModulesController@postmodifierresponsablemodule','id' => 'formid','enctype'=>'multipart/form-data')) !!}
        <div class="col-md-6 alert alert-info">
              <div class="form-group">
                @if (count($allmodules) > 0)
                <label  class="form-label"><strong>Module</strong></label>
                {!! Form::select('code',$allmodules,$code,['class' => 'form-control form-inline']) !!}
                @endif
             </div>
             <div class="form-group">
               @if (count($allresponsables) > 0)
               <label  class="form-label"><strong>Responsable</strong></label>
               {!! Form::select('responsable',$allresponsables,$id_resp,['class' => 'form-control form-inline']) !!}
               @endif
            </div>
            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Enregistrer</button>
        </div>
        {!! Form::close() !!}
        </div>
</div>
@endsection
