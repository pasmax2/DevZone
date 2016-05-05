<!DOCTYPE html>
<html>
<head>
  <title>DevZone</title>
  <!-- <script src="js/compiled/require.min.js"></script> -->
  <script src="js/compiled/jquery.min.js"></script>
  <script src="js/materialize/bin/materialize.min.js"></script>
  <script src="js/compiled/angular.min.js"></script>
  <script src="js/compiled/apps-min.js"></script>
  <link href="styles/materialize.css" rel="stylesheet" type="text/css">
  <link href="styles/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="styles/angular_materialize.css" rel="stylesheet" type="text/css">
  <link href="styles/main.css" rel="stylesheet" type="text/css">
</head>
<body>
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
    </div>
  </nav>
  <div class="container">
    <div class="row">
      <div class="col s12 m3">
        <div class="card grey darken-2">
          <div class="card-title center-align white-text">
            Suggestions
          </div>
        </div>
        <div class="card teal darken-1">
          <div class="card-content white-text">
            <div class="card-title">DevZone V2<a class="btn-floating grey darken-4 center-align waves-light right">+</a></div>
            <p>Le temps est venu de mettre à jour cet outil...</p>
          </div>
          <div class="card-action">
            <div class="chip">DevZone</div>
          </div>
        </div>
      </div>
      <div class="col s12 m3">
        <div class="card grey darken-2">
          <div class="card-title center-align white-text">
            Approuvées
          </div>
        </div>
        <div class="card grey darken-2">
            <div class="card-content white-text">
              <div class="card-title">Crash caméra<a class="btn-floating grey darken-4 center-align waves-light right">+</a></div>
              <p>Mettre une caméra sur un joueur qui a déjà une caméra. <-> boucle.<br>
                Anti afk avec la caméra</p>
            </div>
            <div class="card-action">
              <div class="chip">Crash</div>
            </div>
          </div>
      </div>
      <div class="col s12 m3">
        <div class="card grey darken-2">
          <div class="card-title center-align white-text">
            En cours
          </div>
        </div>
        <div class="card teal darken-1">
            <div class="card-content white-text">
              <div class="card-title">DevZone V2<a class="btn-floating grey darken-4 center-align waves-light right">+</a></div>
              <p>Le temps est venu de mettre à jour cet outil...</p>
            </div>
            <div class="card-action">
              <div class="chip">DevZone</div>
            </div>
          </div>
      </div>
      <div class="col s12 m3">
        <div class="card grey darken-2">
          <div class="card-title center-align white-text">
            Terminées
          </div>
        </div>
        <div class="card green darken-1">
            <div class="card-content white-text">
              <div class="card-title">Mairie de quartier<a class="btn-floating grey darken-4 center-align waves-light right">+</a></div>
              <p>Je propose de remplacer l'Ikea par un grand parc, et au centre de ce parc : la mairie de Princeton.<br>
                L'idée...</p>
            </div>
            <div class="card-action">
              <div class="chip">Map</div>
            </div>
          </div>
      </div>
    </div>
  </div>
</body>
</html>
