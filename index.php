<!DOCTYPE html>
<html ng-app="devZone">
<head>
  <title>DevZone</title>
  <!-- <script src="js/compiled/require.min.js"></script> -->
  <script>_md5 = "<?php if(isset($_COOKIE['tsxcookiev3_sid'])){echo $_COOKIE['tsxcookiev3_sid'];} ?>";
    console.log('MD5');
  </script>
  <script src="js/compiled/jquery.min.js"></script>
  <script src="js/compiled/angular.min.js"></script>
  <script src="js/materialize/bin/materialize.min.js"></script>
  <script src="js/compiled/all.min.js"></script>
  <link href="styles/angular_materialize.css" rel="stylesheet" type="text/css">
  <link href="styles/materialize.css" rel="stylesheet" type="text/css">
  <link href="styles/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="styles/main.css" rel="stylesheet" type="text/css">
</head>
<body ng-controller="UserController">
  <ul id="ddAdmin" class="dropdown-content">
    <li><a href="#!">Gestion des assignés</a></li>
    <li><a href="#!">Gestion des catégories</a></li>
    <li><a href="#!">Gestion des mises à jour</a></li>
  </ul>
  <nav class="grey darken-4">
    <div class="nav-wrapper">
      <a href="#" class="brand-logo center">DevZone</a>
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <li><a>Nouveau Ticket</a></li>
        <li><a class="dropdown-button" href="#!" data-activates="ddAdmin">Administration &nbsp;<i class="fa fa-level-down" aria-hidden="true"></i></a></li>
      </ul>
      <ul id="nav-mobile" class="right hide-on-med-and-down" ng-view>
        <li><a>Connecté en tant que {{user.username}} ({{user.accessname}})</a></li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <div class="row">
      <div class="col s12 m3">
        <div class="card grey darken-2 card-stat-head">
          <div class="card-title center-align white-text">
            Suggestions
          </div>
        </div>
        <div class="card card-ticket teal darken-1">
          <div class="card-content white-text">
            <div class="card-title">DevZone V2</div>
            <p>Le temps est venu de mettre à jour cet outil...</p>
          </div>
          <div class="card-action">
            <div class="chip">DevZone</div>
            <a class="btn-floating grey darken-4 center-align waves-light right">+</a>
          </div>
        </div>
      </div>
      <div class="col s12 m3">
        <div class="card grey darken-2 card-stat-head">
          <div class="card-title center-align white-text">
            Approuvées
          </div>
        </div>
        <div class="card card-ticket grey darken-2">
            <div class="card-content white-text">
              <div class="card-title">Crash caméra</div>
              <p>Mettre une caméra sur un joueur qui a déjà une caméra. <-> boucle.<br>
                Anti afk avec la caméra</p>
            </div>
            <div class="card-action">
              <div class="chip">Crash</div>
              <a class="btn-floating grey darken-4 center-align waves-light right">+</a>
            </div>
          </div>
      </div>
      <div class="col s12 m3">
        <div class="card grey darken-2 card-stat-head">
          <div class="card-title center-align white-text">
            En cours
          </div>
        </div>
        <div class="card card-ticket teal darken-1">
            <div class="card-content white-text">
              <div class="card-title">DevZone V2</div>
              <p>Le temps est venu de mettre à jour cet outil...</p>
            </div>
            <div class="card-action">
              <div class="chip">DevZone</div>
              <a class="btn-floating grey darken-4 center-align waves-light right">+</a>
            </div>
          </div>
      </div>
      <div class="col s12 m3">
        <div class="card grey darken-2 card-stat-head">
          <div class="card-title center-align white-text">
            Terminées
          </div>
        </div>
        <div class="card card-ticket green darken-1">
            <div class="card-content white-text">
              <div class="card-title">Mairie de quartier</div>
              <p>Je propose de remplacer l'Ikea par un grand parc, et au centre de ce parc : la mairie de Princeton.<br>
                L'idée...</p>
            </div>
            <div class="card-action">
              <div class="chip">Map</div>
              <a class="btn-floating grey darken-4 center-align waves-light right">+</a>
            </div>
          </div>
      </div>
    </div>
  </div>
</body>
</html>
