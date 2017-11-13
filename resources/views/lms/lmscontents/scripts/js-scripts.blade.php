

<script>
app.controller('angLmsController', function($scope, $http) {
    
        
    $scope.initAngData = function(data) {
        if(data=='')
        {
            $scope.series = '';
            $scope.content_type = '';
            return;
        }
         data = JSON.parse(data);
         $scope.content_type    = data.content_type;
    }
});
 
</script>