@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
@endsection
@section('content')

<div class="content">
    <div class="header">
            <h1 class="page-title">Modifier Utilisateur</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Gestion Utilisateur</li>
            <li class="active">Utilisateurs</li>
            <li class="active">Modifier Utilisateur</li>
    </ul>
</div>

<div class="main-content">
{!! Form::open(array('action' => 'GestionUtilisateursController@postmodifierutilisateur', 'id' =>'attributs_utilisateur')) !!}
<div>
  <div class="col-lg-10">
    <br>
    <div id="myTabContent" class="tab-content">
    @if(count($user)>0 && count($usr)>0)
              <div class="inline" id="identifiantssite">
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Nom Acces au Site</strong></label>
                    <input type="text" name="nomaccessutilisateur" value="{{$usr->username}}" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Password</strong></label>
                    <input type="password" name="password" value="{{$usr->password}}" class="form-control"/>
                    </div>
                </div>
                <input type="text" name="idgeneraluser"  value="{{$idgeneraluser}}" class="form-control" style="display:none;"/>
                <input type="text" name="idspecificuser" value="{{$idspecificuser}}" class="form-control" style="display:none;"/>
                <input type="text" name="role" value="{{$role}}" class="form-control" style="display:none;"/>
              </div>
              @if ($usr->Role->nom_role == 'ADM')
              <!--Administrateur-->
              <div class="tab-pane active in" id="admin_data">
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Nom Utilisateur</strong></label>
                    <input type="text" name="nom_utilisateur" value="{{$user->nom_admin}}" class="form-control"/>
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
                    <textarea rows="1" name="addresse_postale" class="form-control">{{$user->addresse_postale}}</textarea>
                    </div>
                    <div class="form-group">
                    <label><strong>Utilisateur Actif</strong></label>
                      <div>
                      @if($status =='ENA')
                        <input type="checkbox" name="status" checked/>
                      @else
                        <input type="checkbox" name="status" />
                      @endif
                      </div>
                    </div>
                </div>
              </div>
              @elseif ($usr->Role->nom_role == 'ETU')
              <!--Etudiant-->
              <div class="tab-pane active in" id="etu_data">
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Nom Utilisateur</strong></label>
                    <input type="text" name="nom_utilisateur" value="{{$user->nom_etudiant}}" class="form-control"/>
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
                    <textarea rows="1" name="addresse_postale" class="form-control">{{$user->addresse_postale}}</textarea>
                    </div>
                    <div class="form-group">
                    <label><strong>Niveau Etudes</strong></label>
                    {!! Form::select('niveau_etudes', ['L3-EMIAGE' => 'L3-EMIAGE','M1-EMIAGE' => 'M1-EMIAGE','M2-EMIAGE' => 'M2-EMIAGE' ], $user->niveau_etudes, ['class' => 'form-control form-inline']) !!}
                    </div>
                    <div class="form-group">
                    <label><strong>Centre</strong></label>
                    {!! Form::select('centre',$centres,$centre,['class' => 'form-control form-inline']) !!}
                    </div>
                    <div class="form-group">
                    <label><strong>Utilisateur Actif</strong></label>
                      <div>
                      @if($status =='ENA')
                        <input type="checkbox" name="status" checked/>
                      @else
                        <input type="checkbox" name="status" />
                      @endif
                      </div>
                    </div>
                </div>
            </div>
            @elseif ($usr->Role->nom_role == 'RESP')
            <!--Responsable-->
            <div class="tab-pane active in" id="resp_data">
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Nom Utilisateur</strong></label>
                    <input type="text" name="nom_utilisateur" value="{{$user->nom_responsable}}" class="form-control"/>
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
                    <textarea rows="1" name="addresse_postale" class="form-control">{{$user->addresse_postale}}</textarea>
                    </div>
                    <div class="form-group">
                    <label><strong>Type de Responsable</strong></label>
                    {!! Form::select('type_responsable', ['Administratif' => 'Administratif','Formation' => 'Formation','Module' => 'Module'], $user->type_responsable, ['class' => 'form-control form-inline']) !!}
                    </div>
                    <div class="form-group">
                    <label><strong>Centre</strong></label>
                    {!! Form::select('centre',$centres,$centre,['class' => 'form-control form-inline']) !!}
                    </div>
                    <div class="form-group">
                    <label><strong>Utilisateur Actif</strong></label>
                    <div>
                      @if($status =='ENA')
                        <input type="checkbox" name="status" checked/>
                      @else
                        <input type="checkbox" name="status" />
                      @endif
                    </div>
                    </div>
                </div>
            </div>
            @elseif ($usr->Role->nom_role == 'TUT')
            <!--Tuteur-->
            <div class="tab-pane active in" id="tut_data">
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Nom Utilisateur</strong></label>
                    <input type="text" name="nom_utilisateur" value="{{$user->nom_tuteur}}" class="form-control"/>
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
                    <input type="text" name="telephone" value="{{$user->telephone}}" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Adresse Postale</strong></label>
                    <textarea rows="1" name="addresse_postale" class="form-control">{{$user->addresse_postale}}</textarea>
                    </div>
                    <div class="form-group">
                    <label><strong>Centre</strong></label>
                    {!! Form::select('centre',$centres,$centre,['class' => 'form-control form-inline']) !!}
                    </div>
                    <div class="form-group">
                    <label><strong>Utilisateur Actif</strong></label>
                      <div>
                      @if($status =='ENA')
                        <input type="checkbox" name="status" checked/>
                      @else
                        <input type="checkbox" name="status" />
                      @endif
                      </div>
                    </div>
                </div>
            </div>
            @elseif ($usr->Role->nom_role == 'SCOL')
            <!--Scolarite-->
            <div class="tab-pane active in" id="scol_data">
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Nom Utilisateur</strong></label>
                    <input type="text" name="nom_utilisateur" value="{{$user->nom_personnel}}" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Prenom Utilisateur</strong></label>
                    <input type="text" name="prenom_utilisateur"  value="{{$user->prenom_personnel}}" class="form-control"/>
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
                    <textarea rows="1" name="addresse_postale" class="form-control">{{$user->addresse_postale}}</textarea>
                    </div>
                    <div class="form-group">
                    <label><strong>Centre</strong></label>
                    {!! Form::select('centre',$centres,$centre,['class' => 'form-control form-inline']) !!}
                    </div>
                    <div class="form-group">
                    <label><strong>Utilisateur Actif</strong></label>
                      <div>
                      @if($status =='ENA')
                        <input type="checkbox" name="status" checked/>
                      @else
                        <input type="checkbox" name="status" />
                      @endif
                      </div>
                    </div>
                </div>
            </div>
            @elseif ($usr->Role->nom_role == 'PERS')
            <!--Personnel Admis-->
            <div class="tab-pane active in" id="pers_data">
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Nom Utilisateur</strong></label>
                    <input type="text" name="nom_utilisateur" value="{{$user->nom_personnel}}" class="form-control"/>
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
                    <textarea rows="1" name="addresse_postale" class="form-control">{{$user->addresse_postale}}</textarea>
                    </div>
                    <div class="form-group">
                    <label><strong>Centre</strong></label>
                    {!! Form::select('centre',$centres,$centre,['class' => 'form-control form-inline']) !!}
                    </div>
                    <div class="form-group">
                    <label><strong>Utilisateur Actif</strong></label>
                    <div>
                      @if($status =='ENA')
                        <input type="checkbox" name="status" checked/>
                      @else
                        <input type="checkbox" name="status" />
                      @endif
                    </div>
                    </div>
                </div>
            </div>
            @else
            @endif
    @endif
    </div>

    <div class="btn-toolbar list-toolbar row" id="buttons">
      <div class="col-md-3">
        <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i>Modifier</button>
      </div>
      <div class="col-md-3">
        <a href="{{ url('/utilisateurs') }}" class="btn btn-danger"><i class="glyphicon glyphicon-arrow-left"></i>Annuler</a>
      </div>
    </div>
  </div>
</div>
{!! Form::close() !!}
</div>
</div>

@endsection
