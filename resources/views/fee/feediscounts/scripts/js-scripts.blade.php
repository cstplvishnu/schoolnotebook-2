<script>
app.controller('angFeeDiscounts', function($scope, $http) {
	
	$scope.initAngData = function(data) {
		if(data=='')
		{
			$scope.discount = 'all';
			return;
		}
		data = JSON.parse(data);
		$scope.discount = data.discount_for;

		if(data.discount_for == 'student')
		{
			$scope.discountOptionChanged();	
			$scope.discount_for_details = data.discount_for_details;
		}

		if(data.discount_for == 'batch')
		{
			$scope.academic_id 		= data.academic_id;
			$scope.course_parent_id = data.course_parent_id;
			$('#course_parent_id').val(data.course_parent_id);
			 $scope.fillCourses();
			$scope.course_id = data.course_id;
			
		}
	}

	$scope.fillCourses = function() {
		parent_id = $('#course_parent_id').val()
		if(parent_id == 'undefined' || parent_id == null)
		{
			return;
		}
	  route = '{{URL_MASTERSETTINGS_STUDENT_COURSES}}'+ parent_id;
      data= { 
              _method     : 'get', 
              '_token'    : $scope.getToken() 
            };
      $http.get(route, data).success(function(result, status) {
      	
      	$('#course_id').empty();
      	
      	if(result.length == 0)
      		$('#course_id').append('<option value="">No data available</option>');
      	
      	for(i=0; i<result.length; i++)
           $('#course_id').append('<option value="'+result[i].id+'">'+result[i].text+'</option>');

      });
	}

	$scope.discountOptionChanged = function() {
		if($scope.discount=='student')
		{
			// ddl$('#discount_for_details');
			
	  route = '{{URL_USERS_LIST}}student'; 
      data= { 
              _method     : 'get', 
              '_token'    : $scope.getToken() 
            };
      $http.get(route, data).success(function(result, status) {
      	
      	$('#discount_for_details').empty();
      	
       $('#discount_for_details').select2({
       	data: result
       }).trigger('changed');
      });
		}
	}

	$scope.getToken = function(){
      return  $('[name="_token"]').val();
    }
	
});

$('.select2').select2();
</script>