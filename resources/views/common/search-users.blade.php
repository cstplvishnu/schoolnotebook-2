


<script>



 app.controller('searchStudentController', function ($scope, $http)
  {
      
      $scope.students = []; 
      $scope.searchtestlenght   = 0;

      $scope.textChanged       = function (text) {
      $scope.searchtestlenght  = text.length;

      route = '{{URL_GET_USERS_SEARCH}}';
      data    = {   _method    : 'post', 
                  '_token'     : $scope.getToken(), 
                  'search_text': text,
                };
                   
      $http.post(route, data).then(function(response){

        result = response.data;
        students = [];
 
        angular.forEach(result, function(value, key) {
            students.push(value);
          })

        $scope.students = students;
        console.log($scope.students);
     
        });


        

}


$scope.getToken = function(){
        return  $('[name="_token"]').val();
    }



});
 
  
</script>