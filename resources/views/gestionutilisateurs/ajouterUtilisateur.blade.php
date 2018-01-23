@extends('app')
@section('head')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
<script text="javascript">
        $(function () {

          $('#roles').on("change", function() {
                  var rol = $(this).val();
                  optionswitch(rol);
          });


          function optionswitch(myfilter)
          {
              //clear values
              $('#myTabContent').find('input').val('');
              $('#myTabContent').find('textarea').val('');
              $('#myTabContent').find('input').attr('disabled', 'disabled');
              $('#myTabContent').find('textarea').attr('disabled', 'disabled');
              $('#myTabContent').find('select').attr('disabled', 'disabled');

              if(myfilter=="ADM")
              {
                $('#admin_data').removeClass('hidden');
                $('#admin_data').find('input').removeAttr('disabled');
                $('#admin_data').find('textarea').removeAttr('disabled');
                $('#etu_data').addClass('hidden');
                $('#resp_data').addClass('hidden');
                $('#tut_data').addClass('hidden');
                $('#scol_data').addClass('hidden');
                $('#pers_data').addClass('hidden');
                $('#identifiantssite').removeClass('hidden');
                $('#identifiantssite').find('input').removeAttr('disabled');
                $('#buttons').removeClass('hidden');
              }
              if(myfilter=="ETU")
              {
                $('#admin_data').addClass('hidden');
                $('#etu_data').removeClass('hidden');
                $('#etu_data').find('input').removeAttr('disabled');
                $('#etu_data').find('textarea').removeAttr('disabled');
                $('#etu_data').find('select').removeAttr('disabled');
                $('#resp_data').addClass('hidden');
                $('#tut_data').addClass('hidden');
                $('#scol_data').addClass('hidden');
                $('#pers_data').addClass('hidden');
                $('#identifiantssite').removeClass('hidden');
                $('#identifiantssite').find('input').removeAttr('disabled');
                $('#buttons').removeClass('hidden');

              }
              if(myfilter=="RESP")
              {
                $('#admin_data').addClass('hidden');
                $('#etu_data').addClass('hidden');
                $('#resp_data').removeClass('hidden');
                $('#resp_data').find('input').removeAttr('disabled');
                $('#resp_data').find('textarea').removeAttr('disabled');
                $('#resp_data').find('select').removeAttr('disabled');
                $('#tut_data').addClass('hidden');
                $('#scol_data').addClass('hidden');
                $('#pers_data').addClass('hidden');
                $('#identifiantssite').removeClass('hidden');
                $('#identifiantssite').find('input').removeAttr('disabled');
                $('#buttons').removeClass('hidden');
              }
              if(myfilter=="TUT")
              {
                $('#admin_data').addClass('hidden');
                $('#etu_data').addClass('hidden');
                $('#resp_data').addClass('hidden');
                $('#tut_data').removeClass('hidden');
                $('#tut_data').find('input').removeAttr('disabled');
                $('#tut_data').find('textarea').removeAttr('disabled');
                $('#tut_data').find('select').removeAttr('disabled');
                $('#scol_data').addClass('hidden');
                $('#pers_data').addClass('hidden');
                $('#identifiantssite').removeClass('hidden');
                $('#identifiantssite').find('input').removeAttr('disabled');
                $('#buttons').removeClass('hidden');
              }
              if(myfilter=="SCOL")
              {
                $('#admin_data').addClass('hidden');
                $('#etu_data').addClass('hidden');
                $('#resp_data').addClass('hidden');
                $('#tut_data').addClass('hidden');
                $('#scol_data').removeClass('hidden');
                $('#scol_data').find('input').removeAttr('disabled');
                $('#scol_data').find('textarea').removeAttr('disabled');
                $('#scol_data').find('select').removeAttr('disabled');
                $('#pers_data').addClass('hidden');
                $('#identifiantssite').removeClass('hidden');
                $('#identifiantssite').find('input').removeAttr('disabled');
                $('#buttons').removeClass('hidden');

              }
              if(myfilter=="PERS")
              {
                $('#admin_data').addClass('hidden');
                $('#etu_data').addClass('hidden');
                $('#resp_data').addClass('hidden');
                $('#tut_data').addClass('hidden');
                $('#scol_data').addClass('hidden');
                $('#pers_data').removeClass('hidden');
                $('#pers_data').find('input').removeAttr('disabled');
                $('#pers_data').find('textarea').removeAttr('disabled');
                $('#pers_data').find('select').removeAttr('disabled');
                $('#identifiantssite').removeClass('hidden');
                $('#identifiantssite').find('input').removeAttr('disabled');
                $('#buttons').removeClass('hidden');
              }

          }

        });

</script>
@endsection
@endsection
@section('content')

<div class="content">
    <div class="header">
            <h1 class="page-title">Ajouter Utilisateur</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Gestion Utilisateur</li>
            <li class="active">Utilisateurs</li>
            <li class="active">Ajouter Utilisateur</li>
    </ul>
</div>

<div class="main-content">
{!! Form::open(array('action' => 'GestionUtilisateursController@postajouterutilisateur', 'id' =>'attributs_utilisateur')) !!}

<div "type_utilisateur" class="form-inline">
@if (count($roles) > 0)
<label  class="form-label"><strong>Type Utilisateur</strong></label>
<select class="form-control" name="roles" id="roles" >
  <option value="0">-------------------Type Utilisateur-------------------</option>
  @foreach($roles as $role)
  <option value="{{$role->nom_role}}">{{$role->description_role}}</option>
  @endforeach
  </select>
@endif
</div>
<div style="width: 100%;display: block;position: relative;float: left;margin-bottom:5px;padding-bottom:10px;border-bottom: 1px solid #dddddd;"></div>
<div>
  <div class="col-lg-10">
    <br>
    <div id="myTabContent" class="tab-content">
              <div class="inline hidden" id="identifiantssite">
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Nom Acces au Site</strong></label>
                    <input type="text" name="nomaccessutilisateur" value=""class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Password</strong></label>
                    <input type="password" name="password" value="" class="form-control"/>
                    </div>
                </div>
              </div>
              <!--Administrateur-->
              <div class="tab-pane active in hidden" id="admin_data">
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Nom Utilisateur</strong></label>
                    <input type="text" name="nom_utilisateur" value=""class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Prenom Utilisateur</strong></label>
                    <input type="text" name="prenom_utilisateur" value="" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Email</strong></label>
                    <input type="text" name="email" value="" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Telephone</strong></label>
                    <input type="text" name="telephone" value="" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Adresse Postale</strong></label>
                    <textarea rows="3" name="addresse_postale" class="form-control"></textarea>
                    </div>
                </div>
              </div>
              <!--Etudiant-->
              <div class="tab-pane active in hidden" id="etu_data">
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Nom Utilisateur</strong></label>
                    <input type="text" name="nom_utilisateur" value="" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Prenom Utilisateur</strong></label>
                    <input type="text" name="prenom_utilisateur" value="" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Email</strong></label>
                    <input type="text" name="email" value="" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Telephone</strong></label>
                    <input type="text" name="telephone" value="" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Adresse Postale</strong></label>
                    <textarea rows="1" name="addresse_postale" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                    <label><strong>Niveau Etudes</strong></label>
                    <select class="form-control form-inline" name="niveau_etudes" >
                      <option>L3-EMIAGE</option>
                      <option>M1-EMIAGE</option>
                      <option>M2-EMIAGE</option>
                    </select>
                    </div>
                    <div class="form-group">
                    <label><strong>Centre</strong></label>
                    {!! Form::select('centre',$centres,null,['class' => 'form-control form-inline']) !!}
                    </div>
                </div>
            </div>
            <!--Responsable-->
            <div class="tab-pane active in hidden" id="resp_data">
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Nom Utilisateur</strong></label>
                    <input type="text" name="nom_utilisateur" value="" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Prenom Utilisateur</strong></label>
                    <input type="text" name="prenom_utilisateur" value="" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Email</strong></label>
                    <input type="text" name="email" value="" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Telephone</strong></label>
                    <input type="text" name="telephone" value="" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Adresse Postale</strong></label>
                    <textarea rows="1" name="addresse_postale" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                    <label><strong>Type de Responsable</strong></label>
                    <select class="form-control form-inline" name="type_responsable" >
                      <option>Administratif</option>
                      <option>Formation</option>
                      <option>Module</option>
                    </select>
                    </div>
                    <div class="form-group">
                    <label><strong>Centre</strong></label>
                    {!! Form::select('centre',$centres,null,['class' => 'form-control form-inline']) !!}
                    </div>
                </div>
            </div>
            <!--Tuteur-->
            <div class="tab-pane active in hidden" id="tut_data">
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Nom Utilisateur</strong></label>
                    <input type="text" name="nom_utilisateur" value=""class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Prenom Utilisateur</strong></label>
                    <input type="text" name="prenom_utilisateur" value="" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Email</strong></label>
                    <input type="text" name="email" value="" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Telephone</strong></label>
                    <input type="text" name="telephone" value="" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Adresse Postale</strong></label>
                    <textarea rows="1" name="addresse_postale" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                    <label><strong>Centre</strong></label>
                    {!! Form::select('centre',$centres,null,['class' => 'form-control form-inline']) !!}
                    </div>
                </div>
            </div>
            <!--Scolarite-->
            <div class="tab-pane active in hidden" id="scol_data">
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Nom Utilisateur</strong></label>
                    <input type="text" name="nom_utilisateur" value=""class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Prenom Utilisateur</strong></label>
                    <input type="text" name="prenom_utilisateur" value="" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Email</strong></label>
                    <input type="text" name="email" value="" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Telephone</strong></label>
                    <input type="text" name="telephone" value="" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Adresse Postale</strong></label>
                    <textarea rows="1" name="addresse_postale" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                    <label><strong>Centre</strong></label>
                    {!! Form::select('centre',$centres,null,['class' => 'form-control form-inline']) !!}
                    </div>
                </div>
            </div>
            <!--Personnel Admis-->
            <div class="tab-pane active in hidden" id="pers_data">
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Nom Utilisateur</strong></label>
                    <input type="text" name="nom_utilisateur" value=""class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Prenom Utilisateur</strong></label>
                    <input type="text" name="prenom_utilisateur" value="" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Email</strong></label>
                    <input type="text" name="email" value="" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label><strong>Telephone</strong></label>
                    <input type="text" name="telephone" value="" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label><strong>Adresse Postale</strong></label>
                    <textarea rows="1" name="addresse_postale" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                    <label><strong>Centre</strong></label>
                    {!! Form::select('centre',$centres,null,['class' => 'form-control form-inline']) !!}
                    </div>
                </div>
            </div>
    </div>

    <div class="btn-toolbar list-toolbar row hidden" id="buttons">
      <div class="col-md-3">
        <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Enregistrer</button>
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
