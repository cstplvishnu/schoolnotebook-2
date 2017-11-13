    
    
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                           
                                         <label class="col-lg-12">{{getPhrase('title')}}<span class="text-danger">*</span></label>
                                            <div class="col-lg-12">

                                        {{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Eg :'.getPhrase('Eg :_offer-1'),

                                                    'ng-model'=>'title', 


                                                    'required'=> 'true', 

                                                    'ng-class'=>'{"has-error": formQuiz.title.$touched && formQuiz.title.$invalid}',

                                                    'ng-minlength' => '4',

                                                    'ng-maxlength' => '30',

                                                    'ng-pattern' => getRegexPattern('name1'),

                                                    )) }}

                                                <div class="validation-error" ng-messages="formQuiz.title.$error" >

                                                    {!! getValidationMessage()!!}
                                                    
                                                    {!! getValidationMessage('minlength',4,30)!!}

                                                    {!! getValidationMessage('maxlength',4,30)!!}

                                                    {!! getValidationMessage('pattern')!!}

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                    <label class="col-lg-12">{{getPhrase('coupon_code')}}<span class="text-danger">*</span></label>
                                            <div class="col-lg-12">

                                        {{ Form::text('coupon_code', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('Eg :_AMee'),

                                            'ng-model'=>'coupon_code', 

                                            'required'=> 'true', 

                                            'ng-class'=>'{"has-error": formQuiz.coupon_code.$touched && formQuiz.coupon_code.$invalid}',

                                            'ng-minlength' => '2',

                                            'ng-maxlength' => '10',

                                            )) }}

                                        <div class="validation-error" ng-messages="formQuiz.coupon_code.$error" >

                                            {!! getValidationMessage()!!}


                                            {!! getValidationMessage('minlength',2,10)!!}

                                            {!! getValidationMessage('maxlength',2,10)!!}

                                        </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">

                                        <?php $discount_types = array('value' => getPhrase('value'), 'percent' => getPhrase('percent'), );?>

                                            <label class="col-lg-12">{{getPhrase('discount_type')}}<span class="text-danger">*</span></label>
                                            <div class="col-lg-12">
                                              {{Form::select('discount_type', $discount_types, null, ['class'=>'form-control'])}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-lg-12">{{getPhrase('discount_value')}}<span class="text-danger">*</span></label>
                                            <div class="col-lg-12">

                                        {{ Form::number('discount_value', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('Eg : 10'),

                                        'ng-model'=>'discount_value', 

                                          'ng-minlength' => '1',

                                            'ng-maxlength' => '4',
                                        
                                        'required'=> 'true', 

                                        'ng-class'=>'{"has-error": formQuiz.discount_value.$touched && formQuiz.discount_value.$invalid}',
                                         

                                        )) }}

                        <div class="validation-error" ng-messages="formQuiz.discount_value.$error" >

                            {!! getValidationMessage()!!}

                            {!! getValidationMessage('number')!!}

                            {!! getValidationMessage('minlength',1,4)!!}

                            {!! getValidationMessage('maxlength',1,4)!!}

                        </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-lg-12">{{getPhrase('minimum_bill')}}<span class="text-danger">*</span></label>
                                            <div class="col-lg-12">
                                         {{ Form::number('minimum_bill', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('Eg : 500'),

                            'ng-model'=>'minimum_bill', 
                             'min'=>'1',
                             'string-to-number'=>'minimum_bill',

                            'required'=> 'true', 

                            'ng-class'=>'{"has-error": formQuiz.minimum_bill.$touched && formQuiz.minimum_bill.$invalid}',
                             

                            )) }}

                        <div class="validation-error" ng-messages="formQuiz.minimum_bill.$error" >

                            {!! getValidationMessage()!!}

                            {!! getValidationMessage('number')!!}

                        </div>
                                         </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label class="col-lg-12">{{getPhrase('discount_maximum_amount')}}<span class="text-danger">*</span></label>
                                        <div class="col-lg-12">
                                        {{ Form::number('discount_maximum_amount', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('Eg : 20'),

                            'ng-model'=>'discount_maximum_amount',
                            'min'=>'1',
                             'string-to-number'=>'discount_maximum_amount', 

                            'required'=> 'true', 

                            'ng-class'=>'{"has-error": formQuiz.discount_maximum_amount.$touched && formQuiz.discount_maximum_amount.$invalid}',
                             

                            )) }}

                        <div class="validation-error" ng-messages="formQuiz.discount_maximum_amount.$error" >

                            {!! getValidationMessage()!!}

                            {!! getValidationMessage('number')!!}

                        </div>
                                  </div>
                                       </div>
                                   </div>
                                </div>
                              
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-lg-12">{{getPhrase('vaild_from')}} </label>
                                            <div class="col-lg-12">

                                                {{ Form::text('valid_from', null , $attributes = array('class'=>'datepicker-input form-control', 'placeholder' => 'Eg : 2015-06-12','size'=>'16','readonly'=>true,'id'=>'dpd1')) }}

                                               <!--  <input class="input-sm input-s datepicker-input form-control" size="16" type="text" value="12-02-2013" data-date-format="dd-mm-yyyy" > --> 
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-lg-12">{{getPhrase('valid_to')}}<span class="text-danger">*</span></label>
                                            <div class="col-lg-12">
                                               
                                               {{ Form::text('valid_to', null, $attributes = array('class'=>'datepicker-input form-control', 'placeholder' => 'Eg : 2015-06-12','size'=>'16','readonly'=>true,'id'=>'dpd2')) }}

                                               </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-lg-12">{{getPhrase('usage_limit')}} <span class="text-danger">*</span></label>
                                            <div class="col-lg-12">
                                            
                               {{ Form::number('usage_limit', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('Eg : 2'),

                            'ng-model'=>'usage_limit',
                            'min'=>'1',
                             'string-to-number'=>'usage_limit', 

                            'required'=> 'true', 

                            'ng-class'=>'{"has-error": formQuiz.usage_limit.$touched && formQuiz.usage_limit.$invalid}',
                             

                            )) }}

                        <div class="validation-error" ng-messages="formQuiz.usage_limit.$error" >

                            {!! getValidationMessage()!!}

                            {!! getValidationMessage('number')!!}

                        </div>                                    </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="form-group">

                                       <?php $status = array('Active' =>'Active', 'Inactive' => 'Inactive', );?>

                                    <label class="col-lg-12">{{getPhrase('status')}}<span class="text-danger">*</span></label>
                                            <div class="col-lg-12">

                                              {{Form::select('status', $status, null, ['class'=>'form-control'])}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php 

                        $user_options = null;

                        if($record)

                        if($record->coupon_code_applicability)

                            $user_options = json_decode($record->coupon_code_applicability)->categories;

                        ?>
                        <h6>{{getPhrase('applicable_categories')}}</h6>
                                <div class="row">
                                @foreach($categories as $key=>$value)

                                    <?php 


                                        $checked = '';

                                        if($user_options) {

                                            if(count($user_options))

                                            {

                                                if(in_array($key,$user_options))

                                                    $checked='checked';

                                            }

                                        }

                                    ?>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                         <div class="col-sm-6 m-t">
                                            <label class="switch">
                                              <input type="checkbox" 

                                    data-toggle="toggle" 

                                    data-onstyle="primary" 

                                    data-offstyle="default"

                                    name="applicability[{{$key}}]" 

                                    {{$checked}}

                                    > 
                                              <span></span>
                                            </label>
                                          </div>
                                          <label class="col-sm-6 m-t"><strong>{{$value}}</strong></label>
                                        </div>
                                    </div>
                                   @endforeach 
                                    
                                </div>
                                <div class="row">
                                <div class="col-sm-12">
                                   
                                        <div class="form-group">
                                            <div class="col-md-12 control-label">
                                                <div class="doc-buttons pull-right"> 
                                        <a href="{{URL_COUPONS}}" class="btn btn-default">{{getPhrase('cancel')}}</a>
                                        <button class="btn btn-success" ng-disabled='!formQuiz.$valid'>{{ $button_name }}</button>
                                              </div>
                                            </div>
                                        </div>
                                </div>
                              </div>
                        
    
