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
         // console.log(data.source_items);
         if(data.target_items!=null){
         
          route = '{{URL_STUDENT_FEE_PAID_HISTORY}}';
          mydata = {
               _method :'post',
              '_token':httpPreConfig.getToken(),
              'feecategory_id': data.target_items[1],
              'student_id'    : JSON.parse(data.target_items[0]),
          };

       httpPreConfig.webServiceCallPost(route, mydata).then(function(result){

          $scope.feecategory_details  = result.data.feecategory_details;
          $scope.paid_data            = result.data.paid_data;
          $scope.student              = result.data.student;
          $scope.previous_data        = result.data.previous_details;
          $scope.previous_amount        = result.data.previous_amount;
        console.log(result.data);

          $scope.total_fee = parseInt($scope.feecategory_details.total_fee);
          $scope.other_fee = parseInt($scope.feecategory_details.other_amount)
          $scope.final_fee = $scope.total_fee+$scope.other_fee;

          
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

      $scope.changeFeeCategory =function(feecat_id,student_id){

         route = '{{URL_STUDENT_FEE_PAID_HISTORY}}';
          data = {
               _method :'post',
              '_token':httpPreConfig.getToken(),
              'feecategory_id': feecat_id,
              'student_id':student_id,
          };

       httpPreConfig.webServiceCallPost(route, data).then(function(result){
          $scope.feecategory_details  = result.data.feecategory_details;
          $scope.paid_data            = result.data.paid_data;
          $scope.student              = result.data.student;
          $scope.previous_data        = result.data.previous_details;
          $scope.previous_amount        = result.data.previous_amount;


          $scope.total_fee = parseInt($scope.feecategory_details.total_fee);
          $scope.other_fee = parseInt($scope.feecategory_details.other_amount)
          $scope.final_fee = $scope.total_fee+$scope.other_fee;

          
       });

     

      }

       

});

  
 

  </script>