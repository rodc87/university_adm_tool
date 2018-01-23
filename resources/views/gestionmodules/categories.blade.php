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
        <h1 class="page-title">Categories</h1>
        <ul class="breadcrumb">
          <li><a href="{{ url('/')}}">Accueil</a> </li>
          <li class="active">Gestion Modules</li>
          <li class="active">Categories</li>
        </ul>
      </div>
      <div class="main-content">
        <a href="{{ url('/ajouterCategorie') }}" class="btn btn-primary btn-md">
        <span class="glyphicon glyphicon-plus"></span> Ajouter Categorie</a>
      </br>
      </br>
      <div class="table-responsive">
      @if (count($allcategories) > 0)
      <table class="table">
        <thead style="font-weight:bold;">
          <tr>
            <th>Nom Categorie</th>
            <th><center>Actions</center></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($allcategories as $categorie)
          <tr>
            <td><a href="#"><i class="fa fa-dot-circle-o"></i>&nbsp;{{ $categorie->categorie }}</a></td>
            <td style="text-align:center;"><a href="{{ url('/modifierCategorie') }}/{{ $categorie->id_cat }}"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Modifier"></span></a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>
      @else
      <div class="noresuts"><strong>Aucune Categorie n'as encore été enregistrée.</strong></div>
      @endif

      {!! str_replace('/?', '?', $allcategories->render()) !!}

      </div>
</div>

@endsection
