exports = module.exports = function(app){
  var gUser, gTickets, gCats, gStat, gAssig, gUsers ={}, gUserW, gJobs;
  app.controller('MainController', function($scope, $http, $sce){
    $scope.editTicket = function(tkId){
      if($scope.tkEdit !== undefined)
        $scope.tkEdit.comments = [];
      $('#modalEdit').openModal();
      history.pushState({}, "Editer", "?more="+tkId);
      $http.get(gDataOrig+"/devzone/ticket/"+tkId).success(function(res){
          $http.get(gDataOrig+"/devzone/ticket/"+tkId+"/comment").success(function(res){
            $scope.tkEdit.comments = res;
          });
        $scope.tkEdit = res[0];
        $scope.tkEdit.readonly = (function(user, tkEdit){
          if(user.accesslevel >= 40)
            return false;
          if(user.uid == tkEdit.usr_id){
            if(tkEdit.stat_id == 1)
              return false;
          }
          return true;
        })($scope.user, $scope.tkEdit);
        $scope.tkEdit.assig_usr_id = $scope.tkEdit.assig_usr_id.toString();
      });
    };
    
    $scope.openEdit = function(){
      $('#modalEdit').openModal();
    };
    
    $scope.newTicket = function(){
      if($scope.user.accesslevel >= 10){
        $scope.clearTkEd();
        $('#modalEdit').openModal();
      }
      else{
        Materialize.toast('Il vous faut au minimum le grade no-pij pour poster un ticket!', 6000, 'red');
      }
    };
    
    $scope.toInt = function(i){
      return i << 0;
    };
    
    $scope.deleteTk = function(){
      if($scope.tkEdit.tk_delr){
        $http({
          method: 'DELETE',
          url: gDataOrig+"/devzone/ticket/"+$scope.tkEdit.tk_id,
          data:{
            reason: $scope.tkEdit.tk_delr
          }
        }).then(function(res) {
          if(res.data == 'OK'){
            Materialize.toast('Le ticket a été supprimé!', 6000, 'green');
            $scope.clearTkEd();
            $scope.loadTickets();
          }
          else{
            Materialize.toast('Une erreur est survenue lors de la supression!', 6000, 'red');
            $('#modalEdit').openModal();
          }
        });
      }
      else{
        $scope.tkEdit.tk_delr = '';
        $('#modalDel').openModal();
      }
    };
    
    $scope.deleteCom = function(com_id){
      if(confirm("Suprimmer le commentaire ?")){
        $http({
          method: 'DELETE',
          url: gDataOrig+"/devzone/ticket/"+$scope.tkEdit.tk_id+"/comment/"+com_id
        }).then(function(res) {
          if(res.data == 'OK'){
            Materialize.toast('Le commentaire a été supprimé!', 6000, 'green');
            $scope.editTicket($scope.tkEdit.tk_id);
          }
          else{
            Materialize.toast('Une erreur est survenue lors de la supression!', 6000, 'red');
            $('#modalEdit').openModal();
          }
        });
      }
    };
    
    $scope.saveTkEdit = function(){
      var tk = $scope.tkEdit;
      if(tk.tk_id !== null){ // Edition de ticket
        $http({
          method: 'POST',
          url: gDataOrig+"/devzone/ticket/"+tk.tk_id,
          data:{
            title: tk.tk_title,
            job: tk.tk_esttime,
            assig: parseInt(tk.assig_usr_id),
            avancement: parseInt(tk.tk_ava),
            desc: tk.tk_desc,
            url: tk.tk_url,
            showdesc: tk.tk_showdesc,
            category: tk.cat_id
          }
        }).then(function(res) {
          if(res.data == 'ok'){
            Materialize.toast('Les modifications ont été sauvegardées!', 6000, 'green');
            $scope.clearTkEd();
            $scope.loadTickets();
          }
          else{
            Materialize.toast('Une erreur est survenue lors de la sauvegarde!', 6000, 'red');
            $('#modalEdit').openModal();
          }
        });
      }
      else{ // Nouveau ticket
        $http({
          method: 'PUT',
          url: gDataOrig+"/devzone/ticket",
          data:{
            title: tk.tk_title,
            job: tk.tk_esttime,
            desc: tk.tk_desc,
            url: tk.tk_url,
            showdesc: tk.tk_showdesc,
            category: tk.cat_id
          }
        }).then(function(res) {
          if(res.data == 'ok'){
            Materialize.toast('Le ticket a été ajouté, il sera consulté sous peu par un administrateur ', 6000, 'green');
            $scope.clearTkEd();
            $scope.loadTickets();
          }
          else{
            Materialize.toast('Une erreur est survenue lors de la sauvegarde!', 6000, 'red');
            $('#modalEdit').openModal();
          }
        });
      }
    };
    $scope.clearTkEd = function(){
        $scope.tkEdit = {          
          tk_title: '',
          tk_esttime: 0,
          assig_usr_id: '0',
          tk_ava: 0,
          tk_desc: '',
          tk_url: '',
          tk_showdesc: 1,
          cat_id: 1,
          tk_id: null,
          comments: []
        };
    };
    $scope.addCom = function(){
      if($scope.tkEdit.tk_comment.length < 3)
        return;
      if($scope.tkEdit.tk_id === null)
        return;
      
      $scope.tkEdit.working = true;
      $http({
        method: 'PUT',
        url: gDataOrig+"/devzone/ticket/"+$scope.tkEdit.tk_id+"/comment",
        data:{
          text: $scope.tkEdit.tk_comment,
        }
      }).then(function(res) {
        $scope.tkEdit.working = false;
        if(res.data == 'ok'){
          $scope.tkEdit.tk_comment = '';
          Materialize.toast('Le commentaire a été ajouté!', 6000, 'green');
          $scope.editTicket($scope.tkEdit.tk_id);
        }
        else{
          Materialize.toast('Une erreur est survenue lors de l\' envoi du commentaire!', 6000, 'red');
        }
      });
    };
    
    $scope.getNameById = function(uid){
      if(!uid || gUserW)
        return 'Personne';
      if(uid == '0')
        return 'Personne';
      if(gUsers[uid])
        return gUsers[uid].username;
      gUserW = true;
      $http.get(gDataOrig+"/devzone/user/"+uid).success(function(res){
        gUserW = false;
        gUsers[uid] = res;
        return res.username;
      });
    };
    
    $scope.getJobNameById = function(jid){
      if(jid == '0')
        return 'Aucun';
      for (var i = 0; i < $scope.jobs.length; i++) {
        if($scope.jobs[i].id == jid)
          return $scope.jobs[i].name;
      }
    };
    
    $scope.loadTickets = function(){
      $http.get(gDataOrig+"/devzone/ticket").success(function(res){ 
        $scope.tickets = res;
        for(var i=0; i<$scope.tickets.length; i++){
          $scope.tickets[i].desc = $scope.tickets[i].tk_showdesc ? $sce.trustAsHtml(shortenString($scope.tickets[i].tk_desc, 250)) : false;
          $scope.tickets[i].cat_name = gCats[$scope.tickets[i].cat_id].cat_name;
        }
        gTickets = $scope.tickets;
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
        
    $http.get(gDataOrig+"/devzone/user").success(function(res){
      $scope.user = res;
      gUser = res;
      if(dataGet.more)
        $scope.editTicket(dataGet.more);
    });
    $http.get(gDataOrig+"/jobs").success(function(res){
      res.unshift({
        name:'Aucun job',
        id:0
      });
      $scope.jobs = res;
      gJobs = res;
    });
    $http.get(gDataOrig+"/devzone/assigne").success(function(res){
      res.unshift('0');
      $scope.assignes = res;
      gAssig = res;
      for (var i = 0; i < gAssig.length; i++) {
        $scope.getNameById(gAssig[i]);
      }
    });
    $http.get(gDataOrig+"/devzone/category").success(function(res){ 
      $scope.cats = res;
      gCats = res;
      for (var i in gCats){
          $('#genSty').html($('#genSty').html()+'.cat'+gCats[i].cat_id+'{background-color:'+gCats[i].cat_color+';}\n');
      }

      $http.get(gDataOrig+"/devzone/status").success(function(res){ 
        $scope.stat = res;
        gStat = res;
        
        $scope.loadTickets();
        
      });
      
    });

  });
};