

<script>
app.controller('fee_payments_report', function( $scope, $http) {
    
    $scope.setDetails = function(record_id) {
		if(record_id=='')
            return;
        
        if(record_id === undefined)
            return;
        route = '{{URL_GET_FEE_PAYMENT_RECORD}}';  
        data= {_method: 'post', '_token':$scope.getToken(), 'record_id': record_id};
        $http.post(route, data).success(function(result, status) {
           
           $scope.feecategory_title = result.title;
           $scope.payment_record    = result.paymetn_record;
           $scope.user              = result.user;
        
        });

	}
	    
	$scope.getToken = function(){
      return  $('[name="_token"]').val();
    }

} 


 );

</script>