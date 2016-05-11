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
      console.log('omg');
      for (var i in gCats){
          $('#genSty').html($('#genSty').html()+'.cat'+gCats[i].cat_id+'{background-color:'+gCats[i].cat_color+';}\n');
      }

      $http.get(gDataOrig+"/devzone/status").success(function(res){ 
        $scope.stat = res;
        gStat = res;
        
        $http.get(gDataOrig+"/devzone/ticket").success(function(res){ 
          $scope.tickets = res;
          for(var i=0; i<$scope.tickets.length; i++){
            $scope.tickets[i].desc = $scope.tickets[i].tk_showdesc ? shortenString($scope.tickets[i].tk_desc, 250) : false;
            $scope.tickets[i].cat_name = gCats[$scope.tickets[i].cat_id].cat_name;
          }
          gTickets = $scope.tickets;
        });
        
      });
      
    });


  });
};