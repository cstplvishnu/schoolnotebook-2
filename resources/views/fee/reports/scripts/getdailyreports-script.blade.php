




@include('common.angular-factory')

<script>

app.controller('studentFeePaidDetails', function($scope, $http, $timeout, httpPreConfig) {

     
   
      search='';

      /**
       * This method return the current day feepayments 
       of a student
       * @param  {[type]} data [description]
       * @return {[type]}      [description]
       */
      $scope.ingAngData = function() {
          
          route = '{{URL_FEE_REPORTS_GET_DAILYREPORTS}}';
          mydata = {
               _method :'post',
              '_token':httpPreConfig.getToken(),
              
          };

       httpPreConfig.webServiceCallPost(route, mydata).then(function(result){
             
            $scope.result_data   = result.data.records;
             $scope.date_from     = result.data.start_date;
             $scope.date_to       = result.data.end_date;
       });

      }
   
   /**
   This Method Return The Fee Paymetns Based on Selected Dates
   **/
    $scope.datesSelectd   = function(start_date,end_date){
       
        route = '{{URL_FEE_REPORTS_GET_DATES_REPORTS}}';
          mydata = {
               _method :'post',
              '_token':httpPreConfig.getToken(),
              'starting_date':start_date,
              'ending_date'  :end_date,
              
          };

       httpPreConfig.webServiceCallPost(route, mydata).then(function(result){
             $scope.result_data   = result.data;
       });

    }

/**
This Method Return The Last seven days Payment Records
From The Current Day
**/
$scope.getLastWeekReports = function(){

          route = '{{URL_FEE_REPORTS_GET_LASTWEEKREPORTS}}';
          mydata = {
               _method :'post',
              '_token':httpPreConfig.getToken(),
              
          };

       httpPreConfig.webServiceCallPost(route, mydata).then(function(result){
             $scope.result_data   = result.data.records;
             $scope.date_from     = result.data.start_date;
             $scope.date_to       = result.data.end_date;
       });
}

   /**
This Method Return The Last 31 days Payment Records
From The Current Day
**/
$scope.getLastMonthReports = function(){

          route = '{{URL_FEE_REPORTS_GET_LASTMONTHREPORTS}}';
          mydata = {
               _method :'post',
              '_token':httpPreConfig.getToken(),
              
          };

       httpPreConfig.webServiceCallPost(route, mydata).then(function(result){
             $scope.result_data   = result.data.records;
             $scope.date_from     = result.data.start_date;
             $scope.date_to       = result.data.end_date;
       });
}
       

});

  
 

  </script>