@extends('app')
@section('head')
<link href="{{ asset('/css/theme.css') }}" rel="stylesheet">
<link href="{{ asset('/css/fullcalendar.css')}}" rel="stylesheet">
<link href="{{ asset('/css/fullcalendar.print.css')}}" rel="stylesheet" media="print">
<script src="{{ asset('/js/moment.min.js')}}"></script>
<script src="{{ asset('/js/fullcalendar.js')}}"></script>
<script src="{{ asset('/js/lang-all.js')}}"></script>
<script>
    @if(!empty($examen_min_date))
      var defdate = "{{$examen_min_date}}";
    @else
      var defdate = "{{$backup_min_date}}";
    @endif
  	$(document).ready(function() {
  		$('#calendar').fullCalendar({
  			theme: true,
  			header: {
  				left: 'prev,next today',
  				center: 'title',
  				right: 'month'
  			},
  			defaultDate: defdate,
        height: 'auto',
        contentHeight: 'auto',
        eventStartEditable:false,
        lang: 'fr',
  			editable: true,
  			eventLimit: true, // allow "more" link when too many events
  			events: "{{ url('/calendrierExamensEvents')}}",
        eventRender: function(event, element) {
          element.prop("title", event.title);
          element.popover({container: 'body',placement:'top',trigger: 'hover'});
          }
        });
  	});
</script>
@endsection
@section('content')
<div class="content">
        <div class="header">
            <h1 class="page-title">Calendrier d'examens</h1>
                    <ul class="breadcrumb">
            <li><a href="{{ url('/')}}">Accueil</a> </li>
            <li class="active">Examens</li>
            <li class="active">Calendrier d'examens</li>
        </ul>
        </div>
        <div class="main-content">
          <div id="calendar" class="col-md-12 table-responsive"></div>
        </div>
</div>

@endsection
