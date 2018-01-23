  @extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
<script type="text/javascript">
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
})
</script>
@endsection
@section('content')

<div class="content">
        <div class="header">
            <h1 class="page-title">Utilisateurs</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Gestion Utilisateur</li>
            <li class="active">Utilisateurs</li>
        </ul>
        </div>
        <div class="main-content">
          {!! Form::open(array('action' => 'GestionUtilisateursController@postutilisateurs', 'class' =>'collapse form-inline','id' => 'formid')) !!}

            @if (count($allroles) > 0)
            <label  class="form-label"><strong>Role</strong></label>
            <select class="form-control" name="role" >
            <option>ALL</option>
              @foreach($allroles as $rl)
              <option>{{$rl->nom_role}}</option>
              @endforeach
            </select>
            @endif

            @if (count($allusernames) > 0)
            <label  class="form-label"><strong>Username</strong></label>
            <select class="form-control" name="username">
            <option>ALL</option>
              @foreach($allusernames as $usr)
              <option>{{$usr->username}}</option>
              @endforeach
            </select>
            @endif

            <button type="submit" class="btn btn-secondary" aria-label="Left Align">
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            Rechercher
            </button>
            </br>
            </br>

            {!! Form::close() !!}
          <a href="{{ url('/ajouterUtilisateur') }}" class="btn btn-primary btn-md">
          <span class="glyphicon glyphicon-plus"></span> Ajouter Utilisateur </a>
          <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#formid">
            <span class="glyphicon glyphicon-cog"></span> Recherche Avancée
          </button>
        </br>
        <div style="width: 100%;display: block;position: relative;float: left;margin-bottom:20px;padding-bottom:15px;border-bottom: 1px solid #dddddd;"></div>
        </br>
        </br>
        <div class="table-responsive">
        @if (count($utilisateurs) > 0)
        <table class="table">
          <thead style="font-weight:bold;">
            <tr>
              <th></th>
              <th>Utilisateur</th>
              <th>Nom</th>
              <th>Prenom</th>
              <th>Email</th>
              <th>Date entrée</th>
              <th>Date dernière mise à jour</th>
              <th>Utilisateur Actif</th>
              <th>Actions</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($utilisateurs as $utilisateur)
          	<tr>
              <td>
              @if($utilisateur->nom_role=='ADM')
              <span class="label label-danger"><span class="glyphicon glyphicon-user"></span>{{ $utilisateur->nom_role }}</span>
              @elseif($utilisateur->nom_role=='RESP')
              <span class="label label-primary"><span class="glyphicon glyphicon-user"></span>{{ $utilisateur->nom_role }}</span>
              @elseif($utilisateur->nom_role=='TUT')
              <span class="label label-warning"><span class="glyphicon glyphicon-user"></span>{{ $utilisateur->nom_role }}</span>
              @elseif($utilisateur->nom_role=='PERS')
              <span class="label label-info"><span class="glyphicon glyphicon-user"></span>{{ $utilisateur->nom_role }}</span>
              @elseif($utilisateur->nom_role=='SCOL')
              <span class="label label-info"><span class="glyphicon glyphicon-user"></span>{{ $utilisateur->nom_role }}</span>
              @elseif($utilisateur->nom_role=='ETU')
              <span class="label label-success"><span class="glyphicon glyphicon-user"></span>{{ $utilisateur->nom_role }}</span>
              @else
              <span class="label label-default"><span class="glyphicon glyphicon-user"></span>{{ $utilisateur->nom_role }}</span>
              @endif
              </td>
          		<td>{{ $utilisateur->username }}</td>
          		<td>{{ $utilisateur->nom }}</a></td>
              <td>{{ $utilisateur->prenom }}</td>
              <td>{{ $utilisateur->email }}</td>
              <td>{{ $utilisateur->date_entree }}</td>
              <td>{{ $utilisateur->last_update }}</td>
              <td style="text-align:center;">
                <div class="checkbox disabled">
                @if($utilisateur->status=='ENA')
                  <input type="checkbox" class="checked" disabled checked/>
                @else
                  <input type="checkbox" class="checked" disabled />
                @endif
                </div>
              </td>
              <td style="text-align:center;"><a href="{{ url('/modifierUtilisateur') }}/{{ $utilisateur->id_user }}"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Modifier"></span></a></td>
          	</tr>
          	@endforeach
          </tbody>
        </table>
        </div>
        @else
        <div class="noresuts"><strong>Aucun Utilisateur n'as encore été enregistré.</strong></div>
        @endif

        {!! str_replace('/?', '?', $utilisateurs->render()) !!}

        </div>
</div>

@endsection
