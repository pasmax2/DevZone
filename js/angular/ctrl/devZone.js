exports = module.exports = function(app) {
  var gUser, gTickets, gCats, gStat, gAssig;
  app.controller('MainController', function($scope, $http){
    $http.get(gDataOrig+"/devzone/user").success(function(res){
      $scope.user = res;
      gUser = res;
    });
    $http.get(gDataOrig+"/devzone/category").success(function(res){ 
      $scope.cats = res;
      gCats = res;
      
      $http.get(gDataOrig+"/devzone/status").success(function(res){ 
        $scope.stat = res;
        gStat = res;
        
        $http.get(gDataOrig+"/devzone/ticket").success(function(res){ 
          $scope.tickets = res;
          for(var i=0; i<$scope.tickets.length; i++){
            $scope.tickets[i].desc = $scope.tickets[i].tk_showdesc ? shortenString($scope.tickets[i].tk_desc, 250) : false;
            for(var j=0; j<gCats.length; j++){
              if(gCats[j].cat_id == $scope.tickets[i].cat_id){
                $scope.tickets[i].cat_name = gCats[j].cat_name;
                break;
              }
            }
          }
          gTickets = $scope.tickets;
        });
        
      });
      
    });


  });
};