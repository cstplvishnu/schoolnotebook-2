@include('common.angular-factory')
<script >
 
     app.controller('academic_controller', function ($scope, $http, httpPreConfig) {
      $scope.academic_year = '';
      $scope.select_academic_year = '';
     
      @include('common.js-script-year-selection',array('doCall'=>false))

    /**
     * Returns the token by fetching if from from form
     * 
     */
    $scope.getToken = function(){
      return  $('[name="_token"]').val();
    }

    

    });


 
</script>