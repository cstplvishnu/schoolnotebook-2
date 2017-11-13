@include('common.angular-factory')
<script>

 app.controller('feePayController', function ($scope, $http, httpPreConfig)
  {

    $scope.user_details = null;
    $scope.payment_details = null;
    $scope.total_fee = 0;
    $scope.total_amount_paid = 0;
    $scope.show_pay_button = 0;    
    $scope.paid_percentage = 0;
    $scope.net_amount_to_pay = 0;
    $scope.discount_amount = 0;
    $scope.categoryChanged = function(selected_category){

            feecategory          = selected_category;
            $scope.selected_feecategory = selected_category;

            route   = '{{URL_GET_FEE_CATEGORY_STUDENTS}}';  
            data    = {   
                   _method: 'post', 
                  '_token':httpPreConfig.getToken(), 
                  'feecategory_id': feecategory, 
               };
               
        httpPreConfig.webServiceCallPost(route, data).then(function(result){
          $scope.students  = result.data.students;
          $scope.total_number  = JSON.parse(result.data.total_number);
       });
   }
        
    $scope.getStuduntFeeDetails = function(feecategory_id, student_id){
        
        $scope.selected_category_id  = feecategory_id;
        $scope.selected_studentid    = student_id;

        route  = '{{URL_STUDENT_FEE_PAYMENT_DETAILS}}';
        data   = {

                   _method: 'post', 
                  '_token':httpPreConfig.getToken(), 
                  'feecategory_id': feecategory_id,
                  'student_id': student_id,
        };

         httpPreConfig.webServiceCallPost(route, data).then(function(result){
           
           $scope.academic_data     = result.data;
           $scope.student_image     = $scope.academic_data.user_details['image'];
           $scope.user_details      = result.data.user_details;
          
           console.log(result.data.previous_particulars);
           
           $scope.feedata              = result.data.particulars;
           $scope.payment_details      = result.data.payment_details;
           $scope.student              = result.data.student;
           $scope.total_fee            = result.data.net_amount_to_pay+result.data.total_amount_paid+result.data.total_discount;
           $scope.total_amount_paid    = result.data.total_amount_paid;
           $scope.net_amount_to_pay    = result.data.net_amount_to_pay;
           console.log($scope.net_amount_to_pay)
           $scope.total_amount_pay     = parseInt(result.data.net_amount_to_pay)+parseInt(result.data.previous_amount);
           $scope.previous_particulars = result.data.previous_particulars;
           $scope.previous_details     = result.data.previous_details;
           $scope.previous_amount      = result.data.previous_amount;
           $scope.discount_fee         = result.data.total_discount;
           $scope.discount_sum         = result.data.discount_sum;
           console.log('tpoay: '+$scope.net_amount_to_pay);
        });
    }

   /**
   This method is calculate the final amount after discount
   **/
    $scope.afterDiscount  = function(discount_value,net_amount){
       
       $scope.discount_amount = parseInt(discount_value);
       $scope.amount_to_pay   = parseInt(net_amount);
       $scope.currency_symbol = '{{getSetting('currency_symbol','site_settings')}}';
       $scope.final_pay  = $scope.amount_to_pay - $scope.discount_amount;


    }

    /**
     * This method will check the paid amount against minimum amount need to pay
     * which is set by admin in settings
     * If the user not reached the minimum amount we will not show the pay now button
     * @param  {[type]} total_amount       [description]
     * @param  {[type]} minimum_percentage [description]
     * @return {[type]}                    [description]
     */
    $scope.validateAmount = function(total_amount, paid_amount, minimum_percentage) {
      $scope.paid_percentage = ((paid_amount/total_amount)*100).toFixed(2);
      minimum_percentage=100;
      $scope.show_pay_button = 0;
      /**
       * Here the user need to pay the exact amount or minimum amount as 
       * specified by the admin, other than that, the paynow button will be disabled
       * @type {[type]}
       */
      if(minimum_percentage==100)
      {
        if($scope.paid_percentage==100)
          $scope.show_pay_button = 1;
        else
          $scope.show_pay_button = 0;
      }
      else if($scope.paid_percentage<=100)
      {
        if($scope.paid_percentage>=minimum_percentage)
          $scope.show_pay_button = 1;
        else
          $scope.show_pay_button = 0;
      }

    }

  



});
 
 function myfunction() {
       
       var x = $("#amount").val();
       var y =$("#paid_amount").val();
       var z = x-y;
       $("#balance").val(z);

    }
  
</script>