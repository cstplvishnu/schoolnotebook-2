@include('common.angular-factory')

<script>

app.controller('studentFeeSchedules', function($scope, $http, $timeout, httpPreConfig) {

     $scope.source_items = [];
     $scope.target_items = [];
   
      search='';

      /**
       * This method intilize the present academic year schedules 
       of a student
       * @param  {[type]} data [description]
       * @return {[type]}      [description]
       */
      $scope.ingAngData = function(data) {
         if(data.target_items!=null){
         
          route = '{{URL_STUDENT_FEE_SCHEDULES_DETAILS}}';
          mydata = {
               _method :'post',
              '_token':httpPreConfig.getToken(),
              'feecategory_id': data.target_items[1],
              'student_id'    :     JSON.parse(data.target_items[0]),
          };

       httpPreConfig.webServiceCallPost(route, mydata).then(function(result){
          $scope.feecategory_details  = result.data.feecategory_details;
          $scope.feeshedules          = result.data.feeshedules;
          $scope.particulars          = result.data.particulars;
          $scope.student              = result.data.student;
          $scope.total_fee                  = JSON.parse($scope.feecategory_details.total_fee);
          $scope.other_fee                  = JSON.parse($scope.feecategory_details.other_amount)
          $scope.final_fee                  = $scope.total_fee+$scope.other_fee;

          
       });

        }
         angular.forEach(data.source_items,function(value,key){
 
            $scope.source_items.push(value);
         });
          

      }


/**
This Method show the feeschedules of a student for a
selected feecategory
**/

      $scope.changeFeeCategory =function(feecat_id,std_id){

         route = '{{URL_STUDENT_FEE_SCHEDULES_DETAILS}}';
          data = {
               _method :'post',
              '_token':httpPreConfig.getToken(),
              'feecategory_id': feecat_id,
              'student_id':std_id,
          };

       httpPreConfig.webServiceCallPost(route, data).then(function(result){

          $scope.feecategory_details  = result.data.feecategory_details;
          $scope.feeshedules          = result.data.feeshedules;
          $scope.particulars          = result.data.particulars;
          $scope.student              = result.data.student;

          $scope.total_fee                  = JSON.parse($scope.feecategory_details.total_fee);
          $scope.other_fee                  = JSON.parse($scope.feecategory_details.other_amount)
          $scope.final_fee                  = $scope.total_fee+$scope.other_fee;

          
       });

     

      }

       

});

  
 

  </script>