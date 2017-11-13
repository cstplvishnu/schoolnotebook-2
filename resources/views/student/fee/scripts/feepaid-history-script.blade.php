@include('common.angular-factory')
<script>

 app.controller('TabController', function ($scope, $http, httpPreConfig)
  {
      // @include('common.js-script-year-selection')
      $scope.tab                  = 1;
      $scope.users                = []; 
      $scope.exam_list            = []; 
      $scope.blank_columns = 1;

    $scope.categoryChanged     = function (selected_category) {
            
            route   = '{{URL_GET_FEE_PAID_DETAILS_OF_CLASS}}';  
	        data    = {   _method: 'post', 
	                  '_token':httpPreConfig.getToken(), 
	                  'feecategory_id': selected_category, 
	                 
	               };
	               
	        httpPreConfig.webServiceCallPost(route, data).then(function(result){
	        	// console.log(result.data);
	        users = [];
	        angular.forEach(result.data, function(value, key) {
	            users.push(value);
	          })

	        $scope.result_data = users;
	        
	        
	        $scope.class_title         = $scope.result_data[0].academic_year_title+'-'+$scope.result_data[0].course_title+' '+'Student List'; 

	        $scope.class_title_yer_sem = $scope.result_data[0].academic_year_title+'-'+$scope.result_data[0].course_title+'-'+$scope.result_data[0].current_year+' '+'year'+'-'+$scope.result_data[0].current_semister+' '+'semester'+' '+'Student List'; 

	        });
    }
 
 $scope.addColumns = function(n)
 {
  $scope.blank_columns = [];
  for(i=0; i<n; i++)
    $scope.blank_columns.push(i);
 }
 
 $scope.printIt = function(){
  dta = $('#printable_data').html();
  $('#html_data').val(dta);
  $('#htmlform').submit();
 }
});
 
  
</script>