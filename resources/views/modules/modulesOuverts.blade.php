@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
@endsection
@section('content')

<div class="content">
        <div class="header">
            
            <h1 class="page-title">Modules Ouverts</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Modules de formation</li>
            <li class="active">Liste de Modules Ouverts</li>
        </ul>

        </div>
        <div class="main-content">
            
<table class="table">
  <thead style="font-weight:bold;">
    <tr>
      <th>Code Semestre</th>
      <th>Code Module</th>
      <th>Nom Module</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($modsouverts as $mods)
	<tr>
		<td>{{ $mods->code_semestre }}</td>
		<td><a href="#"> <span class="glyphicon glyphicon-unchecked"></span>{{ $mods->code_module}}</a></td>
    <td>{{ $mods->nom_module }}</td>
	</tr>
	@endforeach
  </tbody>
</table>

{!! str_replace('/?', '?', $modsouverts->render()) !!}
<!--ul class="pagination">
  <li><a href="#">«</a></li>
  <li><a href="#">1</a></li>
  <li><a href="#">2</a></li>
  <li><a href="#">3</a></li>
  <li><a href="#">4</a></li>
  <li><a href="#">5</a></li>
  <li><a href="#">»</a></li>
</ul-->
</div>
</div>


@endsection
