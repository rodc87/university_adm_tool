@extends('app')
@section('head')
<link href="{{ asset('/css/login_form.css') }}" rel="stylesheet">
<script>
$( document ).ready(function() {
 
$('.close').click(function() {

   $('.alert').hide('slow');

});
 
});
</script>
@endsection

@section('content')
@if (count($errors) > 0)
<div class="alert alert-danger">
	<a href="#" class="close">&times;</a>
	<strong>Attention:</strong>
	<ul>
	@foreach ($errors->all() as $error)
	<li>{{ $error }}</li>
	@endforeach
	</ul>
</div>
@endif
<div class="container-fluid">
	<div class="row">
		<div class="">
			<div class="panel panel-default">
				<div class="panel-body" style="background-color: #232424 !important; background: url({{ URL::asset('images/bgf.png') }}) repeat 0%;border-radius: 23px;">
<div style="font-family:Helvetica Neue,Helvetica,Arial,sans-serif;font-size:14px;text-align:center;color:#9DB3C6">CONNECTEZ-VOUS À VOTRE COMPTE</div>
{!! Form::open(array('action' => 'LoginController@index', 'class' =>'login-form')) !!}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<!--div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div-->

						<!--div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div-->

						<!--div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Login</button>
								<a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>
							</div>
						</div-->
						<div>				
											<div class="profile-img-card" ><img id="profile-img" src="{{ asset('/images/avatar_2x.png') }}" style="width: 96px; height: 96px; margin: 0 auto 10px; display: block; -moz-border-radius: 50%; -webkit-border-radius: 50%; border-radius: 50%;"></div>
											<ul class="login-formul">
											<li>
												<input id="username" name="username" type="text"  class="text" placeholder='Nom Utilisateur'><a href="#" class=" icon user"></a>
											</li>
											<li>
												<input id="password" name="password" type="password" placeholder='Mot de Passe'><a href="#" class=" icon lock"></a>
											</li>
											</ul>
											
											 <div class ="forgot">
												<input name="valider" type="submit" value="Valider" > <a href="#" class=" icon arrow"></a>                                                                                                                                                                                                                                 </h4>
											</div>
						</div>
				{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
