@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
<script src="{{ asset('/js/jquery.validate.js') }}"></script>
<script text="javascript">
        $(document).ready(function () {

          $('#formid').validate({
              wrapper: 'li',
              rules: {
                 centre: "required",
                 autre_centre: "required",
                 post_content: "required",
               },
              messages:{
                centre:"Le champ centre de passage est obligatoire.",
                autre_centre:"Le champ autre centre de passage est obligatoire.",
                post_content:"Veuillez Choisir au moins un Examen.",
              },
              errorLabelContainer: '#errors'
            });

            $('body').on('click', '.list-group .list-group-item', function () {
                $(this).toggleClass('active');
            });
            $('.list-arrows button').click(function () {
                var $button = $(this), actives = '';
                if ($button.hasClass('move-left')) {
                    actives = $('.list-right ul li.active');
                    actives.clone().appendTo('.list-left ul');
                    actives.remove();
                } else if ($button.hasClass('move-right')) {
                    actives = $('.list-left ul li.active');
                    actives.clone().appendTo('.list-right ul');
                    actives.remove();
                }
            });
            $('.dual-list .selector').click(function () {
                var $checkBox = $(this);
                if (!$checkBox.hasClass('selected')) {
                    $checkBox.addClass('selected').closest('.well').find('ul li:not(.active)').addClass('active');
                    $checkBox.children('i').removeClass('glyphicon-unchecked').addClass('glyphicon-check');
                } else {
                    $checkBox.removeClass('selected').closest('.well').find('ul li.active').removeClass('active');
                    $checkBox.children('i').removeClass('glyphicon-check').addClass('glyphicon-unchecked');
                }
            });
            $('[name="SearchDualList"]').keyup(function (e) {
                var code = e.keyCode || e.which;
                if (code == '9') return;
                if (code == '27') $(this).val(null);
                var $rows = $(this).closest('.dual-list').find('.list-group li');
                var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
                $rows.show().filter(function () {
                    var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                    return !~text.indexOf(val);
                }).hide();
            });

            $('#sauvegarder').click(function(){

                    $('#post_content').text("");

                    $('.list-right').find('.list-group-item').find('.code_exam').each(function(){
                        $('#post_content').val($('#post_content').val()+""+$(this).text()+",");

                    });

                    $('#formid').submit();

            });

            $( "#centre" ).change(function() {
                  if($(this).val() == " ")
                  {
                    $('#autre_centre_div').show();
                  }
                  else
                  {
                    $('#autre_centre_div').hide();
                  }
            });

            $('.close').click(function() {
               $('.alert-danger').hide('slow');
            });

        });
</script>
@endsection
@section('content')
<div id ="errors" class="alert alert-danger" style="display:none;">
    <a href="#" class="close">&times;</a>
    <strong>Attention:</strong>
    <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
    </ul>
</div>
<div class="content">
        <div class="header">
            <h1 class="page-title">Inscrire choix d'examens</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Examens</li>
            <li class="active">Inscription Examens</li>
            <li class="active">Inscrire choix d'examens</li>
        </ul>
        </div>
  <div>
{!! Form::open(array('id'=>'formid','action' => 'GestionExamensController@postfaireInscriptionExamen', 'class' =>'login-form')) !!}
  @if (count($centres) > 0)
  <div class="col-lg-12">
      <h4><strong>Veuillez choisir votre centre de passage d'examens: </strong></h4>
      {!! Form::select('centre',$centres,null,['id'=>'centre','class' => 'form-control','required']) !!}
  </div>
  <div id="autre_centre_div" class="col-lg-12" style="display:none;">
    <h4><strong>Veuillez préciser le nom du centre passage d'examens :</strong></h4>
    <input id="autre_centre" type="text" name="autre_centre" value="" class="form-control" required/>
 </div>
 <input id="post_content" name="post_content" type="text" style="visibility: hidden;" required/>

  @endif
  {!! Form::close() !!}
  <div class="dual-list list-left col-md-5">
  <h4><strong>Examens Ouverts</strong></h4>
            <div class="well">
                <div>
                    <div>
                        <div class="input-group">
                            <span class="input-group-addon glyphicon glyphicon-search" style="background-color:#ffffff;"></span>
                            <input type="text" name="SearchDualList" class="form-control" placeholder="search" style="background-color:#ffffff;color:#000000;border: 1px solid #cccccc;" />
                        </div>
                    </div>
                    <div>
                        <div class="btn-group">
                            <a class="btn btn-default selector" title="select all"><i class="glyphicon glyphicon-unchecked"></i>Choisir Tout</a>
                        </div>
                    </div>
                </div>
                <ul class="list-group">
                @if(count($examens)>0)
                    @foreach ($examens as $examen)
                        <li class="list-group-item alert-warning"><span id='titre_exam'>Examen du Module -</span><span id='code_exam' class='code_exam'> {{ $examen->code_module }}</span></li>
                    @endforeach
                @endif
                </ul>
            </div>
        </div>

        <div class="list-arrows col-md-1 text-center">
            <button class="btn btn-default btn-sm move-left">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </button>

            <button class="btn btn-default btn-sm move-right">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </button>
        </div>

        <div class="dual-list list-right col-md-5">
            <h4><strong>Examens Choisis</strong></h4>
            <div class="well">
                <div>
                    <div>
                        <div class="input-group">
                            <span class="input-group-addon glyphicon glyphicon-search" style="background-color:#ffffff;"></span>
                            <input type="text" name="SearchDualList" class="form-control" placeholder="search" style="background-color:#ffffff;color:#000000;border: 1px solid #cccccc;" />
                        </div>
                    </div>
                    <div>
                        <div class="btn-group">
                            <a class="btn btn-default selector" title="select all"><i class="glyphicon glyphicon-unchecked"></i>Choisir Tout</a>
                        </div>
                    </div>
                </div>
                <ul class="list-group">
                @if(count($choixs)>0)
                    @foreach ($choixs as $choix)
                        <li class="list-group-item alert-warning"><span id='titre_exam'>Examen du Module -</span><span id='code_exam' class='code_exam'> {{ $choix->code_module }}</span></li>
                    @endforeach
                @endif
                </ul>
            </div>
        </div>
  </div>
  <div class="dual-list col-md-10">
    <button id="sauvegarder" class="btn btn-primary btn-md" type="submit"> <i class="glyphicon glyphicon-floppy-disk"></i> Sauvegarder</button>
    <a href="{{ url('/inscriptionExamens') }}" class="btn btn-danger btn-md"><i class="glyphicon glyphicon-arrow-left"></i>Annuler</a>
  </div>

</div>
@endsection
