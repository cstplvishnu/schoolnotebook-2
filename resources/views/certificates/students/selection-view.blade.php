@extends($layout)

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                  <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
                  <li>{{$title}}</li>
                </ul>


<div class="row" ng-controller="TabController">
                  <div class="col-sm-10 col-sm-offset-1">
                     <section class="panel panel-default">
                       <header class="panel-heading font-bold">{{$title}}</header>


                 <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">
        
    <?php $template_key = getSetting('select_template', 'id_card_settings'); ?>
     @if($template_key=='template_2')
        
        {!! Form::open(array('url' => URL_CERTIFICATES_GENERATE_IDCARD, 'method' => 'POST', 'name'=>'idCards ','target'=>'_blank', 'novalidate'=>'')) !!}

        <div class="panel panel-custom">
           
            <div class="panel-body instruction">
               
               <div class="col-sm-offset-3">
                @include('common.year-selection-view', array('class'=>'custom-row-6'))
            </div>

                       
   <div ng-show="result_data.length>0"   class="row">

   <div class="col-sm-4 col-sm-offset-8">
             <div>
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search" ng-model="search"> <span class="input-group-btn">
                  <button class="btn btn-sm btn-success" type="button"><i class="fa fa-search"></i></button>
              </span> 
          </div>
        </div>
        </div>
   </div>
   <br>
 
    <div class="row vertical-scroll" >
   <div class="col-md-12" ng-repeat="user in result_data | filter:search ">
    <div class="col-md-6" >
    <div class="idcard-item">
        <div class="idcard-logo text-center">
            <img src="{{IMAGE_PATH_SETTINGS.getSetting('top_logo', 'id_card_settings')}}">
            <div class="address">{{$institute_address}}</div>
        </div>
        <div class="checkbox custom-checkbox">
            <label>
                    <input type="checkbox" name="selected_list[]" value="@{{user.id}}" checked>
                        <div class="item-checkbox">                                     
                            <i class="fa fa-check checked" aria-hidden="true"></i>
                        </div>
                    </label>
        </div>
        <div class="idcard-info idcard-item-thumb-left">
            <img ng-if="user.image!=null && user.image!=''" class="thumb img-circle" src="{{IMAGE_PATH_PROFILE}}@{{user.image}}">
            
            <img ng-if="user.image==null || user.image==''" class="thumb img-circle" src="{{IMAGE_PATH_USERS_DEFAULT_THUMB}}">

            <div class="content">
                <ul class="list-unstyled">
                    <li><strong>Name:</strong> @{{user.name}}</li>
                    <li><strong>Class:</strong> @{{user.academic_year_title+' '+user.course_title}}</li>
                    <li><strong>Blood Group:</strong>@{{user.blood_group}}</li>
                    <li><strong>Phone:</strong> @{{user.mobile}}</li>
                </ul>
            </div>
        </div>
        <div class="emergency-contact">
            <div class="idcard-id">@{{user.roll_no}}</div>
            {{getPhrase('emergency_no')}}.@{{user.home_phone}}
            </div>
    </div>
</div> 


 <div class="col-md-6">
    <div class="idcard-item">
        <div class="idcard-logo text-center">
            <img src="{{IMAGE_PATH_SETTINGS.getSetting('top_logo', 'id_card_settings')}}">
            <div class="address">{{$institute_address}}</div>
        </div>
       
        <div class="idcard-info idcard-item-thumb-left">
           <div class="content">
                <ul class="ma-address">
                    <li><strong>{{getSetting('back_first_item_title','id_card_fields')}} : </strong> {{getSetting('back_first_item_text','id_card_fields')}}</li>
                    
                    <li><strong>{{getSetting('back_second_item_title','id_card_fields')}} : </strong> {{getSetting('back_second_item_text','id_card_fields')}}</li>
                    
                    <li><strong>{{getSetting('back_third_item_title','id_card_fields')}} : </strong> {{getSetting('back_third_item_text','id_card_fields')}}</li>
                    
                    <li><strong>{{getSetting('back_fourth_item_title','id_card_fields')}} : </strong> {{getSetting('back_fourth_item_text','id_card_fields')}}</li>
                    
                </ul>
            </div>
        </div>
        
    </div>
</div> 
 </div>
</div>
<button ng-if="result_data.length>0" class="btn btn-s-md btn-success pull-right m-t" type="submit">{{getPhrase('print')}}</button>  
<div ng-if="result_data.length==0" class="text-center" >{{getPhrase('no_users_available')}}</div> 
<br>
  </div>
</div>
                   
                </hr>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}


@else

               <div class="row">
                           <div class="col-sm-12">
                               <div class="panel-body">

{!! Form::open(array('url' => URL_CERTIFICATES_GENERATE_IDCARD, 'method' => 'POST', 'name'=>'idCards ','target'=>'_blank', 'novalidate'=>'')) !!}

        
               <div class="col-sm-offset-3">
                @include('common.year-selection-view', array('class'=>'custom-row-6'))
            </div>
                       
   <div ng-show="result_data.length>0"   class="row">

   <div class="col-sm-4 col-sm-offset-8">
           <div>
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search" ng-model="search"> <span class="input-group-btn">
                  <button class="btn btn-sm btn-success" type="button"><i class="fa fa-search"></i></button>
              </span> 
          </div>
        </div>
        </div>
   </div>
   <br>
    <div class="row vertical-scroll" >
    <div class="row" ng-repeat="user in result_data | filter:search">
     <table cellpadding="10" width="740" cellspacing="0" border="0" align="center">
        <tbody><tr>
            <td width="50%" valign="top">
                <div style="border:1px solid #aaa; border-radius: 10px; padding:15px; min-height: 470px; margin-right: 15px;margin-bottom: 15px">
                    <table cellpadding="0" width="100%" cellspacing="0" border="0" style="font-family: sans-serif;  font-size: 14px; color: #999; line-height:24px;">
                        <tbody><tr>
                            <td align="center" style="padding: 5px 10px; ">
                               <img src="{{IMAGE_PATH_SETTINGS.getSetting('template_1_logo', 'id_card_settings')}}" height="50">
                            </td>
                        </tr>
                        <tr>
                            <td align="center" style="padding: 5px 10px; ">
                                
                                <p style="margin: 0;"><strong>{{$institute_address}}</strong></p>
                            </td>
                        </tr>
                        <tr>
        <div class="checkbox custom-checkbox">
                    <label>
                    <input type="checkbox" name="selected_list[]" value="@{{user.id}}" checked>
                        <div class="item-checkbox">                                     
                           
                        </div>
                    </label>
        </div>
                <td align="center">
            <img ng-if="user.image!=null && user.image!=''" class="thumb img-circle" src="{{IMAGE_PATH_PROFILE}}@{{user.image}}">
            
            <img ng-if="user.image==null || user.image==''" class="thumb img-circle" src="{{IMAGE_PATH_USERS_DEFAULT_THUMB}}">
                 </td>
                 <tr>
                 <td>
                <h2 style="font-size: 18px; margin: 0;color: #020230;" align="center"><strong>@{{user.name}}</strong></h2>
                </td>
                </tr>
               
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                         
                            <td style="padding:0 10px;">
                            <table cellpadding="0" width="100%" cellspacing="0" border="0" style="font-family: sans-serif;  font-size: 12px; color: #999; line-height:18px;">
                                    <tbody>
                        <tr>
                                      <td width="50%" style="padding:3px"><span style="color: darkslategrey; font-size: 14px;"><strong>{{getPhrase('roll_number')}}&nbsp;&nbsp;&nbsp;:</strong> @{{user.roll_no}}</span></td>
                        <tr>
                            <td width="50%" style="padding:3px"><span style="color: darkslategrey;font-size: 14px;"><strong>Course&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> @{{user.academic_year_title+' '+user.course_title}}</span></td>
                        </tr>
                            <tr>
                            <td width="50%" style="padding:3px"><span style="color: darkslategrey;font-size: 14px;"><strong>Blood Group&nbsp;&nbsp;:</strong> @{{user.blood_group}}</span></td>
                        </tr>
                                  <tr>
                            <td width="50%" style="padding:3px"><span style="color: darkslategrey;font-size: 14px;"><strong>Phone&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> @{{user.mobile}}</span></td>
                        </tr>
                                    <tr>
                        <td width="50%" style="padding:3px"><span style="color: darkslategrey;font-size: 14px;"><strong>Emergency No :</strong> @{{user.home_phone}}</span></td>
                        </tr>

                        <tr>
                                       
                        <td align="right"><img src="{{IMAGE_PATH_SETTINGS.getSetting('right_sign_image','certificate')}}" width="80" alt="">

                        <br/><b style="font-size:16px;">Principal</b>
                                    </tr>
                                    
                                </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </td>
           
             <td width="50%" valign="top">
                <div style="border:1px solid #aaa; border-radius: 10px; 
                padding:15px; min-height: 470px;">
                    <table cellpadding="0" width="100%" cellspacing="0" border="0" style="font-family: sans-serif;  
                    font-size: 14px; color: #999; 
                    line-height:24px;
                    margin-bottom: 140px;">
                        <tbody><br><br><br>
                        <tr>
                            <td align="center" style="padding: 5px 10px; ">
                             <img src="{{IMAGE_PATH_SETTINGS.getSetting('template_1_logo', 'id_card_settings')}}" height="50">
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="padding:0 10px;">
                                <table cellpadding="0" width="100%" cellspacing="0" border="0" style="font-family: sans-serif;  font-size: 14px; color: #999; line-height:18px;">

                                    <tbody><tr>
                                        <td>
                                            <p style="color: darkslategrey; margin-bottom:0;">
                                            <strong>{{getSetting('back_first_item_title','id_card_fields')}} : </strong></p>
                                            {{getSetting('back_first_item_text','id_card_fields')}}
                                            </td>

                                    </tr>

                                    <tr>
                                        <td>
                                            <p style="color: darkslategrey; margin-bottom:0;"><strong>{{getSetting('back_second_item_title','id_card_fields')}} : </strong></p> {{getSetting('back_second_item_text','id_card_fields')}}</td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <p style="color: darkslategrey; margin-bottom:0;"><strong>{{getSetting('back_third_item_title','id_card_fields')}} : </strong></p>{{getSetting('back_third_item_text','id_card_fields')}}</td>
                                            
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="color: darkslategrey; margin-bottom:0;"><strong>{{getSetting('back_fourth_item_title','id_card_fields')}}:</strong></p>{{getSetting('back_fourth_item_text','id_card_fields')}}</td>
                                    </tr>

                                </tbody></table>
                            </td>
                        </tr>
                    </tbody></table>
                </div>
            </td>
            
        </tr>
 
    </tbody></table>
    </div>
    </div>

<button ng-if="result_data.length>0" class="btn  btn-success pull-right m-t" type="submit">{{getPhrase('print')}}</button>  
<div ng-if="result_data.length==0" class="text-center" >{{getPhrase('no_users_available')}}</div> 
<br>
  </div>
</div>
                   
                </hr>
            </div>
        </div>
     </section>   
    </div>
</div>
{!! Form::close() !!}

@endif

@stop
 
 

@section('footer_scripts')

  
    @include('certificates.students.scripts.js-scripts')
    
@stop 