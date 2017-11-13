<script src="{{JS}}angular.js"></script>
<script src="{{JS}}angular-messages.js"></script>

<script>
var app = angular.module('academia', ['ngMessages']);
 
     app.controller('schedule_controller', function ($scope, $http) {
     
      $scope.schedulesChanged = function(selected_number) {
		
		$scope.total_schedule = selected_number;
		$scope.final_schedules = [];
		$scope.total_schedules = selected_number;
		
  for(i=0; i<selected_number; i++)
    $scope.final_schedules.push(i);
 }
      
    });


 
</script>