@extends($layout)

@section('content')

         <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
      <li><a href="{{PREFIX}}"><i class="fa fa-home"></i> {{getPhrase('home')}}</a></li>
      <li>{{$title}}</li>
    </ul>



    
<section class="panel panel-default" ng-controller="TabController">
  <header class="panel-heading clear"><strong> {{$title}}</strong></header>

        {!! Form::open(array('url' => URL_STUDENT_TRANSFERS, 'method' => 'POST', 'name'=>'idCards ','novalidate'=>'')) !!}

        <div class="panel panel-custom">
            
            <div class="panel-body instruction">

                @include('common.year-selection-view' )

            
              <div class="col-sm-3">
                                 <fieldset class='form-group'> 
                                  {{ Form::label('is_completed', getphrase('is_completed')) }}
                        <div class="m-b-sm">
                    <div class="btn-group toggle-tick">
                      <label class="btn btn-sm btn-info ss-radio-no active">{{ Form::radio('is_completed', 1, true, array('id'=>'paid ', 'name'=>'is_completed', 'ng-model'=>'is_completed')) }}
                       <!-- <input type="radio" name="options" id="option1">--><i class="fa fa-check text-active"></i>{{getPhrase('yes')}}
                      </label>
                      <label class="btn btn-sm btn-success ss-radio-no">{{ Form::radio('is_completed', 0, false, array('id'=>'free', 'name'=>'is_completed', 'ng-model'=>'is_completed')) }}
                       <!-- <input type="radio" name="options" id="option2">--><i class="fa fa-check text-active"></i>{{getPhrase('no')}}
                      </label>
                    </div>
                  </div>
                       </fieldset> 

                        </div>
                <div class="col-sm-5 col-md-offset-6">
                    <div ng-show="is_completed==0">
                    <fieldset class="form-group">
                        {{ Form::label ('to_academic_year', getphrase('academic_year')) }}
                        {{ Form::select('to_academic_id', $academic_years, null, 
                        [   'class'     => 'form-control', 
                            "id"        => "to_select_academic_year",
                            "ng-model"  => "to_academic_year",
                            "ng-change"  => "prepareToCourses()"
                        ])}}
                    </fieldset>
                    <fieldset ng-if="showToCourses" class="form-group">
                       
                       <label for="course_id">{{getPhrase('transfer_to_course')}}</label>
                        <select 
                        name="to_course" 
                        id="course_id" 
                        class="form-control" 
                        ng-model="to_course.course_id" 
                        ng-change="prepareToYears(to_course.course_id)"                           
                        ng-options="option.id as option.course_title for option in to_courses track by option.id">
                        <option value="">{{getPhrase('select')}}</option>
                         
                        </select>
                    </fieldset>

                <div ng-if="to_total_years<=1">
                    <input type="hidden" name="to_year" value="1">
                    <input type="hidden" name="to_semister" value="0">
                </div>     
                
             <fieldset ng-if="to_total_years>1" class="form-group">
                   
                <label for="year">{{getPhrase('transfer_to_year')}}</label>
                
                <select 
                name="to_year" 
                 class="form-control" 
                ng-model="to_years.year" 
                ng-options="v for v in to_years.values track by v"
                ng-change="toYearChanged(to_years.year)"
                >
                </select>
            </fieldset>

            <fieldset ng-if="to_total_semisters>0" class="form-group">
                   
                         <label for="semister">{{getPhrase('transfer_to_semister')}}</label>

                             <select 
                            name="to_semister" 
                            class="form-control" 
                            ng-model="to_semisters.current_semister" 
                            ng-options="v for v in to_semisters.values track by v"
                            >
                            </select>

                        </fieldset>

            </div>
                </div>
    
            </div>
            <div class="row">
<div class="col-sm-12"> 
<div class="table-responsive vertical-scroll">
 <div class="panel-heading">
  <table class="table">
    <thead>
        <th>{{getPhrase('image')}}</th>
        <th>{{getPhrase('name')}}</th>
        <th>{{getPhrase('roll_no')}}</th>
        <th>{{getPhrase('admission_no')}}</th>
        <th>{{getPhrase('action')}}</th>
        <th>{{getPhrase('remarks')}}</th>
        <th>{{getPhrase('action')}}</th>
    </thead>
    <tbody>
        <tr ng-repeat="user in result_data">
            <td>
            <img ng-if="user.image!=null && user.image!=''" class="thumb img-circle" src="{{IMAGE_PATH_PROFILE}}@{{user.image}}" height="60">
            
            <img ng-if="user.image==null || user.image==''" class="thumb img-circle" src="{{IMAGE_PATH_USERS_DEFAULT_THUMB}}">
            </td>
            <td>@{{user.name}}</td>
            <td>@{{user.roll_no}}</td>
            <td>@{{user.admission_no}}</td>
            <td> 
               <select name="selected_list[@{{user.id}}]" class="form-control">
               <option value="promoted" selected="true">{{getPhrase('promoted')}}</option>
               <option value="detained">{{getPhrase('detained')}}</option>
               </select>
            </td>
            <td><textarea cols="20" rows="2" ng-model="remarks[user.id]" name="remarks[@{{user.id}}]"></textarea></td>
            <td> <a class="btn btn-success" ng-click="showConfirmation(user, remarks[user.id])">{{getPhrase('course_completed')}}</a> </td>
        </tr>
    </tbody>
  </table>
  
  <button ng-show="result_data.length>0" class="btn btn-info pull-right" type="submit">
{{getPhrase('transfer')}}
</button> 
  
  
</div>
</div>
</div>
</div>


<div class="modal fade" id="transfer_student_summary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header text-center ss-border-no">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title font-bold" id="myModalLabel">{{getPhrase('are_you_sure')}}</h4>
                </div>
                <div class="modal-body attendance-calendar-report">

                    <div class="row">
                    
<div class="col-md-12">   
   
   {!! Form::open(array('url' => URL_STUDENT_TRANSFER_SINGLE_STUDENT, 'method' => 'POST', 'name'=>'idCards ','novalidate'=>'')) !!}

   
         <div class="col-md-5">
             <div class="">
                <a href="#">
                  <img class="img-circle"  ng-if="current_user.image!=''"
                  src="{{IMAGE_PATH_PROFILE}}@{{current_user.image}}" 
                  alt="@{{current_user.name}}">
                  <img class="img-circle"  ng-if="current_user.image==''"
                  src="{{IMAGE_PATH_PROFILE_DEFAULT_THUMBNAIL}}" 
                  alt="@{{current_user.name}}">
                </a>

                <h4 class="panel-heading font-bold">@{{current_user.name}}</h4>
                
                <p><a href="mailto:@{{current_user.email}}">@{{current_user.email}}</a></p>
                <input type="hidden" name="academic_id" value="@{{current_user.academic_id}}">
                <input type="hidden" name="course_id" value="@{{current_user.course_id}}">
                <input type="hidden" name="current_year" value="@{{current_user.current_year}}">
                <input type="hidden" name="current_semister" value="@{{current_user.current_semister}}">
                <input type="hidden" name="user_id" value="@{{current_user.user_id}}"> 
             </div>
         </div>
      
     <div class="col-md-7">
       <ul class="list-unstyled text-left attendance-calendar-report">
           <li class="title"><strong>{{getPhrase('details')}}</strong></li>
           <li><strong>{{getPhrase('academic_year')}} : </strong>  @{{current_user.academic_year_title}} </li>
           <li><strong>{{getPhrase('admission_no')}} : </strong>  @{{current_user.admission_no}} </li>
           <li><strong>{{getPhrase('course')}} : </strong>  @{{current_user.course_title}} </li>
           <li ng-show="current_user.course_dueration>1"> <strong>{{getPhrase('current_year')}}</strong>  @{{current_user.current_year}} </li>
           <li ng-show="current_user.current_semister>0"> <strong>{{getPhrase('current_semister')}} </strong> @{{current_user.current_semister}} </li>
           <li><strong>{{getPhrase('remarks')}} </strong> <br><textarea class="form-control" name="remarks" ng-model="current_user_remarks">@{{current_user_remarks}}</textarea> </li>
       </ul>
     </div>
                   
       
                    
  </div>
 </div>              
</div>
        <div class="modal-footer text-center ss-border-no">
            <a type="button" class="btn btn-cancel" data-dismiss="modal">{{getPhrase('cancel')}}</a>
            <button type="submit" class="btn btn-success" >{{getPhrase('yes')}}</button>
        </div>
    </div>
</div>
 {!! Form::close() !!}
 
</div>

        
  
<div ng-if="result_data.length==0" class="text-center" >{{getPhrase('no_users_available')}}</div> 
<br>
  </div>
     </section>               
        
 
                       
                            
                              <!--   <div class="text-right">
                                    <button  type="submit" class="btn btn-info" >
                                        {{getPhrase('transfer')}}
                                    </button>
                                </div> -->
                            
                        
                        {!! Form::close() !!}

            
@stop
 

@section('footer_scripts')

  @include('student-promotions.scripts.js-scripts')

  <script>
    
$(document).ready(function () {
   $('.toggle-tick input').click(function () {
       $('input:not(:checked)').parent().removeClass("active");
       $('input:checked').parent().addClass("active");
   });    
});
</script>
    
@stop
