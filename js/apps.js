var app = angular.module('devZone', []);

app.config(function($httpProvider) {
	$httpProvider.defaults.headers.common.auth = _md5;
});

require("./angular/ctrl/devZone.js")(app);
require("./angular/route/devZone.js")(app);
require("./angular/directive/devZone.js")(app);
require("./angular/filter/devZone.js")(app);