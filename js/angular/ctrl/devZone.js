exports = module.exports = function(app){
  var gUser, gTickets, gCats, gStat, gAssig, gUsers ={}, gUserW, gJobs;
  app.controller('MainController', function($scope, $http, $sce){
    
    $scope.editTicket = function(tkId){
      $http.get(gDataOrig+"/devzone/ticket/"+tkId).success(function(res){
        $scope.tkEdit = res[0];
        console.log($scope.tkEdit);
        $('#modalEdit').openModal();
        $('#mECat [value='+$scope.tkEdit.cat_id+']').prop('selected', true);
        $('#mEJob [value='+$scope.tkEdit.tk_esttime+']').prop('selected', true);
        $('#mEAss [value='+$scope.tkEdit.assig_usr_id+']').prop('selected', true);
        $('select').material_select();
      });
    };
    
    $scope.getNameById = function(uid){
      if(!uid || gUserW)
        return '';
      if(gUsers[uid])
        return gUsers[uid].username;
      gUserW = true;
      $http.get(gDataOrig+"/devzone/user/"+uid).success(function(res){
        gUserW = false;
        gUsers[uid] = res;
        return res.username;
      });
    };
    
    $scope.tsToDate = function(ts){
      var dt = new Date(ts*1000);
      var day = dt.getDate() < 10 ? '0'+dt.getDate() : dt.getDate(); 
      var month = dt.getMonth()+1 < 10 ? '0'+(dt.getMonth()+1) : dt.getMonth()+1;
      var hour = dt.getHours() < 10 ? '0'+dt.getHours() : dt.getHours();
      var min = dt.getMinutes() < 10 ? '0'+dt.getMinutes() : dt.getMinutes();
      return day+'/'+month+'/'+dt.getFullYear()+' à '+hour+':'+min;
    };
    
    var dataGet = {};
    window.location.href.replace( location.hash, '' ).replace( 
    /[?&]+([^=&]+)=?([^&]*)?/gi,
    function( m, key, value ) {
        dataGet[key] = value !== undefined ? value : '';
    });
    if(dataGet.more)
      $scope.editTicket(dataGet.more);
        
    $http.get(gDataOrig+"/devzone/user").success(function(res){
      $scope.user = res;
      gUser = res;
    });
    $http.get(gDataOrig+"/jobs").success(function(res){
      $scope.jobs = res;
      gJobs = res;
    });
    $http.get(gDataOrig+"/devzone/assigne").success(function(res){
      $scope.assignes = res;
      gAssig = res;
      for (var i = 0; i < gAssig.length; i++) {
        $scope.getNameById(gAssig[i]);
      }
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
            $scope.tickets[i].desc = $scope.tickets[i].tk_showdesc ? $sce.trustAsHtml(shortenString($scope.tickets[i].tk_desc, 250)) : false;
            $scope.tickets[i].cat_name = gCats[$scope.tickets[i].cat_id].cat_name;
          }
          gTickets = $scope.tickets;
        });
        
      });
      
    });

  });
};