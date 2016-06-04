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
        <li><a ng-click="newTicket();">Nouveau Ticket</a></li>
        <li><a class="dropdown-button" href="#!" data-activates="ddAdmin">Administration &nbsp;<i class="fa fa-level-down" aria-hidden="true"></i></a></li>
      </ul>
      <ul class="right hide-on-med-and-down" ng-view>
        <li><a>Connecté en tant que {{user.username}} ({{user.accessname}})</a></li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <div class="row">
      <div class="col s12 m6 l3" ng-repeat="stt in stat" ng-if="stt.stat_hidden==0">
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
            <div class="chip green darken-3" ng-show="ticket.tk_url != ''"><a ng-href="{{ticket.tk_url}}" rel="nofollow" target="_blank" class="white-text">Forum</a></div>
            <div class="chip blue darken-3 white-text" ng-show="ticket.assig_usr_id == user.uid && user.uid != 0">Assigné</div>
            <div class="chip grey darken-4 white-text" ng-show="ticket.usr_id == user.uid && user.uid != 0">Auteur</div>
            <a class="btn-floating grey darken-4 center-align waves-light right" ng-click="editTicket(ticket.tk_id);">+</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="modalDel" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4>Supprimer le ticket: {{tkEdit.tk_title}}</h4>
      <div class="row">
        <div class="input-field col s12">
          <textarea class="materialize-textarea" placeholder="Obligatoire" required ng-model="tkEdit.tk_delr"></textarea>
          <label>Raison de supression</label>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close btn-flat red" ng-click="deleteTk()">Supprimer</a>
      <a href="#!" class="modal-action modal-close btn-flat green" ng-click="openEdit()">Annuler</a>
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
          <div class="input-field col s12 m6 l3">
          </div>
          <div class="col s12 m3">
            <label>Catégorie:</label>
            <select id="mECat" ng-model="tkEdit.cat_id" class="browser-default" ng-options="i.cat_id as i.cat_name for i in cats" ng-disabled="tkEdit.readonly">
            </select>
          </div>
        </div>
        
        <div class="row" ng-show="tkEdit.tk_id!==null">
          <div class="col s12">
            <p>Posté par <strong ng-bind="getNameById(tkEdit.usr_id)"></strong>, le <strong>{{tsToDate(tkEdit.tk_datecrea)}}</strong></p>
            <p>Statut: <strong ng-bind="stat[tkEdit.stat_id].stat_name"></strong></p>
          </div>
        </div>
        
        <div class="row">
          <div class="col m3 s12" ng-show="tkEdit.tk_id!==null">
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
                
        <div class="row" ng-show="tkEdit.tk_id!==null">
          <div class="input-field col s9 l7">
            <p class="range-field">Progression: 
            <input type="range" min="0" max="100" ng-model="tkEdit.tk_ava" ng-readonly="!user.assigne">
            </p>
          </div>
        </div>
        
        <div class="row">
          <div class="input-field col s6">
            <p>Description :</p>
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
        <div class="row" ng-show="tkEdit.tk_id!==null">
          <ul class="collection" ng-if="tkEdit.comments.length">
             <li class="collection-item" ng-repeat="com in tkEdit.comments">
               <span class="title" ng-bind="getNameById(com.usr_id)"></span>
               <a href="#!" class="secondary-content" ng-click="deleteCom(com.com_id)" ng-if="user.accesslevel >= 40"><i class="fa fa-trash-o"></i></a>
               <p ng-bind="com.com_text"></p>
             </li>
          </ul>
        </div>
        <div class="row" ng-show="tkEdit.tk_id!==null">
          <div class="input-field col s12 m6">
            <input placeholder="Commentaire" type="text" ng-model="tkEdit.tk_comment" ng-if="user.accesslevel >= 10">
            <label>Ajouter un commentaire</label>
          </div>
          <div class="input-field col s12 m6">
            <a href="#!" class="btn-flat green darken-1" ng-click="addCom()" ng-show="!tkEdit.working && tkEdit.tk_comment.length >= 3">Poster le commentaire</a>
          </div>
        </div>
        
      </div>
      <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close btn-flat">Fermer</a>
        <a href="#!" class=" modal-action modal-close btn-flat green darken-1" ng-click="saveTkEdit()" ng-if="!tkEdit.readonly">Sauvegarder</a>
        <a href="#!" class=" modal-action modal-close btn-flat red darken-1 left" ng-click="deleteTk()" ng-if="!tkEdit.readonly">Supprimer</a>
      </div>
    </form>
  </div>
</body>
</html>
