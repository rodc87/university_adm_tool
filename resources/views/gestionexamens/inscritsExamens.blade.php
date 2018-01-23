@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
@endsection
@section('content')

<div class="content">
        <div class="header">
            <h1 class="page-title">Inscrits aux Examens</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Examens</li>
            <li class="active">Inscrits aux Examens</li>
        </ul>
        </div>
        <div class="main-content">
        @if (count($allmodules) > 0 && count($centres) > 0)
          {!! Form::open(array('action' => 'GestionExamensController@postinscritsExamens', 'class' =>'collapse form-inline','id' => 'formid')) !!}

            @if (count($allmodules) > 0)
            <label  class="form-label"><strong>Module</strong></label>
            <select class="form-control" name="module">
            <option>ALL</option>
            @foreach($allmodules as $module)
            <option>{{$module->code}}</option>
            @endforeach
            </select>
            @endif

            @if (count($centres) > 0)
            <label  class="form-label"><strong>Centre de Passage</strong></label>
            <select class="form-control" name="centre">
            <option>ALL</option>
            @foreach($centres as $centre)
            <option value="{{$centre->nom_centre}}">{{$centre->nom_centre}}</option>
            @endforeach
            <option value="Autre">Autre</option>
            </select>
            @endif

            <button type="submit" class="btn btn-secondary" aria-label="Left Align">
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            Rechercher
            </button>
            </br>
            </br>

            {!! Form::close() !!}
            <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#formid">
              <span class="glyphicon glyphicon-cog"></span> Recherche Avancée
            </button>
            </br>
            <div style="width: 100%;display: block;position: relative;float: left;margin-bottom:20px;padding-bottom:15px;border-bottom: 1px solid #dddddd;"></div>
        @endif
        @if (count($examens) > 0)
        {!! Form::open(array('action' => 'GestionExamensController@inscrits_examens_exporter_excel', 'class' =>'form-inline','id' => 'form_export')) !!}
        <button id="export" class="btn btn-default btn-md" style="float:right;">
        <i class="fa fa-file-excel-o fa-3" style="color:#08743B"></i> Exporter</button>
        <input id="module_export" type="hidden" name="module_export" value="{{$mod}}"/>
        <input id="centre_export" type="hidden" name="centre_export" value="{{$ctr}}"/>
        {!! Form::close() !!}
                <table class="table">
                    <thead style="font-weight:bold;">
                      <tr>
                        <th>Code Semestre</th>
                        <th>Code Module</th>
                        <th>Nom Etudiant</th>
                        <th>Prenom Etudiant</th>
                        <th>Email</th>
                        <th>Date Inscription a l'Examen</th>
                        <th>Centre de Passage</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($examens as $examen)
                          <tr>
                            <td>{{ $examen->code_semestre }}</td>
                            <td><a href="#"> <span class="glyphicon glyphicon-unchecked"></span>{{ $examen->code_module }}</a></td>
                            <td>{{ $examen->nom_etudiant }}</td>
                            <td>{{ $examen->prenom_etudiant }}</td>
                            <td>{{ $examen->email }}</td>
                            <td>{{ $examen->date_inscription_examen }}</td>
                            <td>{{ $examen->nom_centre }}</td>
                          </tr>
                    @endforeach
                </tbody>
                </table>

        @else
        <div class="noresuts"><strong>Aucun Inscrit.</strong></div>
        @endif
        </div>

        {!! str_replace('/?', '?', $examens->render()) !!}
</div>

@endsection
