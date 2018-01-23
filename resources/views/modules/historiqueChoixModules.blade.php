@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
@endsection
@section('content')

<div class="content">
        <div class="header">
            <h1 class="page-title">Historique des Choixs</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Modules de formation</li>
            <li class="active">Historique des Choixs</li>
        </ul>
        </div>
        <div class="main-content">

        @if (count($choix) > 0)

            <?php $semestre=null; $prevsemestre=null; ?>

            @for($i=0; $i<count($choix);$i++)
              @if($i==0)
                <?php $semestre=$choix[$i]; $prevsemestre=$choix[$i]; ?>
                <h4><span class="label label-primary">{{$semestre->code_semestre}}</span></h4>
                <table class="table">
                <thead style="font-weight:bold;">
                  <tr>
                    <th>Code Module</th>
                    <th>Date d'inscription du choix</th>
                  </tr>
                </thead>
                <tbody>
              @else
              <div></div>
               <?php $semestre=$choix[$i]; ?>
              @endif

              @if($semestre->code_semestre==$prevsemestre->code_semestre)
                    <tr>
                      <td><a href="#"> <span class="glyphicon glyphicon-unchecked"></span>{{ $semestre->code_module }}</a></td>
                      <td>{{ $semestre->date_inscription_choix }}</td>
                    </tr>
                @else
                <?php $prevsemestre=$choix[$i]; ?>
                </tbody>
                </table>

                <h4><span class="label label-default">{{$semestre->code_semestre}}</span></h4>
                <table class="table">
                <thead style="font-weight:bold;">
                      <tr>
                        <th>Code Module</th>
                        <th>Date d'inscription du choix</th>
                      </tr>
                </thead>
                <tbody>
                <tr>
                      <td><a href="#"> <span class="glyphicon glyphicon-unchecked"></span>{{ $semestre->code_module }}</a></td>
                      <td>{{ $semestre->date_inscription_choix }}</td>
                </tr>

              @endif


            @endfor
        </tbody>
        </table>

        @else
        <div class="noresuts"><strong>Aucun choix n'as encore été enregistré.</strong></div>
        @endif
        </div>
</div>

@endsection
