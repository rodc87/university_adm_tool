@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
<script text="javascript">
        $(function () {

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

                    $('.list-right').find('.list-group-item').each(function(){
                        $('#post_content').val($('#post_content').val()+""+$(this).text()+",");

                    });

                    if($('#post_content').val()=="")
                    {
                        $('.alert').find('ul').html('<li>'+'Veuillez Choisir au moins un Module.'+'</li>');
                        $('.alert').toggleClass('hidden');

                    }
                    else
                    {
                        $('#form_choix').submit();
                    }



            });


            $('.close').click(function() {

               $('.alert').toggleClass('hidden');

            });

        });
</script>
@endsection
@section('content')
<div class="alert alert-danger hidden">
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
            <h1 class="page-title">Modifier Liste de Modules Ouverts</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Gestion de Modules</li>
            <li class="active">Modules Ouverts</li>
            <li class="active">Modifier Liste de Modules Ouverts</li>
        </ul>
        </div>
  <div>
  <div class="dual-list list-left col-md-5">
  <h4><strong>Liste de Modules</strong></h4>
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
                @if(count($allmodules)>0)
                    @foreach ($allmodules as $mods)
                        <li class="list-group-item alert-warning">{{ $mods->code }}</li>
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
            <h4><strong>Liste de Modules Ouverts</strong></h4>
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
                @if(count($modouverts)>0)
                    @foreach ($modouverts as $mdouvert)
                        <li class="list-group-item alert-warning">{{ $mdouvert->code_module }}</li>
                    @endforeach
                @endif
                </ul>
            </div>
        </div>
  </div>
  <div class="dual-list col-md-10">
    <button id="sauvegarder" class="btn btn-primary btn-md" type="submit"> <i class="glyphicon glyphicon-floppy-disk"></i> Sauvegarder</button>
    <a href="{{ url('/modulesOuverts') }}" class="btn btn-danger btn-md"><i class="glyphicon glyphicon-arrow-left"></i>Annuler</a>
    {!! Form::open(array('id'=>'form_choix','action' => 'GestionModulesController@postmodifiermodulesouverts', 'class' =>'login-form')) !!}
    <input id="post_content" name="post_content" type="text" class="hidden"/>
    {!! Form::close() !!}
  </div>
</div>

@endsection
