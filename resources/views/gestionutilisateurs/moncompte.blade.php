@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
@endsection
@section('content')

<div class="content">
        <div class="header">
            <h1 class="page-title">Mon Compte</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Gestion Utilisateur</li>
            <li class="active">Mon Compte</li>
        </ul>
        </div>

<div class="main-content">
{!! Form::open(array('action' => 'GestionUtilisateursController@postcompte', 'id' =>'attributs_utilisateur')) !!}
<ul class="nav nav-tabs">
  <li class="active"><a href="#home" data-toggle="tab">Compte</a></li>
  <li><a href="#profile" data-toggle="tab">Mot de Passe</a></li>
</ul>

<div>
  <div class="col-lg-10">
    <br>
    <div id="myTabContent" class="tab-content">
    @if(count($user)>0)
            @if (Auth::user()->Role->nom_role == 'ADM')
              <div class="tab-pane active in" id="home">
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Nom Utilisateur</strong></label>
                    <input type="text" name="nom_utilisateur" value="{{$user->nom_admin}}"class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Prenom Utilisateur</strong></label>
                    <input type="text" name="prenom_utilisateur" value="{{$user->prenom_admin}}" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Email</strong></label>
                    <input type="text" name="email" value="{{$user->email}}" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Telephone</strong></label>
                    <input type="text" name="telephone" value="{{$user->telephone}}" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Adresse Postale</strong></label>
                    <textarea rows="3" name="addresse_postale" class="form-control">{{$user->addresse_postale}}</textarea>
                    </div>
                    <div class="form-group">
                    <label><strong>Date Entree</strong></label>
                    <label class="disabled">{{$user->date_entree}}</label>
                    </br>
                    </div>
                </div>
              </div>
            @elseif (Auth::user()->Role->nom_role == 'ETU')
              <div class="tab-pane active in" id="home">
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Nom Utilisateur</strong></label>
                    <input type="text" name="nom_utilisateur" value="{{$user->nom_etudiant}}"class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Prenom Utilisateur</strong></label>
                    <input type="text" name="prenom_utilisateur" value="{{$user->prenom_etudiant}}" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Email</strong></label>
                    <input type="text" name="email" value="{{$user->email}}" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Telephone</strong></label>
                    <input type="text" name="telephone" value="{{$user->telephone}}" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Adresse Postale</strong></label>
                    <textarea rows="3" name="addresse_postale" class="form-control">{{$user->addresse_postale}}</textarea>
                    </div>
                    <div class="form-group">
                    <label><strong>Date Entree</strong></label>
                    <label class="disabled">{{$user->date_entree}}</label>
                    </div>
                    <div class="form-group">
                    <label><strong>Niveau Etudes</strong></label>
                    <label class="disabled">{{$user->niveau_etudes}}</label>
                    </br>
                    </div>
                </div>
            </div>
            @elseif (Auth::user()->Role->nom_role == 'RESP')
            <div class="tab-pane active in" id="home">
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Nom Utilisateur</strong></label>
                    <input type="text" name="nom_utilisateur" value="{{$user->nom_responsable}}"class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Prenom Utilisateur</strong></label>
                    <input type="text" name="prenom_utilisateur" value="{{$user->prenom_responsable}}" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Email</strong></label>
                    <input type="text" name="email" value="{{$user->email}}" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Telephone</strong></label>
                    <input type="text" name="telephone" value="{{$user->telephone}}" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Adresse Postale</strong></label>
                    <textarea rows="3" name="addresse_postale" class="form-control">{{$user->addresse_postale}}</textarea>
                    </div>
                    <div class="form-group">
                    <label><strong>Date Entree</strong></label>
                    <label class="disabled">{{$user->date_entree}}</label>
                    </div>
                    <div class="form-group">
                    <label><strong>Type de Responsable</strong></label>
                    <label class="disabled">{{$user->type_responsable}}</label>
                    </div>
                </div>
            </div>
            @elseif (Auth::user()->Role->nom_role == 'TUT')
            <div class="tab-pane active in" id="home">
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Nom Utilisateur</strong></label>
                    <input type="text" name="nom_utilisateur" value="{{$user->nom_tuteur}}"class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Prenom Utilisateur</strong></label>
                    <input type="text" name="prenom_utilisateur" value="{{$user->prenom_tuteur}}" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Email</strong></label>
                    <input type="text" name="email" value="{{$user->email}}" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Telephone</strong></label>
                    <input type="text"  name="telephone" value="{{$user->telephone}}" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Adresse Postale</strong></label>
                    <textarea rows="3" name="addresse_postale" class="form-control">{{$user->addresse_postale}}</textarea>
                    </div>
                    <div class="form-group">
                    <label><strong>Date Entree</strong></label>
                    <label class="disabled">{{$user->date_entree}}</label>
                    </br>
                    </div>
                </div>
            </div>
            @elseif (Auth::user()->Role->nom_role == 'SCOL')
            <div class="tab-pane active in" id="home">
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Nom Utilisateur</strong></label>
                    <input type="text" name="nom_utilisateur" value="{{$user->nom_personnel}}"class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Prenom Utilisateur</strong></label>
                    <input type="text" name="prenom_utilisateur" value="{{$user->prenom_personnel}}" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Email</strong></label>
                    <input type="text" name="email" value="{{$user->email}}" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Telephone</strong></label>
                    <input type="text" name="telephone" value="{{$user->telephone}}" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Adresse Postale</strong></label>
                    <textarea rows="3" name="addresse_postale" class="form-control">{{$user->addresse_postale}}</textarea>
                    </div>
                    <div class="form-group">
                    <label><strong>Date Entree</strong></label>
                    <label class="disabled">{{$user->date_entree}}</label>
                    </br>
                    </div>
                </div>
            </div>
            @elseif (Auth::user()->Role->nom_role == 'PERS')
            <div class="tab-pane active in" id="home">
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Nom Utilisateur</strong></label>
                    <input type="text" name="nom_utilisateur" value="{{$user->nom_personnel}}"class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Prenom Utilisateur</strong></label>
                    <input type="text" name="prenom_utilisateur" value="{{$user->prenom_personnel}}" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Email</strong></label>
                    <input type="text" name="email" value="{{$user->email}}" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Telephone</strong></label>
                    <input type="text" name="telephone" value="{{$user->telephone}}" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Adresse Postale</strong></label>
                    <textarea rows="3" name="addresse_postale" class="form-control">{{$user->addresse_postale}}</textarea>
                    </div>
                    <div class="form-group">
                    <label><strong>Date Entree</strong></label>
                    <label class="disabled">{{$user->date_entree}}</label>
                    </br>
                    </div>
                </div>
            </div>
            @else
            @endif
    @endif

    <div class="tab-pane fade" id="profile">
          <div class="form-group col-md-6">
            <label><strong>Modifier Mot de Passe</strong></label>
            <input type="password" name="password" class="form-control">
          </div>
      </div>
    </div>

    <div class="btn-toolbar list-toolbar row">
      <div class="col-md-3">
        <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Modifier</button>
      </div>
      <div class="col-md-3">
        <a href="{{ url('/home') }}" class="btn btn-danger"><i class="glyphicon glyphicon-arrow-left"></i>Annuler</a>
      </div>
    </div>
  </div>
</div>
{!! Form::close() !!}
</div>
</div>

@endsection
