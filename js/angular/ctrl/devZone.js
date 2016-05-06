exports = module.exports = function(app) {
  app.controller('UserController', function($scope, $http){
    $http.get(gDataOrig+"/devzone/user").success(function(res) { 
      $scope.user = res;
    });
  });
};