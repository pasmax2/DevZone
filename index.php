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
<body ng-controller="MainController">
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
      <div class="col s12 m3" ng-repeat="stt in stat" ng-if="stt.stat_hidden==0">
        <div class="card grey darken-2 card-stat-head">
          <div class="card-title center-align white-text">
            {{stt.stat_name}}
          </div>
        </div>
        <div class="card card-ticket teal darken-1" ng-repeat="ticket in tickets" ng-if="stt.stat_id == ticket.stat_id">
          <div class="card-content white-text">
            <div class="card-title">{{ticket.tk_title}}</div>
            <p ng-if="ticket.stat_id != 1 && ticket.tk_showdesc != 0">{{ticket.desc}}</p>
          </div>
          <div class="card-action">
            <div class="chip">{{ticket.cat_name}}</div>
            <a class="btn-floating grey darken-4 center-align waves-light right">+</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
