<!DOCTYPE html>
<html ng-app="devZone">
<head>
  <title>DevZone</title>
  <!-- <script src="js/compiled/require.min.js"></script> -->
  <script>_md5 = "<?php if(isset($_COOKIE['tsxcookiev3_sid'])){echo $_COOKIE['tsxcookiev3_sid'];} ?>";</script>
  <script src="js/compiled/jquery.min.js"></script>
  <script src="js/compiled/angular.min.js"></script>
  <script src="js/materialize/bin/materialize.min.js"></script>
  <script src="js/compiled/angular-materialize.min.js"></script>
  <script src="js/compiled/all.min.js"></script>
  <link href="styles/angular_materialize.css" rel="stylesheet" type="text/css">
  <link href="styles/materialize.css" rel="stylesheet" type="text/css">
  <link href="styles/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="styles/main.css" rel="stylesheet" type="text/css">
  <style id="genSty"></style>
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
      <ul class="right hide-on-med-and-down" ng-view>
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
        <div class="card card-ticket" ng-class="'cat'+ticket.cat_id" ng-repeat="ticket in tickets" ng-if="stt.stat_id == ticket.stat_id">
          <div class="card-content white-text">
            <div class="card-title">{{ticket.tk_title}}</div>
            <p ng-if="ticket.stat_id != 1 && ticket.tk_showdesc != 0" class="grey-text text-lighten-2">{{ticket.desc}}</p>
          </div>
          <div class="card-action">
            <div class="chip">{{ticket.cat_name}}</div>
            <a class="btn-floating grey darken-4 center-align waves-light right" ng-click="editTicket(ticket.tk_id);">+</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="modalEdit" class="modal modal-fixed-footer">
    <form>
      <div class="modal-content">
        <div class="row">
          <div class="input-field col s12 m6">
            <input placeholder="titre" type="text" ng-model="tkEdit.tk_title" ng-readonly="tkEdit.readonly">
            <label>Titre</label>
          </div>
          <div class="input-field col s12 m3">
          </div>
          <div class="col s12 m3">
            <label>Catégorie:</label>
            <select id="mECat" ng-model="tkEdit.cat_id" class="browser-default" ng-options="i.cat_id as i.cat_name for i in cats" ng-disabled="tkEdit.readonly">
            </select>
          </div>
        </div>
        
        <div class="row">
          <div class="col s12">
            <p>Posté par <strong ng-bind="getNameById(tkEdit.usr_id)"></strong>, le <strong>{{tsToDate(tkEdit.tk_datecrea)}}</strong></p>
            <p>Statut: <strong ng-bind="stat[tkEdit.stat_id].stat_name"></strong></p>
          </div>
        </div>
        
        <div class="row">
          <div class="col s3">
            <label>Assigné à:</label>
            <select id="mEAss" class="browser-default" ng-model="tkEdit.assig_usr_id" ng-options="i as getNameById(i) for i in assignes" ng-disabled="!user.assigne">
            </select>
          </div>
          <div class="input-field col s2">
          </div>
          <div class="col s6">
            <label>Job</label>
            <select id="mEJob" class="browser-default"  ng-model="tkEdit.tk_esttime" ng-options="i.id as i.name for i in jobs" ng-disabled="tkEdit.readonly">
            </select>
          </div>
        </div>
                
        <div class="row">
          <div class="input-field col s9">
            <p class="range-field">Progression: 
            <input type="range" min="0" max="100" ng-model="tkEdit.tk_ava" ng-readonly="!user.assigne">
            </p>
          </div>
        </div>
        
        <div class="row">
          <div class="input-field col s6">
            <p>Description:</p>
          </div>
          <div class="input-field col s6">
            <div class="switch">
              <label>
                Masquer
                <input type="checkbox" ng-model="tkEdit.tk_showdesc" ng-true-value="1" ng-false-value="0" ng-disabled="tkEdit.readonly">
                <span class="lever"></span>
                Afficher
              </label>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="input-field col s12">
            <textarea class="materialize-textarea" ng-model="tkEdit.tk_desc" ng-readonly="tkEdit.readonly"></textarea>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12 m6">
            <input placeholder="URL Forum" type="text" ng-model="tkEdit.tk_url" ng-readonly="tkEdit.readonly">
            <label>URL Forum</label>
          </div>
        </div>
        
        <p>TODO: Commentaires</p>

      </div>
      <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close btn-flat">Fermer</a>
        <a href="#!" class=" modal-action modal-close btn-flat green" ng-click="saveTkEdit()" ng-if="!tkEdit.readonly">Sauvegarder</a>
      </div>
    </form>
  </div>
</body>
</html>
