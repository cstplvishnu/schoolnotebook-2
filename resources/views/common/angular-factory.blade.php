


<script>



app.factory('httpPreConfig', function($http, $rootScope, $timeout, $q) {
   return {
    webServiceCallPost: function(url, data) {
          $('#ajax_loader').fadeIn({{AJAXLOADER_FADEIN_TIME}});
        return $http.post(url,data).then(function(response) {
          $('#ajax_loader').fadeOut({{AJAXLOADER_FADEOUT_TIME}});
               return response;
    });
    },
    getToken : function(){
      return  $('[name="_token"]').val();
    },
    findIndexInData    : function (Array, property, action) {
          var result           = -1;
          angular.forEach(Array, function(value, index) {
             if(value[property]==action){
                result         =index;
             }
          });
          return result;
        },



         showConfirmation: function() {
                var defer = $q.defer();
                

      (new PNotify({

    title: 'Confirmation Needed',
    text: 'Are you sure?',
    icon: 'fa fa-question-circle fa-2x',
    hide: false,
    confirm: {
        confirm: true
    },
    buttons: {
        closer: false,
        sticker: false
    },
    history: {
        history: false
    }
})).get().on('pnotify.confirm', function() {

    defer.resolve(1);

}).on('pnotify.cancel', function() {

    new PNotify({
                title: "{{getPhrase('ok')}}",
                text: "{{getPhrase('your_record_is_safe')}}",
                type: "info",
                delay: 1500,
                shadow: true,
                
                animate: {
                            animate: true,
                            in_class: 'fadeInLeft',
                            out_class: 'fadeOutRight'
                        }
                });
         
          defer.resolve(0);

});          

  

  return defer.promise;

  },


    webServiceCallPost1: function(url, data) {
          var deferred = $q.defer();
               return $.ajax({
                   type: "POST",
                   url: url,
                   crossDomain: true,
                   dataType: "json",
                   data: data,
                   timeout: 2000000,
                   async: true,
                   success: function(response) {
                       console.log("response    "+JSON.stringify(response));
                       deferred.resolve();
                   },
                   error: function(xhr, ajaxOptions, thrownError) {
                       
                       if (xhr.status == 0) {
                           
                       } else if (xhr.status == 404) {
                           
                       } else {
                           
                       }
                   },
                   beforeSend: function() {},
                   complete: function() {}
               });
           
       }
     }

});
</script>