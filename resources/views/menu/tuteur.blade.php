<ul class="nav navbar-nav">
<li><a href="{{ url('/') }}">
  <span class="glyphicon glyphicon-home padding-right-small" style="position:relative;top: 3px;"></span>Accueil</a>
</li>
</ul>
<ul class="nav navbar-nav">
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list padding-right-small" style="position:relative;top: 3px;"></span>
  Modules de formation <span class="caret"></span></a>
  <ul class="dropdown-menu" role="menu" style="width:100%;">
          <li><a href="{{ url('/choixmodulesOuverts') }}"><i class="glyphicon glyphicon-menu-right"></i>Liste de Modules Ouverts</a></li>
          <li><a href="{{ url('/inscritsParModule') }}"><i class="glyphicon glyphicon-menu-right"></i>Inscrits par Module</a></li>
  </ul>
</li>
</ul>
<ul class="nav navbar-nav">
<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-education padding-right-small" style="position:relative;top: 3px;"></span>
  Examens <span class="caret"></span></a>
  <ul class="dropdown-menu" role="menu" style="width:100%;">
  <li><a href="{{ url('/calendrierExamens') }}"><i class="glyphicon glyphicon-menu-right"></i>Calendrier d'examens</a></li>
  <li><a href="{{ url('/consultationNotesExamens') }}"><i class="glyphicon glyphicon-menu-right"></i>Consultation de Notes</a></li>
  </ul>
</li>
</ul>
